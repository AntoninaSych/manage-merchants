<?php


namespace App\Classes\Helpers;


use Illuminate\Support\Facades\Facade;

class PermissionHelper extends Facade
{
    const MANAGE_USERS = 'manage-users';
    const VIEW_PAYMENTS = 'view-payments';
    const ADD_USERS = 'add-user';
    const MERCHANT_VIEW = 'merchant-view';
    const PROCESS_LOG_VIEW = 'process-log-view';
    const MANAGE_MCC = 'manage-mcc';
    const MANAGE_MERCHANT = 'manage-merchant';
    const MANAGE_MERCHANT_PAYMENT_TYPE = 'manage-merchant-payment-type';
    const MANAGE_MERCHANT_ROUTE = 'manage-merchant-route';
    const VIEW_STATISTIC = 'view-statistic';
    const VIEW_REESTRS = 'view-reestrs';
    const VIEW_ROUTES = 'view-routes';
    const MERCHANT_USER_ALIAS= 'merchant-user-alias';
    const VIEW_FRONT_USERS = 'view-front-users';
    const SNIPPETS_MODIFY = 'add-snippets-routes';
    const MAKE_REQUEST_STATUS = 'make-request-status';
    const MAKE_RESPONSE_STATUS = 'make-response-status';
    const MANAGE_MERCHANT_APPLE_PAY = 'manage-merchant-apple-pay';
    const VIEW_MONITORING = 'view-monitoring';
    const CAN_VIEW_REPORTS = 'view-reports';
    const CAN_MANAGE_REPORTS = 'manage-reports';
}

