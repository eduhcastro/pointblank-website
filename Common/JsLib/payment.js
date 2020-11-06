

$(function () {
    // 결제 요청
    $(".btnPay").on("click", function () {
        
        //테스트 계정이 아니면서 PG의 alert사용여부가 Y일 경우 alert 노출.
        if (testUserFlag != "Y" && $(".pg_list .current").data("alertflag") == "Y") {
            alert($(".pg_list .current").data("alertmsg"));
            return;
        }

        //충전금액 유효성 체크
        if ($("input[name=price]").is(":disabled") == false && $("input[name=price]:checked").length == 0 && $(".pg_list .current").data("page-name") != "PPCARD" && $(".pg_list .current").data("page-name") != "GOCPPCARD") {
            alert(BOQ.Msg.fnMultiLanguage("Select_PayAmt"));
            return;
        }

        //결제수단 유효성 체크
        if ($("input[name=_paymethod]").is(":disabled") == false && $("input[name=_paymethod]:checked").length == 0
                && $(".pg_list .current").data("page-name") == "XIMPAY") {
            alert(BOQ.Msg.fnMultiLanguage("Select_PayMethod"));
            return;
        }


        //PPCARD 입력값 유효성 체크
        if ($(".pg_list .current").data("page-name") == "PPCARD") {
            var chkresult = fnCheckPPCardValidation();

            if (chkresult == false) {
                return;
            }
        }

        //GPOQ 입력값 유효성 체크, hwjang@payletter.com, 2019-06-28
        if ($(".pg_list .current").data("page-name") == "GPOQ-MOL") {
            var chkresult = fnCheckGPOQPayValidation();

            if (chkresult == false) {
                return;
            }

            var emaiValid = BOQ.Utils.fnEmailValid($("#payeremail").val());
            if (!emaiValid) {
                $(".textlayer").find(".warning").text(BOQ.Msg.fnMultiLanguage("Email_Valid_Msg"));
                $(".textlayer").show();
                $("#payeremail").parent().addClass("wrong");
                return;
            }
        }

        // loading image show.
        $(".loding").fadeIn();

        //PayForm에 데이터 세팅
        var $payFrm        = $("#payFrm");
        var $pbcash        = $(".purchase input[name=price]:not(:disabled):checked");
        var $paymentMethod = ($(".pg_list .current").data("page-name") == "XIMPAY") ? $(".paymentMethod input[name=_paymethod]:not(:disabled):checked").val() : $(".pg_list .current").data("subpgdesc");

        $payFrm.find("input[name=paymethod]").val($paymentMethod);
        $payFrm.find("input[name=paytoolcode]").val($(".pg_list .current").data("paytool"));
        $payFrm.find("input[name=pgcode]").val($(".pg_list .current").data("page-name"));
        $payFrm.find("input[name=mallid]").val($(".pg_list .current").data("mallid"));
        $payFrm.find("input[name=subpgcode]").val($(".pg_list .current").data("subpgcode"));
        $payFrm.find("input[name=currencycode]").val($(".pg_list .current").data("currencycode"));
        $payFrm.find("input[name=payamt]").val($pbcash.val());
        $payFrm.find("input[name=cashamt]").val($pbcash.data("real-cash"));
        $payFrm.find("input[name=displaytitle]").val($pbcash.data("display-title"));
        $payFrm.find("input[name=currencysymbol]").val($pbcash.data("currency-symbol"));
        $payFrm.find("input[name=totalpayamt]").val(Number($pbcash.val()));
        $payFrm.find("input[name=vatamt]").val("0");
        $payFrm.find("input[name=topupemail]").val($(".purchase input[name=topupemail]").val());
        
        //PPCARD 전용 Param
        $payFrm.find("input[name=ppcardno]").val($("#ppcardno").val());

        //GPOQ-MOL 전용 Param
        $payFrm.find("input[name=payeremail]").val($("#payeremail").val());

        $payFrm.submit();
    });

    //-----------------------------------------------------------------------------
    //-- PPCARD 입력값 유효성 체크
    //-----------------------------------------------------------------------------
    function fnCheckPPCardValidation() {
        if ($("#ppcardno").val() == '') {
            $("#ppcardno").parent().addClass("wrong");
            $("#validmessageforlength").hide();
            $("#validmessageforempty").show();

            return false;
        }
        else if ($("#ppcardno").val().length != 16) {
            $("#validmessageforempty").hide();
            $("#validmessageforlength").show();

            return false;
        }
        else {
            $("#validmessageforempty").hide();
            $("#validmessageforlength").hide();

            return true;
        }
    }

    //-----------------------------------------------------------------------------
    //-- GPOQ 입력값 유효성 체크, hwjang@payletter.com, 2019-06-28
    //-----------------------------------------------------------------------------
    function fnCheckGPOQPayValidation() {

        var chkresult = true;

        if ($("#payeremail").val() == '') {
            $("#payeremail").parent().addClass("wrong");

            chkresult = false;
        }
        else {

            chkresult = true;
        }

        if (chkresult == false) {
            $("#validmessageforempty").show();
            return false;
        }
        else {
            $("#validmessageforempty").hide();
            return true;
        }
    }

    // 쿠폰 등록
    $("#btnCouponReg").on("click", function () {

        var couponno = $("#couponno").val();

        //쿠폰 번호가 없을 경우.
        if (couponno == "")
        {
            $(".failPopup").find("#couponErrMsg").text(BOQ.Msg.fnMultiLanguage("Coupon_EmptyMsg"));
            $(".failPopup").show();
            return;
        }

        // loading image show.
        $(".loding").show();
        
        strCallUrl = "/Coupon/Register";
        arrParameter = {
            couponno : couponno
        };
        strCallBack = "fnResultRet";
        BOQ.Ajax.jQuery.fnRequest(REQUESTTYPE.JSON, arrParameter, strCallUrl, strCallBack);
    });

});

