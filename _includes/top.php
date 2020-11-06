<?php



$aa ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 $blockk = substr($aa, 24, 1000);

?>
<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/common_ie8.css">
	<![endif]-->
	


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


	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script><!-- 배너 -->
	<script type="text/javascript">
		$(function(){
			var widthNavutil=$(".nav_util").width();
			$(".sns p").css({right:widthNavutil+24});
		});
	</script>
</head>

<body>
	<div class="container">
	<header>
		<h1><a href="/"><img src="/images/logo_gnb_pb.png" alt="Point Blank beyond Limits"></a></h1>
		<nav>
		<ul>
			<li>
				<p><a href="/pages/download/" data-content="Game" class="on">GAME</a></p>
				<ul class="depth2">
					<li><a href="/pages/download/">DOWNLOAD</a></li>
					<li><a href="/pages/regra-camp/">CAMP - REGRAS</a></li>
					<li><a href="/pages/regras/">REGRAS GERAIS</a></li>
					<li><a href="/pages/extra/">EXTRA</a></li>
				</ul>
			</li>
			<li><p><a href="/pages/noticias" data-content="News">NOTICIAS</a></p></li>
			<li>
				<p><a href="/pages/rankplayer/" data-content="Ranking" class="on">RANKING</a></p>
				<ul class="depth2">
					<li><a href="/pages/rankplayer/">RANK​ INDIVIDUAL </a></li>
					<li><a href="/pages/rankclan/">CLAN RANK</a></li>
				</ul>
			</li>
			<li>
				<p><a href="javascript:void(0);" data-content="Forum" class="on">SOCIAL</a></p>
				<ul class="depth2 depth2_sns">
					<li>
						<a href="https://discord.gg/FSPNr9e" target="_blank" class="discord">
							<p><img src="/images/sns_14_discord.png" alt="Discord"></p>DISCORD
						</a>
					</li>
				</ul>
			</li>
			<li><p><a href="/pages/recarga" data-content="Owner Basecamp">VIP</a></p></li>
		</ul>
		<div class="sns">
			<p>
				<a href="https://discord.gg/FSPNr9e" target="_blank" class="discord"><img src="/images/sns_28_discord.png" alt="Discord"></a>
			</p>
		</div>
		</nav>
		
		<div class="nav_util">
		<?php if (!isset($_SESSION['username'])) { ?>
			<!--// 로그아웃 상태 -->
			<form name="fbForm" id="fbForm">
			<div class="logout">
				<ul>
					<li class="signup"><a href="/pages/cadastrar/">REGISTRAR</a></li>
					<li class="login"><a href="javascript:openLoginPopup();">LOGIN</a></li>
				</ul>
			</div>
			</form>

			<?php }else{
                $inicio = $_SESSION['username'];
				$rank = "SELECT * FROM accounts WHERE login = '$inicio'";
				//$a->query($rank->(PDO::FETCH_ASSOC));
				foreach ($db->query($rank) as $ranking) 
               
				$rank = new Ranking();
				
            ?>
			<div class="mypage">
				<!--// 알림 -->
				
				
				
				<!-- 알림 //-->
				<ul>
					<li>
					<?php if($ranking['player_name'] = $ranking['player_name']){ ?>
						<p class="myinfo"><a href="/pages/perfil/"><span><?php echo "".$ranking['player_name'].""; ?></span></a></p>
                            <?php }else{ 
								 
								?>

							<p class="myinfo"><a href="/pages/perfil/"><span>SEM NICK!</span></a></p>
							<?php }?>
						<ul class="depth2">
							<li><a href="/pages/perfil/"><?php echo "".$ranking['player_name'].""; ?> / <?php echo "<img src='/Ranking/PAT/".$ranking['rank'].".gif' width='20' />"; ?> / Cash : <?php echo "".str_replace(",", ".", number_format($ranking['money'])).""; ?> / Gold : <?php echo "".str_replace(",", ".", number_format($ranking['gp'])).""; ?></a></li>
							<li><a href="/pages/suporte">SUPORTE</a></li>
							<!-- <li><a href="/mypage/esports">E-SPORTS</a></li> -->
							<li><a href="/pages/perfil/">MINHAS INFORMAÇÕES</a></li>
							<li><a href="/pages/cupon">ATIVAR PIN-CODE</a></li>
							<li><a href="/pages/actions/?return=<?php echo $aa ?>">SAIR</a></li>
							<?php if($ranking['access_level'] == '5'){ ?>
							<li><a href="/cGFuZWxhZG1pbg==/">PAGINA DO ADMIN</a></li>
							<?php }elseif($ranking['access_level'] == '4'){ ?>
								<li><a href="/cGFuZWxhZG1pbg==/">PAGINA DO MOD</a></li>
							<?php }else{  }?>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<?php }?>