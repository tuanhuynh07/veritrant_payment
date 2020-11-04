@extends('layouts.app')
@push('scripts')
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img alt='Paymentロゴ' src='{{asset('WEB-IMG/VeriTrans_Payment.png')}}'>
                <hr/>
                <div class="lhtitle">銀行決済：取引結果</div>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="rititletop">取引ID</td>
                        <td class="rivaluetop">{{array_key_exists('orderId',$dataResponse)?$dataResponse['orderId']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititle">取引ステータス</td>
                        <td class="rivalue">{{array_key_exists('txn_status',$dataResponse)?$dataResponse['txn_status']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititle">結果コード</td>
                        <td class="rivalue">{{array_key_exists('txn_result_code',$dataResponse)?$dataResponse['txn_result_code']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititle">結果メッセージ</td>
                        <td class="rivalue">{{array_key_exists('error_message',$dataResponse)?$dataResponse['error_message']:''}}<br/></td>
                    </tr>
                </table>
                <br/>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="rititletop" nowrap>収納機関番号</td>
                        <td class="rivaluetop">{{array_key_exists('org_number',$dataResponse)?$dataResponse['org_number']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititle" nowrap>お客様番号</td>
                        <td class="rivalue"> {{array_key_exists('customer_number',$dataResponse)?$dataResponse['customer_number']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititle" nowrap>確認番号</td>
                        <td class="rivalue">{{array_key_exists('confirm_number',$dataResponse)?$dataResponse['confirm_number']:''}}<br/></td>
                    </tr>
                </table>
                <br/>

                <a href="{{route('bank')}}">決済サンプルのトップメニューへ戻る</a>

                <hr/>
            </div>
        </div>
    </div>
@endsection
