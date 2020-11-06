

<?php
error_reporting(0);
session_start();

if (($_SESSION['username'])) {
    echo "<script>alert('Você já está logado uma conta!');</script><script>window.location = '../../index.php';</script>";
    exit;
    } ?>
<html>
<head>
	<title>Registrar | Point Blank Fatality</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="subject" content="Point Blank Fatality website">
	<meta name="title" content="Register l Point Blank Fatality">
	<meta name="author" content="Zepetto">
	<meta name="keywords" content="Point Blank Fatality Register, pb Register, pbph Register, pointblank zepetto Register, point blank Register, pb point blank Register, pbph Register, pointblank ph Register, FPS, online, olinegsme, game point blank Register,point blank, game pb, pb game, point blank garena Register, point pb Register, garena pb Register, zepetto pb Register, zepetto pointblank Register, PB E-SPORTS, Register ,Pointblank beyond limit"> 
	<meta name="description" content="Anyone who love the games can register to become our members of Point Blank ZEPETTO. Only it requires your ID and Password." />
	<meta name="Register l Point Blank Fatality " content="Anyone who love the games can register to become our members of Point Blank ZEPETTO. Only it requires your ID and Password.">
	<meta property="og:type" content="Point Blank Fatality website"/>
	<meta property="og:title" content="Register l Point Blank Fatality">
	<meta property="og:url" content="https://pointblank.zepetto.com/member/signup"/>
	<meta property="og:description" content="Anyone who love the games can register to become our members of Point Blank ZEPETTO. Only it requires your ID and Password." >
	<meta property="og:image" content="https://pointblank.zepetto.com/images/pbph.jpg"/>

	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Point Blank Fatality">
	<meta name="twitter:description" content="og:description" content="This is the official Point Blank website. Please find our official game information, Game Download, FAQ, RANK and events details.">
	<meta name="twitter:image" content="https://pointblank.zepetto.com/images/pbph.jpg"/>
	<meta name="twitter:domain" content="https://pointblank.zepetto.com/"/>
	<link rel="stylesheet" type="text/css" href="/css/transfer.css">
	<script type="text/javascript" src="/js/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="/js/jquery.placeholder.min.js"></script>	
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <script type='text/javascript'>
function check_email(elm){
    var regex_email=/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*\@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/
    if(!elm.value.match(regex_email)){
        alert('Please enter a valid email address');
    }else{

}
}
</script>

	<script type="text/javascript">
	    if (document.location.protocol == 'http:') {
	        document.location.href = document.location.href.replace('http:', 'https:');
		}
	</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140313192-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140313192-2');
</script>

	<script type="text/javascript">
	//<![CDATA[

	//]]>
	</script>
</head>

<body>
	<section class="signup">
		<h1><a href="/"><img src="/images/bi_pbbl.png" alt="Point Blank Beyond Limits"></a></h1>
		<div class="contents">
		<form  method="post" action="save_register.php" class="dev_check_enter">
			<div class="cont">
				<div class="entry">
					
					<!--// 191230 facebook login -->
					<div class="facebook">
						
						<div class="check">
							
							
						</div>
						<p class="division">CADASTRO</p>
					</div>
					<!-- 191230 facebook login //-->
                    <form method="post" action="save_register.php">
					<h5>ID</h5>
					<p class="with_btn">
				
						<input name="txtUsername" type="text" id="txtUsername" class="text" maxlength="10" placeholder="ID - (MAXIMO 10 CARACTERES)">
					</p>
					
					<h5>Password</h5>
					<input name="txtPassword" type="password" id="txtPassword" maxlength="10" class="text" placeholder="PASSWORD - (MAXIMO 10 CARACTERES)" />
				
					<h5>Confirm Password</h5>
					<input  name="txtConPassword" type="password" id="txtConPassword" maxlength="10" class="text" placeholder="REPITA O PASSWORD" />
					<h5>E-mail</h5>
					<p class="with_btn">
				
						<input  name="email" onblur="check_email(this)" size="45" id="email" type="email" class="text" placeholder="EMAIL VALIDO" />
					</p>
				
					<div class="check">
						<input  type="checkbox" name="check1" value="1" checked>
						<label for="agree">
							Eu li os <a href="/ph/member/policy/terms" target="_blank">Termos de uso e condiçoes</a> <a href="/ph/member/policy/privacy" target="_blank">Eu li e aceito os</a> Termos de uso e condiçoes.
						</label>
					</div>
				</div>
				<div class="capcha">
                <center>
                <h1>Captcha</h1>
				<div class="g-recaptcha" data-sitekey="6Lf0FuIUAAAAAHayl2Njd5YpFnvu5MljFyRhvMeS"></div>
                    </center>
			</div>
			</div>
			<div class="cont_bot">
				<ul class="btn">
					<li class="btnrd"><button type="submit" name="submit" class="btn84 btnrd">Registration</button></li>
				</ul>
			</div>
		</form>
		</div>
	</section>
	<div class="loding"><img src="/images/event/2019/06_transfer/loading.gif" alt="Loading"></div>
	<script type="text/javascript">

		
	
	<footer>
		<a href="http://zepetto.com/" target="_blank"><img src="/images/ci_zepetto.png" alt="Zepetto"></a>
		<p class="cs">If there are questions contact <a href="mailto:ask_pbph@zepetto.biz">ask_pbph@zepetto.biz</a></p>
		<p class="copy">Copyright Zepetto Co. All Rights Reserved.</p>
	</footer>
</body>
