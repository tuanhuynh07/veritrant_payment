<?php
/**
 * 決済サービスタイプ：Amazonpay、コマンド名：決済申込の要求Dtoクラス<br>
 *
 * @author Veritrans, Inc.
 *
 */
class AmazonpayAuthorizeRequestDto extends AbstractPaymentRequestDto
{

    /**
     * 決済サービスタイプ<br>
     * 半角英数字<br>
     * 必須項目、固定値<br>
     */
    private $SERVICE_TYPE = "amazonpay";

    /**
     * 決済サービスコマンド<br>
     * 半角英数字<br>
     * 必須項目、固定値<br>
     */
    private $SERVICE_COMMAND = "Authorize";

    /**
     * 取引ID<br>
     * 半角英数字<br/>
     * 最大桁数：100<br/>
     * - マーチャント側で取引を一意に表す注文管理IDを指定します。<br/>
     * - 申込処理ごとに一意である必要があります。<br/>
     * - 半角英数字、“-”（ハイフン）、“_”（アンダースコア）も使用可能です。<br/>
     */
    private $orderId;

    /**
     * 決済金額<br>
     * 半角数字<br/>
     * 最大桁数：8<br/>
     * 決済金額を指定します。<br/>
     * - 1 以上かつ 10000000(8桁) 以下<br/>
     */
    private $amount;

    /**
     * 与信同時売上フラグ<br>
     * 英字（boolean）<br/>
     * "true"： 与信同時売上<br/>
     * "false"： 与信のみ<br/>
     * ※指定が無い場合は、与信のみとなります。<br/>
     */
    private $withCapture;

    /**
     * 配送先表示抑止フラグ<br>
     * 英字（boolean）<br/>
     * "true"： 配送先非表示<br/>
     * "false"： 配送先表示<br/>
     * ※未指定の場合は、MAP（Merchant Administrator Portal）から登録申請した値を使用。<br/>
     */
    private $suppressShippingAddressView;

    /**
     * プラットフォームID<br>
     * 文字列<br/>
     * 最大桁数：21<br/>
     * Amazonから指定のあった場合のみ設定する予定の項目<br/>
     * - 最大:21byte<br/>
     */
    private $platformId;

    /**
     * 注文説明<br>
     * 文字列<br/>
     * 最大桁数：255<br/>
     * 購入者のメールに表示される注文の説明<br/>
     * - 最大:255文字<br/>
     */
    private $noteToBuyer;

    /**
     * 完了時URL<br>
     * URL<br/>
     * 最大桁数：256<br/>
     * 決済申込成功時に、店舗側サイトに画面遷移を戻すためのURLを指定（クエリパラメータ指定可）<br/>
     * ※未指定の場合は、MAP（Merchant Administrator Portal）から登録申請した値を使用。<br/>
     * - 最大:256byte<br/>
     */
    private $successUrl;

    /**
     * キャンセル時URL<br>
     * URL<br/>
     * 最大桁数：256<br/>
     * 決済申込を消費者がキャンセルした時に、店舗側サイトに画面遷移を戻すためのURLを指定（クエリパラメータ指定可）<br/>
     * ※未指定の場合は、MAP（Merchant Administrator Portal）から登録申請した値を使用。<br/>
     * - 最大:256byte<br/>
     */
    private $cancelUrl;

    /**
     * エラー時URL<br>
     * URL<br/>
     * 最大桁数：256<br/>
     * 決済申込エラー時に、店舗側サイトに画面遷移を戻すためのURLを指定（クエリパラメータ指定可）<br/>
     * ※未指定の場合は、MAP（Merchant Administrator Portal）から登録申請した値を使用。<br/>
     * - 最大:256byte<br/>
     */
    private $errorUrl;


    /**
     * ログ用文字列(マスク済み)<br>
     * 半角英数字<br>
     */
    private $maskedLog;


    /**
     * 決済サービスタイプを取得する<br>
     * @return string 決済サービスタイプ<br>
     */
    public function getServiceType() {
        return $this->SERVICE_TYPE;
    }

    /**
     * 決済サービスコマンドを取得する<br>
     * @return string 決済サービスコマンド<br>
     */
    public function getServiceCommand() {
        return $this->SERVICE_COMMAND;
    }

    /**
     * 取引IDを取得する<br>
     * @return string 取引ID<br>
     */
    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * 取引IDを設定する<br>
     * @param string $orderId 取引ID<br>
     */
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    /**
     * 決済金額を取得する<br>
     * @return string 決済金額<br>
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * 決済金額を設定する<br>
     * @param string $amount 決済金額<br>
     */
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    /**
     * 与信同時売上フラグを取得する<br>
     * @return string 与信同時売上フラグ<br>
     */
    public function getWithCapture() {
        return $this->withCapture;
    }

    /**
     * 与信同時売上フラグを設定する<br>
     * @param string $withCapture 与信同時売上フラグ<br>
     */
    public function setWithCapture($withCapture) {
        $this->withCapture = $withCapture;
    }

    /**
     * 配送先表示抑止フラグを取得する<br>
     * @return string 配送先表示抑止フラグ<br>
     */
    public function getSuppressShippingAddressView() {
        return $this->suppressShippingAddressView;
    }

    /**
     * 配送先表示抑止フラグを設定する<br>
     * @param string $suppressShippingAddressView 配送先表示抑止フラグ<br>
     */
    public function setSuppressShippingAddressView($suppressShippingAddressView) {
        $this->suppressShippingAddressView = $suppressShippingAddressView;
    }

    /**
     * プラットフォームIDを取得する<br>
     * @return string プラットフォームID<br>
     */
    public function getPlatformId() {
        return $this->platformId;
    }

    /**
     * プラットフォームIDを設定する<br>
     * @param string $platformId プラットフォームID<br>
     */
    public function setPlatformId($platformId) {
        $this->platformId = $platformId;
    }

    /**
     * 注文説明を取得する<br>
     * @return string 注文説明<br>
     */
    public function getNoteToBuyer() {
        return $this->noteToBuyer;
    }

    /**
     * 注文説明を設定する<br>
     * @param string $noteToBuyer 注文説明<br>
     */
    public function setNoteToBuyer($noteToBuyer) {
        $this->noteToBuyer = $noteToBuyer;
    }

    /**
     * 完了時URLを取得する<br>
     * @return string 完了時URL<br>
     */
    public function getSuccessUrl() {
        return $this->successUrl;
    }

    /**
     * 完了時URLを設定する<br>
     * @param string $successUrl 完了時URL<br>
     */
    public function setSuccessUrl($successUrl) {
        $this->successUrl = $successUrl;
    }

    /**
     * キャンセル時URLを取得する<br>
     * @return string キャンセル時URL<br>
     */
    public function getCancelUrl() {
        return $this->cancelUrl;
    }

    /**
     * キャンセル時URLを設定する<br>
     * @param string $cancelUrl キャンセル時URL<br>
     */
    public function setCancelUrl($cancelUrl) {
        $this->cancelUrl = $cancelUrl;
    }

    /**
     * エラー時URLを取得する<br>
     * @return string エラー時URL<br>
     */
    public function getErrorUrl() {
        return $this->errorUrl;
    }

    /**
     * エラー時URLを設定する<br>
     * @param string $errorUrl エラー時URL<br>
     */
    public function setErrorUrl($errorUrl) {
        $this->errorUrl = $errorUrl;
    }


    /**
     * ログ用文字列(マスク済み)を設定する<br>
     * @param string $maskedLog ログ用文字列(マスク済み)<br>
     */
    public function _setMaskedLog($maskedLog) {
        $this->maskedLog = $maskedLog;
    }

    /**
     * ログ用文字列(マスク済み)を取得する<br>
     * @return string ログ用文字列(マスク済み)<br>
     */
    public function __toString() {
        return (string)$this->maskedLog;
    }

}
?>