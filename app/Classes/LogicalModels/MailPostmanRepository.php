<?php


namespace App\Classes\LogicalModels;

use App\Models\MailerPostman;


use App\Models\Merchants;
use App\Models\Orders;
use Illuminate\Support\Str;


class MailPostmanRepository
{
    public function apply(Orders $order, Merchants $merchant)
    {
        $mail = new MailerPostman();
        $mail->subject = "ConcordPay / Ваш сайт може прйимати платежі";

        $mail->body = view('email.approved')->with(
            ['user' => $order->user,
                'url' => $merchant->url]);
        $mail->date_create = date('y-m-d h:m:i');
        $mail->code = "BO_" . Str::random(40);
        $mail->recipients = json_encode([
            'from' => [
                'pay@concord.ua',
                'Concord Pay'],
            'to' => [$order->user->email]]);

        $mail->save();


    }

    public function decline(Orders $order, Merchants $merchant)
    {

        $mail = new MailerPostman();
        $mail->subject = "ConcordPay / Нам потрібна додаткова інформація за Вашим магазином";


        $mail->body = view('email.decline')->with(
            ['user' => $order->user,
                'url' => $merchant->url]);
        $mail->date_create = date('y-m-d h:m:i');
        $mail->code = "BO_" . Str::random(40);
        $mail->recipients = json_encode([
            'from' => [
                'pay@concord.ua',
                'Concord Pay'],
            'to' => [$order->user->email]]);

        $mail->save();


    }

    public static function newLetter(MailerPostman $letter)
    {
        $letter->save();
    }

}
