<?php
include_once('../../include.php');
session_start();
error_reporting(0);
if (($_SESSION['username'])) {
    echo "<script>alert('Você já está logado uma conta!');</script><script>window.location = '../../index.php';</script>";
    exit;
    }


function encripitar($senha){
	$salt = '/x!a@r-$r%an¨.&e&+f*f(f(a)';
	$output = hash_hmac('md5', $senha, $salt);
	return $output;
}

function getRealIpAddr(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["txtUsername"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos em seu login!');</script><script>window.history.back()</script>");
	exit();
}
if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["txtPassword"])) || !preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["txtConPassword"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos em sua senha!');</script><script>window.history.back()</script>");
	exit();
}
if(!preg_match("#^[aA-zZ0-9\-_ \@ \.]+$#",trim($_POST["email"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos em seu email!');</script><script>window.history.back()</script>");
	exit();
}

$ip = getRealIpAddr();

$response = $_POST["g-recaptcha-response"];

$url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => "6Lf0FuIUAAAAAOfDd3K2MlJjyKbOFAbvwlceAciW",
        'response' => $_POST["g-recaptcha-response"],
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


$redrirac = "register.php";
$iplimite = $db->prepare("SELECT * FROM accounts WHERE lastip='".$ip."'");
             $iplimite->execute();
			  $num_rows2 = $iplimite->fetch(PDO::FETCH_ASSOC);



if($num_rows2 >= 1){
	echo("<script> alert('Já possui uma conta cadastrada neste IP'); window.location='/pages/login';</script>");
}else{

	if(trim($_POST["txtUsername"]) == ""){
		echo("<script> alert('Complete todos os campos!');</script><script>window.history.back()</script>");
		exit();	
	}elseif(trim($_POST["txtPassword"]) == ""){
		echo("<script> alert('Complete todos os campos!');</script><script>window.history.back()</script>");
		exit();	
	}elseif(trim($_POST["txtConPassword"]) == ""){
		echo("<script> alert('Complete todos os campos!');</script><script>window.history.back()</script>");
		exit();	
	}elseif(trim($_POST["email"]) == ""){
		echo("<script> alert('Complete todos os campos!');</script><script>window.history.back()</script>");
		exit();	
	}elseif($_POST["txtPassword"] != $_POST["txtConPassword"]){
		echo("<script> alert('As senhas nao combinam!');</script><script>window.history.back()</script>");
		exit();	
	}else{

		$verificaemail = $db->prepare("SELECT * FROM accounts WHERE email = '".trim($_POST["email"])."' ");
             $verificaemail->execute();
			  $objResult5 = $verificaemail->fetch(PDO::FETCH_ASSOC);
		if($objResult5){
			
			echo("<script> alert('Este e-mail já está em uso!');</script><script>window.history.back()</script>");
			exit();
		}else{
			$minula = strtolower($_POST["txtUsername"]);
			$verificausuario = $db->prepare("SELECT * FROM accounts WHERE login = '".trim($minula)."'");
             $verificausuario->execute();
              $objResult = $verificausuario->fetch(PDO::FETCH_ASSOC);

			if($objResult){
				echo("<script> alert('Este usuario já está em uso!');</script><script>window.history.back()</script>");
				exit();
			}else{	
				$minul = strtolower($_POST["txtUsername"]);
				$minups = strtolower($_POST["txtPassword"]);

				$sucesso = $db->prepare("INSERT INTO accounts (login,password,email,gp,money,lastip,rank) VALUES (?,?,?,?,?,?,?)");
				$sucesso->execute(array($minul, encripitar($minups), $_POST["email"], 100000, 100000, $ip, 0));

	
		
				$_SESSION['username'] = $minul;
				
				echo "<script>alert('Conta criada com sucesso.(Se você utilizou Letras Maiúsculas,elas foram transformada em minusculas!');</script><script>window.location='/';</script>";
			}
			
		}
	}
	
}
	}else{
		echo "<script>alert('Por favor,refaça o reCAPTCHA!');</script><script>window.history.back()</script>";
	}





?>
