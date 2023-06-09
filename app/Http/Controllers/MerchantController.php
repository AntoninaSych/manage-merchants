<?php


namespace App\Http\Controllers;


use App\Classes\Filters\MerchantSearchFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\LogMerchantRequestsRepository;
use App\Classes\LogicalModels\MccCodeRepository;
use App\Classes\LogicalModels\MerchantInfoRepository;
use App\Classes\LogicalModels\MerchantKeysRepository;
use App\Classes\LogicalModels\MerchantsAttachmentsRepository;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Classes\LogicalModels\MerchantStatusRepository;
use App\Classes\LogicalModels\MerchantUserRepository;
use App\Classes\LogicalModels\PaymentsRepository;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Merchant\CreateMerchant;
use App\Http\Requests\Merchant\UpdateMerchant;
use App\Models\MerchantsAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MerchantController extends Controller
{
    public $merchants;
    public $request;
    public $statuses;
    public $codes;
    public $merchantInfo;
    public $attachments;
    public $merchantsUser;
    public $keys;
    public $payments;

    public function __construct(MerchantsRepository $merchantsRepository,
                                Request $request,
                                MerchantStatusRepository $statuses,
                                MccCodeRepository $codes,
                                MerchantInfoRepository $merchantInfoRepository,
                                MerchantsAttachmentsRepository $attachments,
                                MerchantUserRepository $merchantsUser,
                                MerchantKeysRepository $keys,
                                PaymentsRepository $paymentsRepository
    )
    {
        $this->merchants = $merchantsRepository;
        $this->request = $request;
        $this->statuses = $statuses;
        $this->codes = $codes;
        $this->merchantInfo = $merchantInfoRepository;
        $this->attachments = $attachments;
        $this->merchantsUser = $merchantsUser;
        $this->keys = $keys;
        $this->payments = $paymentsRepository;
    }

    public function getlistByName()
    {

        $validator = Validator::make($this->request->all(), [
            'name' => 'required|string'
        ]);


        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                return ApiResponse::goodResponseSimple($this->merchants->getQuickSearch(['name'=>$this->request->get('name')]));
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }

    }

    public function list()
    {
        $arrayMerchantStatuses = $this->statuses->getListMerchantStatuses()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });

        $mcc_codes = $this->codes->getList()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });

        $usersFront = $this->merchantsUser->list()->pluck('username', 'id');

        return view('merchants.view')->with(['arrayMerchantStatuses' => $arrayMerchantStatuses,
            'codes' => $mcc_codes, 'usersFront' => $usersFront]);
    }

    public function getOneById(int $id)
    {
        $merchant = $this->merchants->getOneById($id);
        $arrayMerchantStatuses = $this->statuses->getListMerchantStatuses()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });

        $mcc_codes = $this->codes->getList()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });


        $attachments = $this->attachments->getList($id);
        $merchantInfo = $this->merchantInfo->getMerchantInfo($merchant->id);

        $merchantTerminal = $this->keys->getGeneratedKeyByMerchantId($merchant->id);

        return view('merchants.detailed')->with([
            'terminal' => $merchantTerminal,
            'merchant' => $merchant,
            'arrayMerchantStatuses' => $arrayMerchantStatuses,
            'codes' => $mcc_codes,
            'merchantInfo' => $merchantInfo,
            'attachments' => $attachments
        ]);
    }

    public function update(UpdateMerchant $updateMerchant, int $id)
    {
        $merchant = $this->merchants->getOneById($id);
        $oldStatus = $merchant->status;
        $this->merchants->updateOverall($updateMerchant, $id);
        $log = new Request(array_merge(['old merchant' => $merchant], ['new data for merchant' => $updateMerchant->all()]));
        LogMerchantRequestsRepository::log($id, $log, ['action' => 'update from backoffice', 'user' => Auth::user(), 'status' => 'Изменение данных мерчанта.']);

        return redirect()->back()->with('success', 'Мерчант  с ID  ' . $id . ' успешно обновлен.');

    }

    public function store(CreateMerchant $request)
    {
        $merchant = $this->merchants->store($request);
        LogMerchantRequestsRepository::log($merchant->id, $request, ['action' => 'store merchant from backoffice', 'user' => Auth::user(), 'status' => 'Добавление нового мерчанта.']);
        $merchant_id = $merchant->id;
        $terminal_id = ($this->request->get('terminal_id')) ? $this->request->get('terminal_id') : null;

        try {
            DB::select('call createMerchant(?,?,@result,@error)', [$merchant_id, $terminal_id]);
        } catch (\Throwable $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }

        return redirect()->back()->with('success', 'Мерчант  с ID  ' . $merchant->id . ' успешно создан.');
    }

    public function getMerchantsIdentifier()
    {
        return $this->merchants->getMerchantsIdentifier($this->request->get('name'));
    }

    public function getByterminalId()
    {
        return $this->merchants->getByTerminalId($this->request->get('name'));
    }

    public function getConcordPayUserName()
    {
        return $this->merchantsUser->getSearch(['username' => $this->request->get('name')])->pluck('username', 'id');
    }

    public function anyData()
    {
        $merchants = $this->merchants->getDeepSearch(MerchantSearchFilter::create($this->request->all()));
        return Datatables::query($merchants)
            ->addColumn('id', function ($merchants) {
                return $merchants->id;
            })
            ->addColumn('merchant_id', function ($merchants) {
                return $merchants->terminalId;
            })
            ->editColumn('name', function ($merchants) {
                return $merchants->name;
            })
            ->editColumn('type', function ($merchants) {
                $type = $merchants->type;
                if (!is_null($type)) {
                    $type = ($type == 'ind') ? 'Физ лицо' : "Юр лицо";
                }
                return $type;
            })
            ->editColumn('url', function ($merchants) {
                return '<a class="btn btn-black" href="' . $merchants->url . '">' . $merchants->url . '</a>';
            })
            ->editColumn('status', function ($merchants) {
                return $merchants->status;
            })
            ->addColumn('view_details', function ($merchants) {
                return '<a class="btn btn-black" href="' . route('merchant.detail', ['id' => $merchants->id]) . '"><i class="fa fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['view_details', 'url'])
            ->make(true);
    }

    public function viewChart()
    {
        return view('merchants.charts.index');
    }

    public function getChart()
    {
        $validator = Validator::make($this->request->all(), [
            'merchant_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        ]);


        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        } else {
            try {
                $data = $this->payments->getChartByMerchant($this->request->get('merchant_id'),
                    $this->request->get('date_from'),
                    $this->request->get('date_to'));

                return ApiResponse::goodResponseSimple($data);
            } catch (NotFoundException $e) {
                return ApiResponse::badResponse($e->getMessage(), $e->getCode());
            }
        }


    }
}
