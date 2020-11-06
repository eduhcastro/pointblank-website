<?php 
error_reporting(0);
 include('../../_includes/recarga.php'); ?>

<section class="sub_purchase">
    <ul class="tab">
        <li class="topup current" date-view-page="Topup"><a href="">RECARGA</a></li>
        <li class="coupon" date-view-page="Coupon"><a href="/pages/cupon/">COUPON</a></li>
        <li class="history" date-view-page="History"><a href="/pages/historico">HISTORY</a></li>
    </ul>

    <ul class="pg_list">
        
            <li class="current" data-paytool="10" data-page-name="PPCARD" data-mallid="ppcard" data-currencycode="PHP" data-subpgcode="" data-subpgdesc="" data-alertflag="N" data-alertmsg="">
                <a href="javascript:;"><img src="/Common/Images/PG/pg_pbvoucher.png"></a>
                <p>Point Blank Fatality VIP</p>
            </li>
    </ul>

    <!-- PG별 영역 START : 기본 첫번째 PG -->
    <div class="pgarea">


<script type="text/javascript" src="/Common/JsLib/payment.js"></script>
<script type="text/javascript">
    $(function () {

    });
</script>

<div class="pg_info">
    <p>Point Blank Fatality VIP</p>
</div>
<div class="pg_explain">
    <p>Point Blank Fatality VIP Use as opçoes abaixos para fazer uma recarga de VIP</p>
</div>
<div class="purchase">
    <div class="price">
        <h3>Valor &amp; VIP</h3>
        <ul>
                <li>
                    <input type="radio" name="price" value="0" data-real-cash="0" data-display-title="" data-currency-symbol="PHP" hidden="hidden" checked="checked">
                    <strong>VIP 1 ( 60 R$ )</strong> PB Cash x 500,000,00 / +400% XP e CASH Por Partida <br>Boina GM Permanente + Patente Vip + Loja exclusiva!
                    
                                    </li>
                                    <li>
                                    <input type="radio" name="price" value="0" data-real-cash="0" data-display-title="" data-currency-symbol="PHP" hidden="hidden" checked="checked">
                    <strong>VIP 2 ( 30 R$ )</strong> Boina GM 1 Mês 
                    
                                    </li>
        </ul>
        
    </div>
    <div class="form">
        <h3>Please enter voucher information</h3>
        <div class="entry_voucher">
            
            <p class="warning" id="validmessageforempty" style="display:none;">Information needed. Please fill in the column.</p>
            <p class="warning" id="validmessageforlength" style="display:none;">Voucher Code is 16 characters</p>
        </div>
        <div class="entry_email">
           Ola <strong><?php echo "".$ranking['player_name'].""; ?></strong>, Entre no grupo<br>
            E chame algum admin para fazer a entrega do VIP.<br>
            
            <p class="btn btnPay" id="btnPay">
                <a href="https://discord.gg/FSPNr9e"  target="_blank">Entre no discord para efetuar a compra!</a>
            </p>
        </div>
    </div>
</div></div>
    <!-- PG별 영역 END -->


</section>



<form action="/Topup/Process" id="payFrm" method="post"><input name="__RequestVerificationToken" type="hidden" value="TZFRDGxzEq1PfUbm4F7I3b42IWM1zVpw3_lyGwciEnBGSLMKXkKCeDqEyC7tLoK2ydcy4iL1x2RoRzRK5EicfCiwP8gdZHJQacqNBrGE84Q1"><input id="paytoolcode" name="paytoolcode" type="hidden" value="0"><input id="pgcode" name="pgcode" type="hidden" value=""><input id="mallid" name="mallid" type="hidden" value=""><input id="payamt" name="payamt" type="hidden" value="0"><input id="vatamt" name="vatamt" type="hidden" value="0"><input id="cashamt" name="cashamt" type="hidden" value="0"><input id="totalpayamt" name="totalpayamt" type="hidden" value="0"><input id="topupemail" name="topupemail" type="hidden" value=""><input id="currencycode" name="currencycode" type="hidden" value=""><input id="paymethod" name="paymethod" type="hidden" value=""><input id="displaytitle" name="displaytitle" type="hidden" value="Point Blank Voucher"><input id="currencysymbol" name="currencysymbol" type="hidden" value=""><input id="username" name="username" type="hidden" value=""><input id="userphone" name="userphone" type="hidden" value=""><input id="useremail" name="useremail" type="hidden" value=""><input id="subpgcode" name="subpgcode" type="hidden" value=""><input id="subpgdesc" name="subpgdesc" type="hidden" value=""><input id="ppcardno" name="ppcardno" type="hidden" value=""><input id="payeremail" name="payeremail" type="hidden" value=""></form>


<!-- 레이어팝업(결제완료) -->
<div class="popup successPopup" style="display:none;">
    <p class="dimmed"></p>
    <div class="popup_layout">
        <p class="completed">
            <strong>COMPLETED</strong>
            Thank you for your purchase!<br>
            Additional information of current purchase
        </p>
        <div class="pop_btn">
            <a class="btn_gy" href="javascript:;">Close</a>
            <a class="btn_rd" href="/History/Index">HISTORY</a>
        </div>
    </div>
</div>
<!-- //레이어팝업(결제완료) -->

<!-- 레이어팝업(결제실패) -->
<div class="popup failPopup" style="display:none;">
    <p class="dimmed"></p>
    <div class="popup_layout">
        <p class="warning">
            <strong>Sorry, unexpected error ocurred.</strong>
            If you have any other inquiries,<br>
            please contact us by e-mail. <span>ask_pbph@zepetto.biz</span><br>
            Thank you.
        </p>
        <div class="pop_btn">
            <a class="btn_rd" href="javascript:;">Close</a>
        </div>
    </div>
</div>
<!-- //레이어팝업(결제실패) -->

<!-- 레이어팝업(문구 노출)-->
<div class="popup textlayer" style="display:none;">
    <p class="dimmed"></p>
    <div class="popup_layout">
        <p class="warning">
        </p>
        <div class="pop_btn">
            <a class="btn_rd" href="javascript:;">Close</a>
        </div>
    </div>
</div>
<!-- //레이어팝업 -->

<!-- 레이어팝업(PPCARD 결제 실패) -->
<div class="popup ppcardFailPopup" style="display:none;">
    <p class="dimmed"></p>
    <div class="popup_layout">
        <p class="warning">
            <strong>Sorry, unexpected error ocurred.</strong>
            <span id="ppcardErrMsg"></span><br><br>
            If you have any other inquiries,<br>
            please contact us by e-mail. <span>ask_pbph@zepetto.biz</span><br>
            Thank you.
        </p>
        <div class="pop_btn">
            <a class="btn_rd" href="javascript:;">Close</a>
        </div>
    </div>
</div>
<!-- //레이어팝업(결제실패) -->

<!-- 레이어팝업(VA, CVS) -->
<div class="popup resultLayer" style="display:none;">
    <p class="dimmed_resultlayer"></p>
    <div class="popup_layout popup_layout_cvs">
        <h3 id="resultLayerTitle"></h3>
        <p class="info">
            <span class="stit" id="resultLayerName"></span>
            <label id="resultLayerNo"></label>
        </p>
        <table class="bbs_board" cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="40%">
                <col width="60%">
            </colgroup>
            <tbody><tr>
                <th id="resultLayerTarget"></th>
                <td id="resultLayerTargetName"></td>
            </tr>
            <tr>
                <th>VALUE</th>
                <td id="resultLayerDescription"></td>
            </tr>
            <tr>
                <th>CUSTOMER NAME</th>
                <td id="resultLayerUserName"></td>
            </tr>
            <tr>
                <th>ORDER NUMBER</th>
                <td id="resultLayerOrderNo"></td>
            </tr>
            <tr>
                <th>EXPIRATION DATE</th>
                <td id="resultLayerVaildDate"></td>
            </tr>
        </tbody></table>
        <div class="pop_btn">
            <a class="btn_rd" href="#">TUTUP</a>
        </div>
    </div>
</div>
<!-- //레이어팝업(VA, CVS) -->
        <!---------- END BODY ---------->
    </div>

    <!---------- BEGIN FOOTER ---------->
    <footer>
        <img src="/Common/Images/footer_zepetto.png" alt="PT. Zepetto Interactive Philippines">
        <p>2020</p>
        <a class="top" href="#">TOP</a>
    </footer>
    <!---------- END FOOTER ---------->


    <!---------- BEGIN AJAX LODER IMAGE ---------->
    <section class="loding"><p><img src="/Common/Images/loading.gif" alt="Loading"></p></section>

    <!---------- END AJAX LODER IMAGE ---------->

    <!---------- BEGIN BLOCK CSRF TOKE ---------->
    <input name="__RequestVerificationToken" type="hidden" value="xigGJxDcZ47opZ779wYSE1X3yVwvQZyBOfM7FUiDUfkHrm4YiW7816_b9bjnNC4Zjh0UjqItVji06zC7H7W5rtBtFFz6VLkfOowVBenQL1k1">
    <!---------- END BLOCK CSRF TOKE ---------->

    <!---------- BEGIN FOOTER SCRIPT ---------->
    <!---------- BEGIN FOOTER SCRIPT ---------->

</body></html>