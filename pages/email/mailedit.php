


<!doctype html>
<html>
<?php 
  session_start();
  error_reporting();

  $db = new PDO('pgsql:dbname=postgres;host=127.0.0.1;port=5535', 'postgres', '871414');
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  function encripitar($senha){
      $salt = '/x!a@r-$r%an¨.&e&+f*f(f(a)';
      $output = hash_hmac('md5', $senha, $salt);
      return $output;
  }
  
  
  
  if (!isset($_SESSION['username'])) {
  echo "<script>alert('Por Favor, Faça o login primeiro!');</script><script>window.location = '/';</script>";
  exit;
  }
  $uniquedx = $db->query("SELECT * FROM accounts WHERE login = '$_SESSION[username]';");
  $row = $uniquedx->fetch();
  $uniqueid = $row['uniqueid'];

  if ($uniqueid == '') {
  echo "<script>alert('Por Favor, Gere sua key primeiro!');</script><script>windowClose();</script>";
  exit;
  }
    
    //function keyid($q){
        //$cryptKey  = 'dqwoindqwoiiwiw1982912n';
        //$qEncoded      = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey) ) ) );
        //return( $qEncoded );
    //}
    
    if(@$_POST['go']){
            $username = $_SESSION['username'];
            $pass = $_POST['oldmail'];
            $npassword = $_POST['newmail'];
            $rpassword = $_POST['rmail'];
            $key = $_POST['keyid'];
            $captcha = $_POST['captcha'];
            $captchacorrect = $_SESSION['cap_code'];
                
            $stmt = $db->query("SELECT * FROM accounts WHERE login = '$username'");
    
            while ($rows = $stmt->fetch()){
            $dbuser = $rows['login'];
            $dbpassword = $rows['email'];
            $dbkey = $rows['uniqueid'];
            }
            
            if ($pass == '' || $npassword == '' || $rpassword == '' || $captcha == '' || $key == ''){
                echo "<script>alert('Complete Todos os Campos.');</script><script>window.location='#';</script>";
            }elseif ($npassword != $rpassword){
                echo "<script>alert('A confirmação de email não corresponde.');</script><script>window.location='#';</script>";
            }elseif ($pass != $dbpassword || $key != $dbkey){
                echo "<script>alert('Key Incorreta!.');</script><script>window.location='#';</script>";
            }elseif ($npassword == $pass){
                echo "<script>alert('O novo email é igual ao antigo email.');</script><script>window.location='#';</script>";
            }elseif ($captcha != $captchacorrect){
                echo "<script>alert('O Captcha esta Errado.');</script><script>window.location='#';</script>";
            }else{
                $encryptpass = $npassword;

                $sql = "UPDATE accounts SET email=? WHERE login =?";
                $stmt= $db->prepare($sql);
                $stmt->execute([$encryptpass, $username]);

                echo "<script>alert('Email Alterado com sucesso.');</script><script>window.location='windowClose();';</script>";
            }
    }
require('../../_includes/header.php');
	?>


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
		<h2>TROCAR EMAIL<a href="javascript:windowClose();">FECHAR</a></h2>
        <form id="userForm" name="submit" method="post">
		<div class="pop_cont">
			<div class="entry">
				<p class="input">
					<label id='pw'>EMAIL ANTIGO</label>
					<input type='text' name="oldmail" id="oldpassword" onfocus='inon(this,"pw");' onblur='inout(this,"pw");' onkeyup='inup(this,"pw");'>
				</p>
				<p class="input">
					<label id='npw'>EMAIL NOVO</label>
					<input type='text' name="newmail" id="password" onfocus='inon(this,"npw");' onblur='inout(this,"npw");' onkeyup='inup(this,"npw");'>
				</p>
                <p class="input only">
					<label id='cnpw'>CONFIRMAR EMAIL</label>
					<input type='text' name="rmail" id="repassword" onfocus='inon(this,"cnpw");' onblur='inout(this,"cnpw");' onkeyup='inup(this,"cnpw");'>
				</p>
                <p class="input only">
					<label id='cnpw'>SUA KEY</label>
                    <br>
					<input type='text' name="keyid">
				</p>
                <p class="input only">
                <img src="/captcha.php" id="captcha" style="margin-bottom: -11px;">
               
					<label id='cnpw'>CAPTCHA</label>
                <input type="text" name="captcha" id="captcha-form" autocomplete="off">
                </p>
			</div>							
		</div>
		<div class="pop_btn">		
            <input class="btn_h72" class="btn_rd" type="submit" name="go" value="Salvar">OK</input>
		</div>
		</form>
		<div class="loding"><p><img src="/images/loading.gif" alt="Loading"></p></div>
	</div>

    <script type="text/javascript">
//<![CDATA[
function drawMsg(focusId, str) {
	alert(str);
	if ($.trim(focusId)!="") $("#"+focusId).focus();
}
function formSend() {
	sendIt();
	return false;
}

function sendIt() {
   

    var frm = $("#userForm");
    frm.attr("method", "POST");
     frm.attr("method", "POST");
    frm.attr("action", "newp.php");
    frm.attr("onsubmit", "return true");
    frm.submit();
}

function cbEnter() {
	sendIt();
}

$(document).ready(function() {
	windowResize('548');
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