
<html>
<head>
	<?php include('_includes/header.php'); ?>
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