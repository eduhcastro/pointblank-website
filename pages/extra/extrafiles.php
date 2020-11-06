
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
                <p><a href="/pages/regras/" >REGRAS GERAIS</a></p>
                <p><a href="javascript:void(0);" class="current">EXTRA</a></p>
				<p><a href="/pages/download/" class="">DOWNLOAD</a></p>
			</div>
		</section>
		<section class="sub_wrap">
			<div class="act_wrap">
				<div class="act_banner">
					<div class="act_tit">AVANÇADO<br> TREINO DE COMBATE <br><span>INFORMAÇÕES DE RENOVAÇÃO</span></div>
					<div class="act_txt">
						<div>Você pode combinar o gabinete militar, 
Insignia, Medal upe de rank para adquirir<br> 
the <span>'Árvore de título'</span>.</div>
<div>Depois de ganhar o título da árvore de títulos, 
você ficará disponível para alterar o
capacidade e a licença ficam disponíveis
to purchase  those various point items.</div>
<div>Consulte os detalhes abaixo! </div>
					</div>
					<div class="act_receive">
						<div>
						Você receberá uma boina permanente assim que ganhar os títulos de <span>Besta barulhenta, estrela cadente, ainda assassino, sapatilha ágil</span> e <span>Supreme Buster.</span>
						</div>
					</div>
				</div>	<!-- //act_banner -->
				<div class="act_tree">
					<img src="https://pointblank.zepetto.com/images/game/act_tree.png" alt="ADVANCED  COMBAT TRAINING">
					<a href="#none" class="tool00 tool01 act"></a>
					<a href="#none" class="tool00 tool02"></a>
					<a href="#none" class="tool00 tool03"></a>
					<a href="#none" class="tool00 tool04"></a>
					<a href="#none" class="tool00 tool05"></a>
					<a href="#none" class="tool00 tool06"></a>
					<a href="#none" class="tool00 tool07"></a>
					<a href="#none" class="tool00 tool08"></a>
					<a href="#none" class="tool00 tool09"></a>
					<a href="#none" class="tool00 tool10"></a>
					<a href="#none" class="tool00 tool11"></a>
					<a href="#none" class="tool00 tool12"></a>
					<a href="#none" class="tool00 tool13"></a>
					<a href="#none" class="tool00 tool14"></a>
					<a href="#none" class="tool00 tool15"></a>
					<a href="#none" class="tool00 tool16"></a>
					<a href="#none" class="tool00 tool17"></a>
					<a href="#none" class="tool00 tool18"></a>
					<a href="#none" class="tool00 tool19"></a>
					<a href="#none" class="tool00 tool20"></a>
					<a href="#none" class="tool00 tool21"></a>
					<a href="#none" class="tool00 tool22"></a>
					<a href="#none" class="tool00 tool23"></a>
					<div class="tip00 tip01">
						<div class="tip_wrap">
							<div class="tip_tit">Assaulter private</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/SG550_S.png" alt="SG550_S"></div>
								<div class="tip_name">SG 550 S</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip02">
						<div class="tip_wrap">
							<div class="tip_tit">Infiltrator private</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/Dual_Knife.png" alt="Dual_Knife"></div>
								<div class="tip_name">Dual Knife</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip03">
						<div class="tip_wrap">
							<div class="tip_tit">Sniper private</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/Dragunov_G.png" alt="Dragunov_G"></div>
								<div class="tip_name">Dragunov G</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip04">
						<div class="tip_wrap">
							<div class="tip_tit">Gunner private</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/P99+HAK.png" alt="P99+HAK"></div>
								<div class="tip_name">H99&amp;HAK</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip05" >
						<div class="tip_wrap">
							<div class="tip_tit">Assail private</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/SpectraW.png" alt="SpectraW"></div>
								<div class="tip_name">Spectre W.</div>
							</div>
							
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/MP5K_G.png" alt="MP5K_G"></div>
								<div class="tip_name">MP5K G.</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip06">
						<div class="tip_wrap">
							<div class="tip_tit">Explosion private</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/C5.png" alt="C5"></div>
								<div class="tip_name">C-5</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip07">
						<div class="tip_wrap">
							<div class="tip_tit">Blower private</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/870MCS_W.png" alt="870MCS_W"></div>
								<div class="tip_name">870MCS W</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip08">
						<div class="tip_wrap">
							<div class="tip_tit">Top Assaulter</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/G36C_Ext.png" alt="G36C_Ext"></div>
								<div class="tip_name">G36C Ext. D</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip09">
						<div class="tip_wrap">
							<div class="tip_tit">Super Infiltrator Officer</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/Amok_Kukri.png" alt="Amok_Kukri"></div>
								<div class="tip_name">Amok Kukri</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip10">
						<div class="tip_wrap">
							<div class="tip_tit">Top Sniper</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/PSG1_S.png" alt="PSG1_S"></div>
								<div class="tip_name">PSG1 S</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip11">
						<div class="tip_wrap">
							<div class="tip_tit">Super Gunner Officer</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/Dual_handgun.png" alt="Dual_handgun"></div>
								<div class="tip_name">Dual Handgun</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip12">
						<div class="tip_wrap">
							<div class="tip_tit">Top Assail</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/P90_Ext.png" alt="P90_Ext"></div>
								<div class="tip_name">P90 Ext</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip13">
						<div class="tip_wrap">
							<div class="tip_tit">Top Explosion</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/WP_SmokeGrenade.png" alt="WP_SmokeGrenade"></div>
								<div class="tip_name">WP Smoke</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip14">
						<div class="tip_wrap">
							<div class="tip_tit">Super Blower Officer</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/SPAS_15.png" alt="SPAS_15"></div>
								<div class="tip_name">SPAS15</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip15">
						<div class="tip_wrap">
							<div class="tip_tit">Assault Commander</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/AUG_A3.png" alt="AUG_A3"></div>
								<div class="tip_name">AUG A3</div>
							</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/AK-47_Sopmod.png" alt="AK-47_Sopmod"></div>
								<div class="tip_name">AK SOPMOD</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip16">
						<div class="tip_wrap">
							<div class="tip_tit">Infiltrator Commander</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/Mini_Axe.png" alt="Mini_Axe"></div>
								<div class="tip_name">Mini Axe</div>
							</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/BoneKnife.png" alt="BoneKnife"></div>
								<div class="tip_name">Dual Bonnife</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip17">
						<div class="tip_wrap">
							<div class="tip_tit">Sniper Commander</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/L115A1.png" alt="L115A1"></div>
								<div class="tip_name">L115A1</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip18">
						<div class="tip_wrap">
							<div class="tip_tit">Shot Commander</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/Dual-D-Eagle.png" alt="Dual-D-Eagle"></div>
								<div class="tip_name">Dual D-Eagle</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip19">
						<div class="tip_wrap">
							<div class="tip_tit">Assail Commander</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/APC9.png" alt="APC9"></div>
								<div class="tip_name">APC9</div>
							</div>
							
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/KrissSuperV.png" alt="KrissSuperV"></div>
								<div class="tip_name">Kriss S.V</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip20">
						<div class="tip_wrap">
							<div class="tip_tit">Explosion Commander</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/M14_Mine.png" alt="M14_Mine"></div>
								<div class="tip_name">M-14 D</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip21">
						<div class="tip_wrap">
							<div class="tip_tit">Rowdy Beast</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/SC-2010.png" alt="SC-2010"></div>
								<div class="tip_name">SC-2010</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip22">
						<div class="tip_wrap">
							<div class="tip_tit">Still Assassin</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/FangBlade.png" alt="FangBlade"></div>
								<div class="tip_name">FangBlade</div>
							</div>
						</div>
					</div>
					<div class="tip00 tip23">
						<div class="tip_wrap">
							<div class="tip_tit">Shooting Star</div>
							<div class="tip_con">
								<div class="tip_pic"><img src="https://pointblank.zepetto.com/images/game/OA-93.png" alt="OA-93"></div>
								<div class="tip_name">OA-93</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="mouse_on">Mova o cursor do mouse<Br> no <span>imagem do título.</span></div>
	<style>
	.container_game {position:relative;}
	.act_wrap .act_tree .tip01 {display:block; top:-3.28125px; left:-16.7031px;}
	</style>
	<script type="text/javascript">
	//<![CDATA[
	$(function(){
		toolmenu();
		$(document).mousemove(function(e){
		    $('.mouse_on').css("top", e.pageY + 20);
		    $('.mouse_on').css("left", e.pageX);
		    
		    
		    var hwidth = $('.container_game').width();
		    var mleft = $('.mouse_on').offset().left;
		    
		    if(mleft > hwidth - 146){
		    	 $('.mouse_on').css("left", 'auto');
		    	 $('.mouse_on').css("right", 0);
		    }
		    
		});
	});
	
	function toolmenu(){
		$('.tool00').hover(function(){
			var tlnum = $(this);
			
			var tipwidth =$('.tip00').eq(tlnum.index()-1).width();
			var tipheight =$('.tip00').eq(tlnum.index()-1).height();
			
			var pos = parseFloat($(this).position().top);
			var pol = parseFloat($(this).position().left);
			
			$('.tip00').eq(tlnum.index()-1).css('top', pos-tipheight-24);
			$('.tip00').eq(tlnum.index()-1).css('left', pol-tipwidth/2+30);
			
			$('.tool00').removeClass('act');
			tlnum.addClass('act');
			$('.tip00').hide();
			$('.tip00').eq(tlnum.index()-1).stop().fadeIn(200);
		},function(){
			$('.tool00').removeClass('act');
			$('.tip00').hide();
		});
	}
	//]]>
	</script>



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