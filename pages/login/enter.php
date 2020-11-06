


<!doctype html>
<html>
<?php 
error_reporting(0);
session_start();
if (($_SESSION['username'])) {
    echo "<script>alert('Você já está logado uma conta!');</script><script>window.location = '../../index.php';</script>";
    exit;
    }
require ('../../_includes/header.php');


$a =  $_SERVER["REQUEST_URI"];
 $block = substr($a, 21, 1000);

	?>

<script src="https://www.google.com/recaptcha/api.js?render=6LeEFuIUAAAAAKaIu92OWbsh_JPyApmAh_WssVeO"></script>
<script>
  grecaptcha.ready(function() {
      grecaptcha.execute('6LeEFuIUAAAAAKaIu92OWbsh_JPyApmAh_WssVeO', {action: 'userForm'}).then(function(token) {
         // console.log(token);
         document.getElementById("token").value = token;
		 
      });
  });
  
  </script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140313192-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140313192-2');
</script>

	<script type="text/javascript" src="/js/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/common_ie8.css">
	<![endif]-->
<script type="text/javascript">
function windowClose() {
    var data = "{\"type\" : \"aone_layer_popup_close\"}";
    window.parent.postMessage(data, "*");
}
function windowResize(val) {
	var data = "{\"type\" : \"aone_iframe_resize\", \"height\" : \""+val+"\"}";
	window.parent.postMessage(data, "*");
}
function windowLoc(val) {
	var data = "{\"type\" : \"aone_location_change\", \"location\" : \""+val+"\"}";
	window.parent.postMessage(data, "*");
}
function windowReload() {
	var data = "{\"type\" : \"aone_page_reload\"}";
	window.parent.postMessage(data, "*");
}
function windowSetValue(id, val) {
	var data = "{\"type\" : \"aone_set_value\", \"id\" : \""+id+"\", \"value\" : \""+val+"\"}";
	window.parent.postMessage(data, "*");
}
</script>
</head>
<body>
	<div id="popup_wrap">
		<h2>Login<a href="javascript:windowClose();">CLOSE</a></h2>
		<form name="userForm" id="userForm" method="post" action="process.php">
		<input type="hidden" name="loginFail" id="loginFail" value="0"/>
		<div class="pop_cont">
			<div class="social_login">
			</div>
			<div class="division"><strong>LOGIN</strong></div>
			<div class="entry">
				<p class="input">
					<label id='id'>ID</label>
					<input type='text'  id="login" name="username" onfocus='inon(this,"id");' onblur='inout(this,"id");' onkeyup='inup(this,"id");'  maxlength="17">
				</p>
				<p class="input only">
					<label id='pw'>PASSWORD</label>
					<input type='password'id="pass" name="password" type="password" onfocus='inon(this,"pw");' onblur='inout(this,"pw");' onkeyup='inup(this,"pw");'>
				</p>
			</div>			
				
		</div>
		<div class="pop_btn">
			<p class="btn_h72"><a class="btn_rd" href="javascript:void(0);" onclick="javascript:sendIt();">LOGIN</a></p>
		</div>
		<input type="hidden" id="token" name="token">
		<input type="hidden" name="urlreturn" value="<?php echo $block ?>"> 
		</form>
		
		<div class="loding"><p><img src="/images/loading.gif" alt="Loading"></p></div>
	</div>
	<script type="text/javascript">
//<![CDATA[
function inon(obj,idnm)
{if(obj.value=='') document.getElementById(idnm).style.display='none'; obj.className='entry'}
function inout(obj,idnm)
{if(obj.value=='') document.getElementById(idnm).style.display='block'; obj.className='basic'}
function inup(obj,idnm)
{if(obj.value.lengt>0) document.getElementById(idnm).style.display='none';}

function drawMsg(focusId, str) {
	alert(str);
	if ($.trim(focusId)!="") $("#"+focusId).focus();
}

function formSend() {
	sendIt();
	return false;
}

function sendIt() {
	var regEng = /[a-zA-Z]/g;
    var regExp = /^[A-Za-z0-9]{1}([-_.]|[A-Za-z0-9]){4,15}$/;
    
	if ($.trim($("#login").val())=="") {
    	drawMsg("login", "Coloque seu ID");
        return;
	}
	else if ($.trim($("#login").val()).length < 3 || $.trim($("#login").val()).length > 16) {
		drawMsg("login", "Por favor,coloque seu ID De 3  caracteres ou mais");
		return;
	}
	else if (!$('#login').val().match(regExp)) {
		drawMsg("login", "Opa! Palavras digitadas não são Alphanumeros!");
		return;
	}
	
	if ($.trim($("#pass").val()).length <= 0) {
		drawMsg("pass", "Digite sua senha!");
		return;
	}
    
    var frm = $("#userForm");
    
    frm.attr("method", "POST");
	frm.attr("name", "submit");
    frm.attr("action", "/pages/login/process.php");
    //frm.attr("onsubmit", "return true");
    frm.submit();
}

$(document).ready(function() {
    $("#password").keyup(function (key) {
        if (key.keyCode == 13) {
        	formSend();
        }
    });
	document.getElementById('btnFacebookLogin').addEventListener('click', function() {
		var data = "{\"type\" : \"aone_facebook_login\"}";
		window.parent.postMessage(data, "*");
	});
	windowResize('543');
});
//]]>
</script>
	<script type="text/javascript"> 
		//<![CDATA[
		function inon(obj,idnm)
		{if(obj.value=='') document.getElementById(idnm).style.display='none'; obj.className='entry'}
		function inout(obj,idnm)
		{if(obj.value=='') document.getElementById(idnm).style.display='block'; obj.className='basic'}
		function inup(obj,idnm)
		{if(obj.value.lengt>0) document.getElementById(idnm).style.display='none';}
		
		function drawMsg(focusId, str) {
			alert(str);
			if ($.trim(focusId)!="") $("#"+focusId).focus();
		}
		//]]>
	</script>
	
</body>
</html>