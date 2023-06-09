<?php


namespace App\Http\Controllers;


use App\Classes\Filters\CardFilter;
use App\Classes\Filters\SearchPaymentsFilter;
use App\Classes\Helpers\ApiResponse;
use App\Classes\Helpers\PermissionHelper;
use App\Classes\Helpers\ValidatorHelper;
use App\Classes\LogicalModels\CallBackRepository;
use App\Classes\LogicalModels\MerchantsRepository;
use App\Classes\LogicalModels\PaymentRequestRepository;
use App\Classes\LogicalModels\PaymentsRepository;
use App\Classes\LogicalModels\PaymentStatusRepository;
use App\Classes\LogicalModels\PaymentTypesRepository;
use App\Classes\LogicalModels\ProcessingLogRepository;
use App\Exceptions\NotFoundException;
use common\components\helpers\Cards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaymentsController extends Controller
{
    protected $request;
    protected $merchants;
    protected $paymentTypes;
    protected $paymentStatuses;
    protected $payments;
    protected $paymentReqeust;
    protected $processingLogRepository;

    public function __construct(Request $request,
                                MerchantsRepository $merchantsRepository,
                                PaymentTypesRepository $paymentTypes,
                                PaymentStatusRepository $paymentStatuses,
                                PaymentsRepository $paymentsRepository,
                                PaymentRequestRepository $paymentReqeust,
                                ProcessingLogRepository $processingLogRepository

    )
    {

        $this->paymentReqeust = $paymentReqeust;
        $this->request = $request;
        $this->merchants = $merchantsRepository;
        $this->paymentTypes = $paymentTypes;
        $this->paymentStatuses = $paymentStatuses;
        $this->payments = $paymentsRepository;
        $this->processingLogRepository = $processingLogRepository;
    }


    public function index()
    {
        $this->merchants = $this->merchants->getList(5);
        $this->paymentTypes = $this->paymentTypes->getList();
        $this->paymentStatuses = $this->paymentStatuses->getList();

        return view('payments.payments')->with([
            'merchants' => $this->merchants,
            'paymentTypes' => $this->paymentTypes,
            'paymentStatuses' => $this->paymentStatuses
        ]);
    }

    public function getOneById()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'integer'
        ]);
        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        }

        $payment = $this->payments->getOneById($this->request->get('id'));
        $list = $this->paymentReqeust->byPayment($this->request->get('id'));
        $callBackLog = new CallBackRepository();
        $callBackLog = $callBackLog->getByPaymentId($payment->id);
        $paymentStatusList = $this->paymentStatuses->getList();

        return view('payments.view')->with([
            'payment' => $payment,
            'callBackLog' => $callBackLog,
            'paymentStatusList' => $paymentStatusList,
            'statusRequest' => $list
        ]);
    }

    public function getProcessLog()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'integer'
        ]);
        if ($validator->fails()) {
            return ApiResponse::badResponseValidation(ValidatorHelper::toArray($validator));
        }
        try {
            $processLog = null;
            if (Auth::user()->can(PermissionHelper::PROCESS_LOG_VIEW)) {
                $processLog = $this->processingLogRepository->getProcessingLog($this->request->get('id'));
            }
        } catch (NotFoundException $e) {
            return ApiResponse::badResponse($e->getMessage(), $e->getCode());
        }

        return ApiResponse::goodResponse(['processLog' => $processLog]);
    }

    /**
     * Data for Data tables
     * @return mixed
     */
    public function anyData()
    {
        $payments = $this->payments->getSearch(SearchPaymentsFilter::create($this->request->all()));

        return Datatables::query($payments)
            ->addColumn('id', function ($payments) {
                return $payments->id;
            })
            ->editColumn('created', function ($payments) {
                return $payments->created;
            })
            ->editColumn('amount', function ($payments) {
                return str_replace('.', ',', $payments->amount);
            })
            ->editColumn('customer_fee', function ($payments) {
                return str_replace('.', ',', $payments->customer_fee + $payments->merchant_fee);
//                return str_replace('.', ',', $payments->customer_fee + $payments->merchant_fee);
            })
            ->editColumn('status', function ($payments) {
                return $payments->status;
            })
            ->editColumn('merchant', function ($payments) {
                return $payments->merchant;
            })
            ->editColumn('card_num', function ($payments) {
                if (!is_null($payments->card_num)) {
                    return CardFilter::filterString($payments->card_num);
                } else {
                    return '';
                }
            })
            ->editColumn('order_id', function ($payments) {
                return $payments->order_id;
            })
            ->editColumn('description', function ($payments) {
                return $payments->description;
            })
            ->editColumn('route', function ($payments) {
                return $payments->route;
            })
            ->addColumn('view_details', function ($payments) {
                return '<a class="btn btn-black" href="/payments/view?id=' . $payments->id . '"><i class="fa fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['view_details'])
            ->make(true);
    }


    public function exportToCSV()
    {
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename=" . date(DATE_ATOM) . ".csv");
        echo "\xEF\xBB\xBF";
        header("Pragma: no-cache");
        header("Expires: 0");
        $fp = fopen('php://output', 'w');
        $val = ['Id', 'Дата', 'Сумма', 'Комиссия', 'Статус', 'Номер карты', 'Id заказа', 'Описание'];
        fputcsv($fp, $val, ';');
        foreach ($this->payments->getSearch(SearchPaymentsFilter::create($this->request->all()))->get() as $model) {

            $val = [$model->id,
                $model->created,
                str_replace('.', ',', $model->amount),
              str_replace('.', ',', $model->customer_fee + $model->merchant_fee),
                       $model->status ,
                (!is_null($model->card_num))?CardFilter::filterString($model->card_num):'', $model->order_id, $model->description];
            fputcsv($fp, $val, ';');
        }

        fclose($fp);
        return null;
    }
}
