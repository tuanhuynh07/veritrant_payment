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
                <div class="system-message">
    <span style="font-size: small;">
        {{array_key_exists('MerrMsg',$data_view)?$data_view['MerrMsg']:''}}
    </span>
                </div>

                <div class="lhtitle">カード決済：取引結果</div>
                <table style="border-width: 0; padding: 0; border-collapse: collapse;">
                    <tr>
                        <td class="rititlecommon">取引ID</td>
                        <td class="rivaluecommon">{{array_key_exists('OrderId',$data_view)?$data_view['OrderId']:''}}
                            <br/></td>
                    </tr>
                    <tr>
                        <td class="rititlecommon">取引ステータス</td>
                        <td class="rivaluecommon">{{array_key_exists('Status',$data_view)?$data_view['Status']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititlecommon">結果コード</td>
                        <td class="rivaluecommon">{{array_key_exists('ResultCode',$data_view)?$data_view['ResultCode']:''}}<br/></td>
                    </tr>
                </table>
                <br/>
                <table style="border-width: 0; padding: 0; border-collapse: collapse">
                    <tr>
                        <td class="rititlecommon">カード番号</td>
                        <td class="rivaluecommon">{{array_key_exists('ReqCardNumber',$data_view)?$data_view['ReqCardNumber']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititlecommon">承認番号</td>
                        <td class="rivaluecommon">{{array_key_exists('ResAuthCode',$data_view)?$data_view['ResAuthCode']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititlecommon">取引金額</td>
                        <td class="rivaluecommon">{{array_key_exists('Amount',$data_view)?$data_view['Amount']:''}}<br/></td>
                    </tr>
                    <tr>
                        <td class="rititlecommon">要求同時売上</td>
                        <td class="rivaluecommon">{{array_key_exists('WithCapture',$data_view)?$data_view['WithCapture']:''}}<br/></td>
                    </tr>

                </table>

                <br/>

                <a href="{{route('card')}}">決済サンプルのトップメニューへ戻る</a>

                <hr/>
            </div>
        </div>
    </div>
@endsection
