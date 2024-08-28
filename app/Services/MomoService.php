<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use Carbon\Carbon;

class MomoService
{
    public static function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public static function gatewayMomo2($orderInfo,$amount,$redirectUrl)
    {
        $partnerCode =  "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $serectkey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderId = time() . "";
        $ipnUrl = route("premium-register-success");        
        $extraData ="";
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $requestId = time() . "";
        $requestType = "captureWallet";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = MomoService::execPostRequest($endpoint, json_encode($data));        
        $jsonResult = json_decode($result, true);          
    
        return redirect()->away($jsonResult["payUrl"]);
        //Just a example, please check more in there        
        // header('Location: ' . $jsonResult['payUrl']);
    }

    public static function gatewayMomo()
    {
        $partnerCode =  "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $serectkey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderId = time() . "";
        $orderInfo = "Thanh toán qua ví momo";
        $amount = 300000;
        $ipnUrl = route("premium-register-success");
        $redirectUrl = route("premium-register-success");        
        $extraData ="";
    
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $requestId = time() . "";
        $requestType = "captureWallet";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = MomoService::execPostRequest($endpoint, json_encode($data));        
        $jsonResult = json_decode($result, true);          
    
        return redirect()->away($jsonResult["payUrl"]);
        //Just a example, please check more in there        
        // header('Location: ' . $jsonResult['payUrl']);
    }
}

