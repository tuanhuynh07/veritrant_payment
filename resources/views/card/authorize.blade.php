@extends('layouts.app')
<?php
$token_api_key = env('TOKEN_API_KEY');
$token_api_url = env('TOKEN_API_URL');
?>
@push('scripts')
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="JavaScript" type="text/javascript">
        function jpoChk(jpoObj) {
            var val = jpoObj.value;
            if (val.length == 1) {
                if (isNaN(val) == false) {
                    jpoObj.value = "0" + jpoObj.value;
                }
            }
        }

        function reDrawing(frm, action) {
            frm.action = action;
            frm.method = "POST";
            frm.submit();
        }

        function submitToken(e) {
            var data = {};
            data.token_api_key = document.getElementById('token_api_key').innerText;
            if (document.getElementById('card_number')) {
                data.card_number = document.getElementById('card_number').value;
            }
            if (document.getElementById('cc-exp')) {
                data.card_expire = document.getElementById('cc-exp').value;
            }
            if (document.getElementById('cc-csc')) {
                data.security_code = document.getElementById('cc-csc').value;
            }
            data.lang = "ja";

            var url = document.getElementById('token_api_url').innerText;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
            xhr.addEventListener('loadend', function () {
                if (xhr.status === 0) {
                    alert("トークンサーバーとの接続に失敗しました");
                    return;
                }
                var response = JSON.parse(xhr.response);
                if (xhr.status == 200) {
                    console.log(response.token);
                    document.getElementById('card_number').value = "";
                    document.getElementById('cc-exp').value = "";
                    document.getElementById('cc-csc').value = "";
                    document.getElementById('token').value = response.token;
                    document.forms[0].submit();
                } else {
                    alert(response.message);
                }

            });
            xhr.send(JSON.stringify(data));
        }
    </script>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img alt="Paymentロゴ" src='{{asset('WEB-IMG/VeriTrans_Payment.png')}}'>
                <hr/>

                <table style="border-width: 0; padding: 0; border-collapse: collapse;">
                    <tr>
                        <td>
                            <div class="lhtitle">カード決済：決済請求</div>
                        </td>
                        <td>
                            <img alt="LOGO" src="{{asset('WEB-IMG/Card_Visa.png')}}"/>
                            <img alt="LOGO" src="{{asset('WEB-IMG/Card_MasterCard.png')}}"/>
                            <img alt="LOGO" src="{{asset('WEB-IMG/Card_JCB.gif')}}"/>
                            <img alt="LOGO" src="{{asset('WEB-IMG/Card_Amex.gif')}}"/>
                            <img alt="LOGO" src="{{asset('WEB-IMG/Card_DinersClub.png')}}"/>
                        </td>
                    </tr>
                </table>

                <form name="FORM_CARD" method="post" action="{{route('card_payment')}}">
                    @csrf
                    <table style="border-width: 0; padding: 0; border-collapse: collapse;">
                        <tr>
                            <td class="ititlecommon">取引ID</td>
                            <td class="ivaluecommon">
                                {{$order_id}}
                                <input type="hidden" name="orderId" value="{{$order_id}}">
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">金額</td>
                            <td class="ivaluecommon">
                                <input type="text" maxlength="8" size="9" name="amount"
                                       value="">
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">与信方法</td>
                            <td class="ivaluecommon">
                                <select name="withCapture">
                                    <option value="0" selected>与信のみ(与信成功後に売上処理を行う必要があります)
                                    </option>
                                    <option value="1">与信売上(与信と同時に売上処理も行います)
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">クレジットカード番号</td>
                            <td class="ivaluecommon">
                                <input id="card_number" type="tel" x-autocompletetype="cc-number"
                                       autocompletetype="cc-number"
                                       autocorrect="off" spellcheck="false" autocapitalize="off" maxlength="19"
                                       size="19">
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">有効期限</td>
                            <td class="ivaluecommon">
                                <input id="cc-exp" type="tel" x-autocompletetype="off" autocompletetype="off"
                                       autocorrect="off"
                                       spellcheck="false" autocapitalize="off" placeholder="MM/YY" maxlength="5"
                                       size="5">&nbsp;&nbsp;<span style="font-size: small; color: red;">※形式：MM/YY</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">支払方法</td>
                            <td class="ivaluecommon">
                                <select name="jpo1">
                                    <option value="10" selected>一括払い(支払回数の設定は不要)
                                    </option>
                                    <option value="61">分割払い(支払回数を設定してください)
                                    </option>
                                    <option value="80">リボ払い(支払回数の設定は不要)
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">支払回数</td>
                            <td class="ivaluecommon">
                                <input type="text" maxlength="2" size="3" name="jpo2"
                                       value="" onBlur="jpoChk(this);">
                                &nbsp;&nbsp;<span style="font-size:small;color:red;">※一桁の場合は数値の前に&quot;0&quot;をつけてください。&nbsp;&nbsp;例：01</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">セキュリティコード</td>
                            <td class="ivaluecommon">
                                <input id="cc-csc" type="tel" autocomplete="off" autocorrect="off" spellcheck="false"
                                       autocapitalize="off" maxlength="4" size="4">
                                &nbsp;&nbsp;<span style="font-size: small; color: red;">※必要な場合は入力してください。</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="thlToken" colspan="2">
                                MDKトークン設定情報
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">トークンAPIキー</td>
                            <td class="ivaluecommon">
                                <span id="token_api_key">{{htmlspecialchars($token_api_key)}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="ititlecommon">トークンAPI URL</td>
                            <td class="ivaluecommon">
                                <span id="token_api_url">{{htmlspecialchars($token_api_url)}}</span><br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button id="btnSubmit" onclick="submitToken();return false;">購入</button>
                                &nbsp;&nbsp;<span style="font-size: small; color: red;">※2回以上クリックしないでください。</span>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="token" name="token">
                </form>
                <br>
                <a href="{{route('index')}}">決済サンプルのトップメニューへ戻る</a>&nbsp;&nbsp;

                <hr>
            </div>
        </div>
    </div>
@endsection
