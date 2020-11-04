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
                <table>
                    <tr>
                        <td class="ptitle">
                            <div class="lhtitle">コンビニ決済：決済請求</div>
                        </td>
                        <td class="pcxts">
                            <img src="{{asset('WEB-IMG/CVS_CirclekSunkus.jpg')}}"/>
                            <img src="{{asset('WEB-IMG/CVS_Dailyyamazaki.jpg')}}"/>
                            <img src="{{asset('WEB-IMG/CVS_Famima.jpg')}}"/>
                            <img src="{{asset('WEB-IMG/CVS_Lawson.jpg')}}"/>
                            <img src="{{asset('WEB-IMG/CVS_Ministop.jpg')}}"/>
                            <img src="{{asset('WEB-IMG/CVS_Seicomart.jpg')}}"/>
                            <img src="{{asset('WEB-IMG/CVS_SevenEleven.jpg')}}"/>
                        </td>
                    </tr>
                </table>
                <form name="FORM_CVS" method="post" action="{{route('cvs_payment')}}">
                    @csrf
                <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="ititletop">取引ID</td>
                            <td class="ivaluetop">{{$order_id}}&nbsp;&nbsp;<input
                                    type="hidden" name="orderId" value="{{$order_id}}"></td>
                        </tr>
                        <tr>
                            <td class="ititle">決済サービスオプション</td>
                            <td class="ivalue">
                                <select name="serviceOptionType">
                                    <option value="sej" selected>セブンイレブン</option>
                                    <option value="econ">ローソン､ファミリーマートetc</option>
                                    <option value="other">サークルKサンクス、デイリーヤマザキetc</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititle">決済金額</td>
                            <td class="ivalue"><input type="text" maxlength="6" size="7" name="amount" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititle">姓</td>
                            <td class="ivalue"><input type="text" maxlength="20" size="21" name="name1" required></td>
                        </tr>
                        <tr>
                            <td class="ititle">名</td>
                            <td class="ivalue"><input type="text" maxlength="20" size="21" name="name2" required></td>
                        </tr>
                        <tr>
                            <td class="ititle">電話番号</td>
                            <td class="ivalue"><input type="text" maxlength="13" size="14"
                                                      name="telNo" required>&nbsp;&nbsp;<font
                                    size="2" color="red">※"-"(ハイフン)区切りも可能</font></td>
                        </tr>
                        <tr>
                            <td class="ititle">支払期限</td>
                            <td class="ivalue"><input type="text" maxlength="10" size="11"
                                                      name="payLimit" required>&nbsp;&nbsp;<font
                                    size="2" color="red">※形式：YYYYMMDD or YYYY/MM/DD</font></td>
                        </tr>
                        <tr>
                            <td class="ititle">支払期限時分</td>
                            <td class="ivalue"><input type="text" maxlength="5" size="6" name="payLimitHhmm">&nbsp;&nbsp;<font
                                    size="2" color="red">※形式：HH:mm or HHmm</font></td>
                        </tr>
                        <tr>
                            <td class="ititle">プッシュURL</td>
                            <td class="ivalue">
                                <input type="text" maxlength="256" size="70" name="pushUrl"><br/>
                                <span style="font-size: small; color: red;">※必要な場合は入力してください。</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">

                                <button type="submit">
                                    {{ __('購入') }}
                                </button>
                                <font size="2" color="red">※２回以上クリックしないでください。</font>
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
