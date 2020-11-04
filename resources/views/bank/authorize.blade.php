@extends('layouts.app')
@push('scripts')
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img alt="Paymentロゴ" src="{{asset('WEB-IMG/VeriTrans_Payment.png')}}"/>
                <hr/>
                <div class="lhtitle">銀行決済：決済請求</div>
                <form name="FORM_BANK" method="post" action="{{route('bank_payment')}}">
                    @csrf
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="ititletop">取引ID</td>
                            <td class="ivaluetop">{{$order_id}}&nbsp;
                                <input type="hidden" name="orderId" value="{{$order_id}}"></td>
                        </tr>
                        <tr>
                            <td class="ititle">決済サービスオプション</td>
                            <td class="ivalue">
                                <select name="serviceOptionType">
                                    <option value="atm" selected>ATM決済</option>
{{--                                    <option value="netbank-pc">ネットバンク決済 (PC)</option>--}}
{{--                                    <option value="netbank-docomo">ネットバンク決済 (docomo)</option>--}}
{{--                                    <option value="netbank-softbank">ネットバンク決済 (SoftBank)</option>--}}
{{--                                    <option value="netbank-au">ネットバンク決済 (au)</option>--}}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititle">決済金額</td>
                            <td class="ivalue"><input type="text" maxlength="10" size="11" name="amount"></td>
                        </tr>
                        <tr>
                            <td class="ititle">姓</td>
                            <td class="ivalue"><input type="text" maxlength="20" size="21" name="name1"></td>
                        </tr>
                        <tr>
                            <td class="ititle">名&nbsp;&nbsp;<font size="1" color="red">※任意項目</font></td>
                            <td class="ivalue"><input type="text" maxlength="20" size="21" name="name2"></td>
                        </tr>
                        <tr>
                            <td class="ititle">カナ（姓）</td>
                            <td class="ivalue"><input type="text" maxlength="20" size="21" name="kana1"></td>
                        </tr>
                        <tr>
                            <td class="ititle">カナ（名）&nbsp;&nbsp;<font size="1" color="red">※任意項目</font></td>
                            <td class="ivalue"><input type="text" maxlength="20" size="21" name="kana2"></td>
                        </tr>
                        <tr>
                            <td class="ititle">支払期限</td>
                            <td class="ivalue"><input type="text" maxlength="8" size="9"
                                                      name="payLimit">&nbsp;&nbsp;<font size="2" color="red">※形式：YYYYMMDD</font>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititle">プッシュURL</td>
                            <td class="ivalue">
                                <input type="text" maxlength="256" size="70" name="pushUrl"><br/>
                                <span style="font-size: small; color: red;">※必要な場合は入力してください。</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><font size="2">※請求内容は、インフォメーションとしてATMなどに表示されます。</font></td>
                        </tr>
                        <tr>
                            <td class="ititletop">請求内容（漢字）</td>
                            <td class="ivaluetop"><input type="text" maxlength="24" size="25" name="contents"></td>
                        </tr>
                        <tr>
                            <td class="ititle">請求内容（カナ）</td>
                            <td class="ivalue"><input type="text" maxlength="48" size="60" name="contentsKana"></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="購入">&nbsp;&nbsp;<font size="2" color="red">※２回以上クリックしないでください。</font>
                            </td>
                        </tr>
                    </table>
                </form>
                <br>
                <a href="{{route('index')}}">決済サンプルのトップメニューへ戻る</a>&nbsp;&nbsp;
                <hr>
            </div>
        </div>
    </div>
@endsection
