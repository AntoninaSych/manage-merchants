<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantMailingSettings;

class MerchMailingSetRepository
{

    public function getMerchantsByType(int $type)
    {
        $settings = new MerchantMailingSettings();
        $merchants = $settings->select('merchant_id','email')->where('mailing_type_id',$type)->get();

        return $merchants;
    }

    public function getMerchantById(int $merchantId)
    {
        $settings = new MerchantMailingSettings();
        $merchants = $settings->select('merchant_id','email')->where('merchant_id',$merchantId)->get();

        return $merchants;
    }
}
