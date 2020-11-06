<?php
session_start();
 error_reporting(0);
 if (!isset($_SESSION['username'])) {
	echo "<script>alert('Por Favor, Faça o login primeiro!');</script><script>window.location = '/';</script>";
	exit;
	}
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
        <a href="">
            <p class="headerText">PB RECARGA CENTER</p>
        </a>
        <ul>
            <li class="cash">
                <p class="pCash"><strong class="cashreal"><?php echo "".$ranking['money'].""; ?></strong> Cash</p>
                <p class="bonus"><strong class="cashbonus"><?php echo "".$ranking['pc_cafe'].""; ?> </strong>VIP</p>
                <a href="" class="userinfoRefresh">Reload</a>
            </li>
            <li class="my"><?php echo "".$ranking['player_name'].""; ?></li>
            <li class="logout"><a href="/index.php" id="userlogout">SAIR DA RECARGA</a></li>
        </ul>
    </header>
    <!---------- EDN HEADER ---------->

    <!---------- BEGIN Event Banner ---------->
    <!---------- EDN Event Banner ---------->

    <div>
        <!---------- BEGIN BODY ---------->
        


<script type="text/javascript">

    var testUserFlag = "N";

    $(document).ajaxError(function (xhr, props) {
        if (props.status === 302) {
            window.location.href = '/Topup/Index';
        }
    });

    $(document).ready(function () {

        //충전 성공으로 들어왔을 경우 결과 layer popup 노출
        if ("") {

            if ("" == "Y") {
                $(".successPopup").show();
            }
            else if ("" == "P") {
                if ("" == "PPCARD") {
                    $(".ppcardFailPopup").find("#ppcardErrMsg").html("");
                    $(".ppcardFailPopup").show();
                }
            }
            else {
                $(".failPopup").show();
            }
        }

        //PG 선택 시 PG 영역 변경
        $(".pg_list").find("li").on("click", function () {
            var _this = $(this);

            //테스트 계정이 아니면서 PG의 alert사용여부가 Y일 경우 alert 노출.
            if (testUserFlag != "Y" && _this.data("alertflag") == "Y") {
                alert(_this.data("alertmsg"));
            }

            //선택한 PG로 Class 변경.
            $(".pg_list").find("li").removeClass();
            _this.addClass("current");

            $.get(
                '/Topup/Page',
                {
                    page         : _this.data('page-name')
                   ,subpgcode    : _this.data('subpgcode')
                   ,displaytitle : _this.find("p").text()
                },
                function (response) {
                    $('.pgarea').empty();
                    $('.pgarea').html(response);

                    //테스트 계정이 아니면서 PG의 alert사용여부가 Y일 경우 해당 PG의 선택 및 입력 안되도록 disabled 처리.
                    if (testUserFlag != "Y" && _this.data("alertflag") == "Y") {
                        $(".pgarea").find("input[type=radio]").attr("disabled", true);
                        $(".pgarea").find("input[type=text]").attr("disabled", true);
                    }
                }
            );
        });

        // layer popup close.
        $(".popup .dimmed, .pop_btn a").on("click", function () {
            $(".popup").hide();
        });

        function fnResultCheck() {
            var dTime = new Date();
            var dTime30SecAfter = new Date(Date.parse(dTime) + 30000);
            var secGap = (dTime.getTime() - dTime30SecAfter.getTime()) / 1000;

            // 1분마다 체크.
            var pgPaylogChk = setInterval(function () {

                if (secGap < 0) {

                    // Ajax PgPaylogChk
                    strCallUrl = "/Topup/PGPayLogChk";
                    arrParameter = {
                        EncOrderNo: ""
                    };
                    BOQ.Ajax.jQuery.fnRequest(REQUESTTYPE.JSON, arrParameter, strCallUrl, function (objJson) {
                        if (objJson.intStateCode == 2) {
                            $(".loding").fadeOut();     // 로딩 이미지 숨김.
                            $(".successPopup").show();  // 성공 Layer Popup 노출.
                            clearInterval(pgPaylogChk); // setInterval 중지.
                        }
                    });
                    secGap++;
                } else {
                    $(".loding").fadeOut();
                    $(".failPopup").show();
                    clearInterval(pgPaylogChk);
                }
            }, 1000);
        }
    });

</script>

<input type="hidden" id="hidLoginUserID" name="hidLoginUserID" value="skillerm12">

<?php }else{
     echo "<script>alert('Voce ainda não tem personagem!');</script><script>window.location = '../../index.php';</script>";
     exit;
     }
     ?>