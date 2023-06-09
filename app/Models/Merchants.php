<?php


namespace App\Models;


class Merchants extends BaseModel
{
    protected $table = 'merchants';
    protected $dates = ['updated'];
    public $timestamps = false;
    protected $with = [ 'merchant_status', 'user', 'compensationType', 'compensationTerm', 'merchantType','merchantMcc' ];


    protected $fillable  = ['mcc_id', 'url', 'cms_id', 'cms_id' ];

    public function payments()
    {
        return $this->hasMany(Payments::class, 'id', 'merchant_id');
    }

    public function merchant_status()
    {
        return $this->belongsTo(MerchantStatus::class, 'status', 'id');
    }

    public function user()
    {
        return $this->belongsTo(MerchantUser::class, 'user_id', 'id');
    }

    public function compensationType()
    {
        return $this->belongsTo(MerchantCompensationType::class, 'compensation_type', 'id');
    }

    public function compensationTerm()
    {
        return $this->belongsTo(MerchantCompensationTerm::class, 'compensation_term', 'id');
    }

    public function merchantType()
    {
        return $this->belongsTo(MerchantType::class, 'compensation_term', 'id');
    }

    public function merchantMcc()
    {
        return $this->belongsTo(MccCodes::class, 'mcc_id', 'id');
    }
}