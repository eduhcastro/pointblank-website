<?php
session_start();
 error_reporting(0);
require_once('../../include.php');
require('../../class/Ranking.class.php');
require('../../class/nome_patente.php');
require('../../_includes/rankp.php');

if($ranking['player_name'] = $ranking['player_name']) {
    ?>
<html style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms no-csstransforms3d csstransitions fontface no-generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head>
    <meta name="Recarga PB Fatality" content="You can purchase the Point Blank Cash (PB CASH) via using Point Blank E-pin(Voucher) from Load central, Dragonpay, Razer Gold, Gamer and more.">
    <meta property="og:type" content="Point Blank PH website">
    <meta property="og:title" content="Recarga PB Fatality">
    <meta property="og:url" content="https://pbtopup.zepetto.com/Topup/Index">
    <meta property="og:description" content="You can purchase the Point Blank Cash (PB CASH) via using Point Blank E-pin(Voucher) from Load central, Dragonpay, Razer Gold, Gamer and more.">
    <meta property="og:image" content="https://pointblank.zepetto.com/images/pbph.jpg">
    <meta name="keywords" content="point blank how to pay, Point blank top up Point Blank PH Top up, pb Top up, pbph Top up, pointblank zepetto Top up, point blank Top up, pb point blank Top up, pbph Top up, pointblank ph Top up, FPS, online, olinegsme, game point blank Top up ,point blank, game pb, pb game, point blank garena Top up, point pb Top up, garena pb Top up, zepetto pb Top up, zepetto pointblank Top up, Load central,dragonpay,Razer Gold,Gamer">
    <meta name="description" content="You can purchase the Point Blank Cash (PB CASH) via using Point Blank E-pin(Voucher) from Load central, Dragonpay, Razer Gold, Gamer and more.">
    <meta name="Recarga PB Fatality" content="You can purchase the Point Blank Cash (PB CASH) via using Point Blank E-pin(Voucher) from Load central, Dragonpay, Razer Gold, Gamer and more.">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title>Recarga PB Fatality</title>
    <!---------- BEGIN HEADER STYLESHEET ---------->
    <link href="/boqcssbundle?v=lnIRaVv9A7_PcFivEdQwWuDu9jgDt_CQtvYlmev9ap81" rel="stylesheet">

    

    <!---------- END HEADER STYLESHEET ---------->
    <link rel="stylesheet" type="text/css" href="/Common/Css/purchase.css">
    <link rel="shortcut icon" href="/Common/Images/favicon.ico">

    <!---------- BEGIN HEADER SCRIPT ---------->
    <script type="text/javascript" src="/Common/JsLib/jQuery/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="/Common/JsLib/jQuery/jquery.ajax-retry.min.js"></script>
    <script src="/boqjsbundle?v=coLEi8JzlPLRoZ2-nVMVVWk2SyBmeWGx8SrcLe4veco1"></script>

    <script type="text/javascript">
    if (self === top)
    {
        var antiClickjack = document.getElementById("antiClickjack");
        antiClickjack.parentNode.removeChild(antiClickjack);
    }
    else
    {
        top.location = self.location;
    }
</script>

    <!---------- END HEADER SCRIPT ---------->

    <!---------- BEGIN CUSTOM SCRIPT ---------->

    <script type="text/javascript" src="/Common/JsLib/payment.js"></script>
    <script type="text/javascript">

        $(document).ajaxError(function (xhr, props) {
            if (props.status === 302) {
                window.location.href = '/History/Index';
            }
        });

        $(document).ready(function () {

            // 첫페이지 Topup 호출
            fnAjaxHistory('Topup', 1);

            $("#selHistory").on("change", function () {
                fnAjaxHistory($(this).val(), 1);
            });

            $("#selMonth").on("change", function () {
                var _this = $(this);
                if(_this.val() > 0) {
                    $("#txtDate").attr("disabled", false);
                } else {
                    $("#txtDate").attr("disabled", true).val("");
                    $("label[id=date]").show();
                }
            });

            $(".popup .dimmed, .pop_btn a").on("click", function () {
                $(".popup").hide();
            });
            
            $("#txtDate").keyup(function () {
                if ($(this).val() > 31) {
                    $(this).val($(this).val().slice(0, -1));
                }
                $(this).val($(this).val().replace(/[^0-9]/g, ""));
            });

            $("#txtDate").blur(function () {
                if ($(this).val() > 31) {
                    $(this).val($(this).val().slice(0, -1));
                }
                $(this).val($(this).val().replace(/[^0-9]/g, ""));
            });
            
        });

        function fnSearchList() {
            var selPage = $("#selHistory").val();

            //일자가 비어있을 경우 선택한 월 전체로 검색하기 때문에 일자가 비어있지 않고 1일보다 적은 숫자가 들어올 경우 1일로 변경
            if($("#txtDate").val() != "" && $("#txtDate").val() < 1) {
                $("#txtDate").val(1);
            }

            fnAjaxHistory(selPage, 1);
        }

        function fnAjaxHistory(pageFlag, pageNo) {

            var strFromYmd = BOQ.Utils.fnFromYmd($("#selYear").val(), $("#selMonth").val(), $("#txtDate").val());
            var strToYmd   = BOQ.Utils.fnToYmd($("#selYear").val(), $("#selMonth").val(), $("#txtDate").val());
            
            if (pageNo == undefined) {
                pageNo = $("#hidPageNo").val();
            }
            else {
                $("#hidPageNo").val(pageNo)
            }

            strCallUrl = "/History/" + pageFlag;
            arrParameter = {
                "pageNo"  : pageNo,
                "pageFlag": pageFlag,
                "fromYmd" : strFromYmd,
                "toYmd"   : strToYmd
            };
            strCallBack = "fnResultRet";
            BOQ.Ajax.jQuery.fnRequest(REQUESTTYPE.JSON, arrParameter, strCallUrl, strCallBack);
        }

        function fnResultRet(objJson) {

            var strHtml = "";
            if (objJson.ErrCode == 0) {
                var trbg = "";
                var tdStatus = "";
                var tData = objJson.ListData.list;

                strHtml += fnCollGroupSet(objJson.ListData.pageFlag);

                if (tData.length > 0) {

                    for (var i = 0; i < tData.length; i++) {
                        var tElement = tData[i];

                        trbg = (i % 2 == 1) ? "bg" : "";

                        if (objJson.ListData.pageFlag == "Topup") {
                            strHtml += "<tr class='" + trbg + "'>";
                            strHtml += "    <td>" + tElement.intRowNum + "</td>";
                            strHtml += "    <td>" + tElement.strPayYMD + "</td>";
                            strHtml += "    <td>" + tElement.strPayToolCode + "</td>";
                            strHtml += "    <td>" + BOQ.Utils.fnComma(tElement.dbCashAmt) + "</td>";
                            strHtml += "    <td>" + BOQ.Utils.fnComma(tElement.dbRemainCAshAmt) + "</td>";

                            tdStatus = (tElement.strCnlFlag == "N") ? "<p class='state state_basic'>" + BOQ.Msg.fnMultiLanguage("Normal") + "</p>" : "<p class='state state_cancel'>" + BOQ.Msg.fnMultiLanguage("Cancel") + "</p>";
                            strHtml += "    <td>" + tdStatus + "</td>";
                            strHtml += "</tr>";
                        }
                        else if (objJson.ListData.pageFlag == "Cash") {
                            strHtml += "<tr class='" + trbg + "'>";
                            strHtml += "    <td>" + tElement.intRowNum + "</td>";
                            strHtml += "    <td>" + tElement.strPurchaseYMD + "</td>";
                            strHtml += "    <td>" + tElement.strGameCode + "</td>";
                            strHtml += "    <td>" + tElement.strProductName + "</td>";
                            strHtml += "    <td>" + BOQ.Utils.fnComma(tElement.dbPurchasePrice) + "</td>";

                            tdStatus = (tElement.strCnlFlag == "N") ? "<p class='state state_basic'>" + BOQ.Msg.fnMultiLanguage("Normal") + "</p>" : "<p class='state state_cancel'>" + BOQ.Msg.fnMultiLanguage("Cancel") + "</p>";
                            strHtml += "    <td>" + tdStatus + "</td>";
                            strHtml += "</tr>";
                        }
                        else if (objJson.ListData.pageFlag == "Coupon") {
                            strHtml += "<tr class='" + trbg + "'>";
                            strHtml += "    <td>" + tElement.intRowNum + "</td>";
                            strHtml += "    <td>" + tElement.dtUseYMd + "</td>";
                            strHtml += "    <td>" + tElement.strCouponName + "</td>";
                            strHtml += "    <td>" + tElement.strCouponNo + "</td>";

                            tdStatus = (tElement.intUseStateCode == "2") ? "<p class='state state_used'>" + BOQ.Msg.fnMultiLanguage("Used") + "</p>" : "<p class='state state_basic'>" + BOQ.Msg.fnMultiLanguage("Normal") + "</p>";
                            strHtml += "    <td>" + tdStatus + "</td>";
                            strHtml += "</tr>";
                        }

                        P_intCurrentIndex  = $("#hidPageNo").val();
                        P_intPageSize      = BOQ.PAGESIZE;
                        P_intTotalRowCount = objJson.ListData.intRecordCnt;
                        P_strPageName      = objJson.ListData.pageFlag;
                        P_LstFunctionName  = "fnAjaxHistory";

                        fnDrawPaging("div_pager");
                    }
                }
                else {
                    var colspanCnt = (objJson.ListData.pageFlag == "Topup" || objJson.ListData.pageFlag == "Cash") ? 6 : 5;

                    strHtml += "<tr>";
                    strHtml += "    <td class=\"none\" colspan=\"" + colspanCnt + "\">";
                    strHtml += "        <p class=\"nodata\">" + BOQ.Msg.fnMultiLanguage("HistoryNotFound") + "</p>";
                    strHtml += "    </td>";
                    strHtml += "</tr>";

                    $("#div_pager").empty();
                }

                $("#bbs_list").html(strHtml);
            }
            else
            {
                $(".failPopup").show();
            }
        }

        function fnCollGroupSet(pageFlag) {
            var html = "";
            if (pageFlag == "Topup") {
                html += "<colgroup>";
                html += "    <col width=\"10%\">";
                html += "    <col width=\"15%\">";
                html += "    <col width=\"20%\">";
                html += "    <col width=\"20%\">";
                html += "    <col width=\"20%\">";
                html += "    <col width=\"15%\">";
                html += "</colgroup>";
                html += "<tr class=\"bbs_tit\">";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Number") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Date") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("TopupMethod") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Value") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Balance") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Status") + "</th>";
                html += "</tr>";
            }
            else if (pageFlag == "Cash") {
                html += "<colgroup>";
                html += "    <col width=\"10%\">";
                html += "    <col width=\"15%\">";
                html += "    <col width=\"10%\">";
                html += "    <col width=\"30%\">";
                html += "    <col width=\"15%\">";
                html += "    <col width=\"20%\">";
                html += "</colgroup>";
                html += "<tr class=\"bbs_tit\">";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Number") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Date") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Game") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Item") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Value") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Status") + "</th>";
                html += "</tr>";
            }
            else if (pageFlag == "Coupon") {
                html += "<colgroup>";
                html += "    <col width=\"10%\">";
                html += "    <col width=\"15%\">";
                html += "    <col width=\"30%\">";
                html += "    <col width=\"25%\">";
                html += "    <col width=\"20%\">";
                html += "</colgroup>";
                html += "<tr class=\"bbs_tit\">";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Number") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Date") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Coupon_Name") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Coupon_Code") + "</th>";
                html += "    <th scope=\"col\">" + BOQ.Msg.fnMultiLanguage("Status") + "</th>";
                html += "</tr>";
            }

            return html;
        }

        //<![CDATA[
        function inon(obj, idnm)
        { if (obj.value == '') document.getElementById(idnm).style.display = 'none'; obj.className = 'entry' }
        function inout(obj, idnm)
        { if (obj.value == '') document.getElementById(idnm).style.display = 'block'; obj.className = 'basic' }
        function inup(obj, idnm)
        { if (obj.value.lengt > 0) document.getElementById(idnm).style.display = 'none'; }
        //]]>
    </script>
    <!---------- END CUSTOM SCRIPT ---------->


    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <link rel="stylesheet" type="text/css" href="~/Common/Css/purchase_ie8.css">
    <![endif]-->
    <!-- ****JS 파일 확인 -->

    <script type="text/javascript">
        $(document).ready(function () {
            //Text 세팅.
            $(".headerText").text(BOQ.Msg.fnMultiLanguage("PbRefillCenter"));
            $(".pCash").append(BOQ.Msg.fnMultiLanguage("Cash"));
            $(".bonus").append(BOQ.Msg.fnMultiLanguage("Bonus_Cash"));
            $("#userlogout").text(BOQ.Msg.fnMultiLanguage("Logout"));

            // 페이지 호출 시 유저 잔액 정보 조회.
            fnUserInfo();

            // 유저 잔액 Refresh
            $(".userinfoRefresh").on("click", function () {
                fnUserInfo();
            });

            function fnUserInfo() {
                strCallUrl = "/User/UserInfo";
                arrParameter = {};
                BOQ.Ajax.jQuery.fnRequest(REQUESTTYPE.JSON, arrParameter, strCallUrl, function (objJson) {
                    $(".cashreal").text(BOQ.Utils.fnComma(objJson.dbCashReal));
                    $(".cashbonus").text(BOQ.Utils.fnComma(objJson.dbCashbonus));
                });
            }

            //배너 선택 시 링크 이동.
            $("#bannerSection").on("click", function () {
                var BannerLink = $(this).find("a").attr("href");
                if (BannerLink != "" && BannerLink != "#") {
                    location.href = BannerLink;
                }
            });

            //로그 아웃
            $("#userlogout").on("click", function () {
                var $form = $("<form id='logout'></form>");
                $form.attr("action", "/Logout");
                $('body').append($form);
                $form.submit();
            });

        });
        
    </script>

</head>
<body>
    <!---------- BEGIN HEADER ---------->
    <header>
        <a href="/"><img src="/Common/Images/logo_PB.png" alt="PB"></a>
        <a href="/">
            <p class="headerText">PB REFILL CENTER</p>
        </a>
        <ul>
            <li class="cash">
                <p class="pCash"><strong class="cashreal"><?php echo "".$ranking['money'].""; ?></strong> Cash</p>
                <p class="bonus"><strong class="cashbonus"><?php echo "".$ranking['pc_cafe'].""; ?> </strong>VIP</p>
                <a href="" class="userinfoRefresh">Reload</a>
            </li>
            <li class="my"><?php echo "".$ranking['player_name'].""; ?></li>
            <li class="logout"><a href="/" id="userlogout">SAIR DA RECARGA</a></li>
        </ul>
    </header>
    <!---------- EDN HEADER ---------->

    <!---------- BEGIN Event Banner ---------->
    <!---------- EDN Event Banner ---------->

    <div>
        <!---------- BEGIN BODY ---------->
        



<section class="sub_purchase">
    <ul class="tab">
        <li class="topup" date-view-page="Topup"><a href="/pages/recarga">RECARGA</a></li>
        <li class="coupon" date-view-page="Coupon"><a href="/pages/cupon">COUPON</a></li>
        <li class="history current" date-view-page="History"><a href="">HISTORY</a></li>
    </ul>
    <div class="bbs">
        <div class="bbs_top">
            <select id="selHistory">
                <option value="Topup">Tudo</option>
            </select>
            <div class="search">
                <p class="input">
                  
                
     
            </div>
        </div>
        <input type="hidden" id="hidPageNo" value="1">
        <table class="bbs_list" id="bbs_list" cellpadding="0" cellspacing="0"><colgroup>    <col width="10%">    <col width="15%">    <col width="20%">    <col width="20%">    <col width="20%">    <col width="15%"></colgroup><tbody><tr class="bbs_tit">    <th scope="col">NUMERO</th>    <th scope="col">DATA</th>    <th scope="col">Metodo Pagamento</th>    <th scope="col">PIN</th>    <th scope="col">VALOR</th>    <th scope="col">STATUS</th></tr><tr>    <td class="none" colspan="6">        
            
      
								
							
							<?php 				
              
              $num = 1;
                    $recargaco = "SELECT * FROM pin_log WHERE login = '$_SESSION[username]' ORDER BY data DESC LIMIT 10";
			   
                    foreach ($db->query($recargaco) as $log) 
                    {

			
                        
       echo "<tr>";
       echo '<td class="win"><p class="champion">'.$num.'</p></td>';
        echo '<td class="change">'.$log['data'].'</td>';
		echo '<td class="tit">PINCODE</td>';
		echo '<td class="rank">';
		echo $log['pin']."</td>";
            echo '<td>'.$log['valor'].'</td>';
            echo "<td>SUCESSO</td>";
            $num++;
            echo'</tr>';
            
                } 
            ?>
            
         </td></tr></tbody></table>
        <div id="div_pager" class="paging"></div>
    </div>
</section>

<!-- 레이어팝업 -->
<div class="popup failPopup" style="display: none;">
    <p class="dimmed"></p>
    <div class="popup_layout">
        <p class="warning">
            <strong>Sorry, unexpected error ocurred.</strong>
            If you have any other inquiries,<br>
            please contact us by e-mail. <span>pbcs_topup@zepetto.com</span><br>
            Thank you.
        </p>
        <div class="pop_btn">
            <a class="btn_rd" href="javascript:;">Close</a>
        </div>
    </div>
</div>
<!-- //레이어팝업 -->
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
    <!---------- END BLOCK CSRF TOKE ---------->

    <!---------- BEGIN FOOTER SCRIPT ---------->
    <!---------- BEGIN FOOTER SCRIPT ---------->

</body></html>


<?php }else{
     echo "<script>alert('Voce ainda não tem personagem!');</script><script>window.location = '../../index.php';</script>";
     exit;
     }
     ?>