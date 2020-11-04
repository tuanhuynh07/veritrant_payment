<?php
/**
 * Created by PhpStorm.
 * User: HTV-tuanhh
 * Date: 25/08/2020
 * Time: 09:31
 */

namespace App\Utils;

define('MDK_DIR', storage_path('framework') . '/tgMdk/');
require_once(MDK_DIR . "3GPSMDK.php");

class VeritransPayments
{
    /**
     * @param $dataAuthorize
     * @return array
     */
    public function CreditCardAuthorize($dataAuthorize)
    {
        $request_data = new \CardAuthorizeRequestDto();
        $request_data->setOrderId($dataAuthorize['orderId']);
        $request_data->setAmount($dataAuthorize['amount']);
        $request_data->setToken($dataAuthorize['token']);
        $request_data->setWithCapture($dataAuthorize['withCapture']);
        if ((!empty($dataAuthorize['jpo1'])) && (("10" == $dataAuthorize['jpo1']) || ("80" == $dataAuthorize['jpo1']))) {
            $jpo = $dataAuthorize['jpo1'];
        } else if ((!empty($dataAuthorize['jpo1']) && ("61" == $dataAuthorize['jpo1'])) && (!empty($dataAuthorize['jpo1']))) {
            $jpo = $dataAuthorize['jpo1'] . "C" . $dataAuthorize['jpo2'];
        }
        if (isset($jpo)) {
            $request_data->setJpo($jpo);
        }
        $transaction = new \TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);
        if (!isset($response_data)) {
            $data_view = array();
            //想定応答の取得
        } else {
            $data_view = array(
                'MerrMsg' => $response_data->getMerrMsg(),
                'OrderId' => $response_data->getOrderId(),
                'Status' => $response_data->getMStatus(),
                'ResultCode' => $response_data->getVResultCode(),
                'ReqCardNumber' => $response_data->getReqCardNumber(),
                'ResAuthCode' => $response_data->getResAuthCode(),
                'Amount' => $response_data->getReqAmount(),
                'WithCapture' => $response_data->getReqWithCapture()
            );
        }
        return $data_view;
    }

    /**
     * @param $orderID
     * @param $amount
     * @return array
     */
    public function CreditCardCapture($orderID, $amount)
    {
        $sale = new \CardCaptureRequestDto();
        $sale->setOrderId($orderID);
        $sale->setAmount($amount);
        $transaction = new \TGMDK_Transaction();
        $saleData = $transaction->execute($sale);
        $data_view = array(
            'MerrMsg' => $saleData->getMerrMsg(),
            'OrderId' => $saleData->getOrderId(),
            'Status' => $saleData->getMStatus(),
            'ResultCode' => $saleData->getVResultCode(),
            'ResAuthCode' => $saleData->getResAuthCode(),
            'Amount' => $saleData->getReqAmount(),
        );
        return $data_view;
    }

    /**
     * @param $orderID
     * @param null $amount
     * @return array
     */
    public function CreditCardCancel($orderID, $amount = null)
    {
        $cancel = new \CardCancelRequestDto();
        $cancel->setOrderId($orderID);
        if (!is_null($amount))
            $cancel->setAmount($amount);
        $transaction = new \TGMDK_Transaction();
        $saleData = $transaction->execute($cancel);
        $data_view = array(
            'MerrMsg' => $saleData->getMerrMsg(),
            'OrderId' => $saleData->getOrderId(),
            'Status' => $saleData->getMStatus(),
            'ResultCode' => $saleData->getVResultCode(),
            'ResAuthCode' => $saleData->getResAuthCode(),
            'Amount' => $saleData->getReqAmount(),
        );
        return $data_view;
    }

    /**
     * @param $service_option_type
     * @param $order_id
     * @param $payment_amount
     * @param $last_name
     * @param $first_name
     * @param $tel_number
     * @param $payment_limit
     * @param null $payment_limit_hhmm
     * @param null $push_url
     * @return array
     */
    public function CvsAuthorize($service_option_type, $order_id, $payment_amount,
                                 $last_name, $first_name, $tel_number, $payment_limit, $payment_limit_hhmm = null, $push_url = null)
    {
        $request_data = new \CvsAuthorizeRequestDto();

        $request_data->setServiceOptionType($service_option_type);
        $request_data->setOrderId($order_id);
        $request_data->setAmount($payment_amount);
        $request_data->setName1($last_name);
        $request_data->setName2($first_name);
        $request_data->setTelNo($tel_number);
        $request_data->setPayLimit($payment_limit);
        $request_data->setPayLimitHhmm($payment_limit_hhmm);
        $request_data->setPushUrl($push_url);
        $request_data->setPaymentType("0");
        /**
         * 実施
         */
        $transaction = new \TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);
        $viewData = array();
        if (isset($response_data)) {
            $viewData = array(
                'txn_status' => $response_data->getMStatus(), //結果コード取得
                'txn_result_code' => $response_data->getVResultCode(),//詳細コード取得
                'error_message' => $response_data->getMerrMsg(),
                'orderId' => $response_data->getOrderId(),
                'receipt_number' => $response_data->getReceiptNo(),
                'haraikomi_url' => $response_data->getHaraikomiUrl()

            );
        }
        return $viewData;
    }

    /**
     * 決済方式
     *
     * ATM決済 : atm
     * ネットバンク決済銀行リンク方式（PC） : netbank-pc
     * ネットバンク決済銀行リンク方式（docomo） : netbank-docomo
     * ネットバンク決済銀行リンク方式（SoftBank） : netbank-softbank
     * ネットバンク決済銀行リンク方式（au） : netbank-au
     */
    public function BankAuthorize($dataAuthorize)
    {
        /**
         * 要求電文パラメータ値の指定
         */
        $request_data = new \BankAuthorizeRequestDto();
        $request_data->setServiceOptionType($dataAuthorize['serviceOptionType']);
        $request_data->setOrderId($dataAuthorize['orderId']);
        $request_data->setAmount($dataAuthorize['amount']);
        $request_data->setName1($dataAuthorize['name1']);
        if (isset($name2)) {
            $request_data->setName2($dataAuthorize['name2']);
        }
        $request_data->setKana1($dataAuthorize['kana1']);
        if (isset($kana2)) {
            $request_data->setKana2($dataAuthorize['kana2']);
        }
        $request_data->setPayLimit($dataAuthorize['payLimit']);
        $request_data->setPushUrl($dataAuthorize['pushUrl']);
        $request_data->setContents($dataAuthorize['contents']);
        $request_data->setContentsKana($dataAuthorize['contentsKana']);

        /**
         * 実施
         */
        $transaction = new \TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);
        $viewData = array();
        //予期しない例外
        if (isset($response_data)) {
            $viewData = array(
                'txn_status' => $response_data->getMStatus(), //結果コード取得
                'txn_result_code' => $response_data->getVResultCode(),//エラーメッセージ取得
                'error_message' => $response_data->getMerrMsg(),
                'orderId' => $response_data->getOrderId(),//取引ID取得

            );
            if ("success" === $response_data->getMStatus()) {
                if ("atm" == $dataAuthorize['serviceOptionType']) {
                    /**
                     * 収納機関番号
                     */
                    $viewData['org_number'] = $response_data->getShunoKikanNo();
                    /**
                     * お客様番号
                     */
                    $viewData['customer_number'] = $response_data->getCustomerNo();
                    /**
                     * 確認番号
                     */
                    $viewData['confirm_number'] = $response_data->getConfirmNo();
                }
            }
        }
        return $viewData;
    }
}
