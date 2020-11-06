
<html>
<?php 
session_start();
error_reporting(0);
 
require_once('../../include.php');
require('../../class/Ranking.class.php');
require('../../class/nome_patente.php');
require('../../_includes/rankp.php');
	?>
<head>
<body class="container_game">
	<header>
    <?php include('../../_includes/header.php');
    include('../../_includes/top.php');
    
	?>

			<!--// 로그인 상태 //-->
        
			<!-- <div class="play"><a href="#"><span class="txt_red">MAINKAN</span> SEKARANG</a></div> -->
		</div>
		
<script type="text/javascript">
	//<![CDATA[
	window.fbAsyncInit = function() {
	    //SDK loaded, initialize it
	    FB.init({
	        appId      : '847163265704696',
	        cookie     : true,  // enable cookies to allow the server to access
	        xfbml      : true,  // parse social plugins on this page
	        version    : 'v4.0' // use graph api version 4.0
	    });
	};
		    
	//load the JavaScript SDK
	(function(d, s, id){
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) {return;}
	    js = d.createElement(s); js.id = id;
	    js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	
	   var zptRcvMessage = {
	    receiveMessage : function (event) {
	        var regEx = /.aone/g;
	
	        var data = $.parseJSON(event.data);
	
	        if (regEx.test(event.data)) {
	            switch (data.type) {
	                case "aone_iframe_resize":
	                    var frame = $("#layer_popup").find("iframe");
	                    if (frame.length > 0) {
	                        if (data.width) {
	                            frame.attr("width", data.width);
	                        }
	                        if (data.height) {
	                            frame.attr("height", data.height);
	                        }
	                    }
	                    break;
	                case "aone_location_change":
	                    if (data.location) {
	                        document.location.href = data.location;
	                    }
	                    break;
	                case "aone_layer_popup_close":
	                    $("#layer_popup").html("").fadeOut("fast");
	                    break;
	                case "aone_page_reload":
	                	location.reload();
	                    break;
	                case "aone_set_value":
	                    $("#"+data.id).val(data.value);
	                    break;
	                case "aone_pop_layer":
	                	openLayerPopup(data.url);
	                    break;
	                case "aone_facebook_login":
	            		goFacebookLogin();
	                   	break;
	            }
	        }
	        else {
	            return false;
	        }
	    }
	};
	
	if(window.addEventListener) {
		window.addEventListener ("message", zptRcvMessage.receiveMessage, false);
	} else {
		if(window.attachEvent) {  
			window.attachEvent("onmessage", zptRcvMessage.receiveMessage);
		}
	}
    function openLayerPopup(param) {
        var url = "";
        if ($.trim(param) == "sign") {
            url = "<p class=\"dimmed\"></p><iframe src=\"/ph/member/signup\" height=\"652\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        else if ($.trim(param) == "login") {
            url = "<p class=\"dimmed\"></p><iframe src=\"/ph/login/form\" height=\"416\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        else {
        	url = "<p class=\"dimmed\"></p><iframe src=\""+param+"\" height=\"576\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        $("#layer_popup").html(url).fadeIn("fast");
        //return false;
    }
    
    function goFacebookLogin() {
        if (isIE()) {
    	    //do the login
    		FB.getLoginStatus(function(response) {
    			if (response.status === 'connected') {
    				fbLogin(response);
    			} else {
    				FB.login(function(response) {
    					if (response.authResponse) {
    						fbLogin(response);
    					}
    				}, {scope: 'email,public_profile', return_scopes: true, auth_type: 'reauthenticate'});
    			}
    		});
        }
        else {
    		FB.getLoginStatus(function(response) {
    	       	if (response.status === 'connected') {
    				FB.logout(function(response) {});
    	        }
    	       	FB.login(function(resp) {
    		        if (resp.authResponse) {
    		        	fbLogin(resp);
    		        }
    		    }, {scope: 'email,public_profile', return_scopes: true, auth_type: 'reauthenticate'});
    		});
        }
    }

    function fbLogin(response) {
        var frm = $("#fbForm");
	    frm.attr("method", 'post');
	    frm.attr("action", '/ph/login/facebook/process');

	    var accessToken = response.authResponse.accessToken; //get access token
	    var fb_id = response.authResponse.userID; //get FB UID
	    
	    frm.append("<input type=\"hidden\" name=\"fbtoken\" value=\""+accessToken+"\"/>");
	    frm.append("<input type=\"hidden\" name=\"fbuid\" value=\""+fb_id+"\"/>");
	    frm.append("<input type=\"hidden\" name=\"refer\" value=\""+window.location.href+"\"/>"); 
	    
	    frm.submit();
    }
    
    function isIE() {
    	if(navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
    	if(navigator.userAgent.toLowerCase().indexOf("firefox") != -1) return false;
      	if(navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
      	if(navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
      	
      	return false;
    }
	//]]>
	</script>
	</header>

	<div class="sub_container sub_game">
		<section class="visual">
			<h2>GAME</h2>
			<div class="menu_2depth">
				<p><a href="/pages/regra-camp/">CAMP-REGRAS</a></p>
                <p><a href="javascript:void(0);" class="current">REGRAS GERAIS</a></p>
                <p><a href="/pages/extra/">EXTRA</a></p>
				<p><a href="/pages/download/" class="">DOWNLOAD</a></p>
               
			</div>
		</section>
		<section class="intro">
			We would like to express our deepest gratitude to the Troopers who have been using Point Blank for a long time and give our attention and affection to us.<br><br>
			<strong>Starting from JULY 16th 2019, PT.</strong><br><br>
			Zepetto is developing Point Blank, will take over the service.<br>
			We want to return the favor to the Troopers by providing services directly from the developer so that Point Blank will be better and we are able to directly communicate
		</section>
		<section class="sub_wrap">
			<div>
						<ul class="features">
					<li>
						<img src="/images/game_features_1.jpg">
						<div class="cont">
							<h4>GRADE X</h4>
							<p>Penalidade: Bloqueio de 15 dias no acesso ao jogo.</p>
							<p>Ofender a GM/Jogador.- Antijogo.
<p>Free Kill.
<p>Abuso de Macro.
<p>Nickname Impróprio.
<p>Acusação sem provas.
<p>Criação de sala com nome impróprio.
<p>Falsa denúncia via Suporte/Fórum.
<p>Criação de boatos da empresa/jogadores.
<p>Propagandas não relacionadas ao Jogo/Empresa.
<p>Atrapalhar o bom andamento do Jogo/Suporte/Fórum.
<p>Clã com Nickname Impróprio (Punição aplicada no Master e Auxiliares do Clã).</p>
						</div>
					</li>
					<li class="right">
						<img src="/images/game_features_2.jpg">
						<div class="cont">
							<h4>GRADE Y</h4>
							<p>Penalidade: Bloqueio de 30 dias no acesso ao jogo.</p>
                            <p>Aproveitamento de Bug - (Sistema, Mapas, Server e Site).
<p>Passar-se por membro da Equipe.
<p>Compartilhamento de conta.
<p>Pressupor o Free Kill.
						</div>
                    </li>
                    
                    <li class="right">
						<img src="/images/game_features_2.jpg">
						<div class="cont">
							<h4>GRADE Z</h4>
							<p>Penalidade: Bloqueio permanente da conta.</p>
<p>Racismo, discriminação ou preconceito.*
<p>Ameaça física através do jogo/Suporte/Fórum.
<p>Comércio de conta (Via Forum, Facebook, Mensagem, WhatsApp, MercadoLivre e Etc).
<p>Divulgação de Hack.**
<p>Pressupor o uso de Hack. 
<p>Solicitação e/ou Uso de HACK.**
						</div>
                    </li>
                    
                    <li class="right">
						<img src="/images/game_features_2.jpg">
						<div class="cont">
							<h4>GRADE Fatality</h4>
                            <p>Penalidade: Bloqueio de 2 dias (Site/Game).</p>
<p>Pedir Cash ao GM/Mod/Staff.
<p>Desrespeito frequente dos modos de jogo ( @CAMP, @PBIC, @GOLD, @TROLL e Etc).
<p>Falar mal do servidor.
						</div>
					</li>
														
				</ul>
			</div>
		</section>
	</div>


	<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>

<script>
function popPatchList() {
	$(".pop_manual").show();
}
$(document).ready(function() {
	$(".link a").on("click",function() {
		$(".pop_simple").show();
	});
	$(".pop_simple .dimmed, .pop_layout h2 a").on("click",function() {
		$(".pop_simple").hide();
	});

	$(".part a").on("click",function() {
		$(".pop_part").show();
	});
	$(".pop_part .dimmed, .pop_layout h2 a").on("click",function() {
		$(".pop_part").hide();
	});
	
	$(".pop_manual .dimmed, .pop_layout h2 a").on("click",function() {
		$(".pop_manual").hide();
	});
});
</script>