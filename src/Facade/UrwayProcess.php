<?php

namespace Alaaelsaid\LaravelUrwayPayment\Facade;

use Illuminate\Support\Facades\Http;

class UrwayProcess
{
    public static function getPaymentUrl(array $data)
    {
        return self::urway($data)['payment_url'];
    }

    private static function getUrwayChargeData($arr)
    {
        return [
            'trackid'       => $arr['trackid'],
            'terminalId'    => config('urway.terminal_id'),
            'customerEmail' => $arr['email'],
            'action'        => "1",  // action is always 1
            'merchantIp'    => self::getServerIp(),
            'password'      => config('urway.urway_password'),
            'currency'      => config('urway.currency'),
            'country'       => "SA",
            'amount'        => $arr['amount'],
            "udf1"          => $arr['udf1'] ?? "",
            "udf2"          => $arr['redirect_url'], //Response page URL
            "udf3"          => $arr['udf3'] ?? "",
            "udf4"          => $arr['udf4'] ?? "",
            "udf5"          => $arr['udf5'] ?? "",
            'requestHash'   => self::generateHash($arr)  //generated Hash
        ];
    }

    private static function urway($arr)
    {
        $data = self::getUrwayChargeData($arr);

        $response = Http::post(self::base(), $data)->object();

        return ['payment_url' => self::paymentUrl($response), 'error' => ''];
    }

    private static function paymentUrl($response)
    {
        return (isset($response->targetUrl) && isset($response->payid)) ? $response->targetUrl . '?paymentid=' . $response->payid : '';
    }

    private static function base()
    {
        $dev = 'https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest';

        $live = 'https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest';

        return config('urway.status') == 'dev' ? $dev : $live;
    }

    private static function getServerIp()
    {
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    private static function generateHash($arr)
    {
        $txn_details  = $arr['trackid'];

        $txn_details .= '|'. config('urway.terminal_id');

        $txn_details .= '|'. config('urway.urway_password');

        $txn_details .= '|'. config('urway.merchant_secret_key');

        $txn_details .= '|'.$arr['amount'];

        $txn_details .= '|' . config('urway.currency');

        return hash('sha256', $txn_details);
    }
}
