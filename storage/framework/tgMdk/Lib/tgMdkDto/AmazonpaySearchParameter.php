<?php
/**
 * 検索条件:Amazonpay検索パラメータクラス<br>
 *
 * @author Veritrans, Inc.
 *
 */
class AmazonpaySearchParameter
{

    /**
     * 詳細オーダー決済状態<br>
     */
    private $detailOrderType;

    /**
     * 詳細コマンドタイプ名<br>
     */
    private $detailCommandType;

    /**
     * 決済センターの管理ID<br>
     */
    private $centerOrderId;

    /**
     * 決済センターのトランザクション管理ID<br>
     */
    private $centerTransactionId;

    /**
     * 詳細オーダー決済状態を取得する<br>
     *
     * @return string[] 詳細オーダー決済状態<br>
     */
    public function getDetailOrderType() {
        return $this->detailOrderType;
    }

    /**
     * 詳細オーダー決済状態を設定する<br>
     *
     * @param string[] $detailOrderType 詳細オーダー決済状態<br>
     */
    public function setDetailOrderType($detailOrderType) {
        $this->detailOrderType = $detailOrderType;
    }

    /**
     * 詳細コマンドタイプ名を取得する<br>
     *
     * @return string[] 詳細コマンドタイプ名<br>
     */
    public function getDetailCommandType() {
        return $this->detailCommandType;
    }

    /**
     * 詳細コマンドタイプ名を設定する<br>
     *
     * @param string[] $detailCommandType 詳細コマンドタイプ名<br>
     */
    public function setDetailCommandType($detailCommandType) {
        $this->detailCommandType = $detailCommandType;
    }

    /**
     * 決済センターの管理IDを取得する<br>
     *
     * @return string 決済センターの管理ID<br>
     */
    public function getCenterOrderId() {
        return $this->centerOrderId;
    }

    /**
     * 決済センターの管理IDを設定する<br>
     *
     * @param string $centerOrderId 決済センターの管理ID<br>
     */
    public function setCenterOrderId($centerOrderId) {
        $this->centerOrderId = $centerOrderId;
    }

    /**
     * 決済センターのトランザクション管理IDを取得する<br>
     *
     * @return string 決済センターのトランザクション管理ID<br>
     */
    public function getCenterTransactionId() {
        return $this->centerTransactionId;
    }

    /**
     * 決済センターのトランザクション管理IDを設定する<br>
     *
     * @param string $centerTransactionId 決済センターのトランザクション管理ID<br>
     */
    public function setCenterTransactionId($centerTransactionId) {
        $this->centerTransactionId = $centerTransactionId;
    }

}
?>