<?php
session_start();
include_once('../../include.php');
error_reporting(0);
if (($_SESSION['username'])) {
    echo "<script>alert('Você já está logado uma conta!');</script><script>window.location = '../../index.php';</script>";
    exit;
    }

$username = $_POST['username'];
$passwordori = $_POST['password'];
$player_id = $_POST['player_id'];
$encript = encripitar($passwordori);

if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["username"])) || !preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["password"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos');</script><script>window.history.back()</script>");
	exit();
}




function encripitar($senha){
	$salt = '/x!a@r-$r%an¨.&e&+f*f(f(a)';
	$output = hash_hmac('md5', $senha, $salt);
	return $output;
}

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => "6LeEFuIUAAAAACX4fUjr6fDY0lNb3NcZ9GpnkIrn",
        'response' => $_POST['token'],
        // 'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
        )
      );

    $context  = stream_context_create($options);
      $response = file_get_contents($url, false, $context);

    $res = json_decode($response, true);
    if($res['success'] == true) {

if($username == "")
{
	echo "<script>alert('Preencha Todos Os Campos!');</script><script>window.history.back()</script>";
    exit();
}
else if($passwordori == "")
{
    echo "<script>alert('Preencha Todos Os Campos!');</script><script>window.history.back()</script>";
    exit();
}
else
{
    $return = 'https://pbfatality.com.br'.$_POST['urlreturn'];

	
    $sth = $db->prepare("SELECT * FROM accounts WHERE login = '$username' AND password = '$encript';");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    if($result){

        $stmt = $db->query("SELECT * FROM accounts WHERE login = '$username' AND password = '$encript';");
        while ($row = $stmt->fetch()) {
            $_SESSION["username"] = $_POST['username'];
			$_SESSION["player_id"] = $_POST['player_id'];
        }
		echo '<script>var data = "{\"type\" : \"aone_layer_popup_close\"}";
        window.parent.postMessage(data, "*");</script>';
        echo '<script language="javascript">window.alert("Bem vindo novamente ao Project Fatality!.");';
    echo 'top.location.href = "'.$return.'";';
    echo '</script>'; 
    

    }else{
        echo "<script>alert('Usuario ou senha esta incorreta');</script><script>window.history.back()</script>";
        exit();
    }

	}
}else{

    echo "<script>alert('reCAPTCHA Vencido');</script><script>window.history.back()</script>";
    exit();
}

	?>

<html>
<head>
	<?php include('../../_includes/header.php'); ?>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/common_ie8.css">
	<![endif]-->
<script type="text/javascript">
//<![CDATA[
	function goPage() {
		var loc = window.location.href;
		if (loc.indexOf("th")!== -1) document.location = "/index.php";
		else  document.location = "/index.php";
		
	}	
	setInterval(goPage, 2000);
//]]>
</script>

</head>
<body>
	<section class="error">
		<dl>
			<dt>404 ERRO</dt>
			<dd>A pagina solicitada não existe</dd>
		</dl>
		<div class="error_footer">
			<img src="/images/ci_zepetto.png" alt="Zepetto">
			<p>COPYRIGHT ZEPETTO CO. ALL RIGHTS RESERVED.</p>
		</div>
	</section>
</body>
</html>
