
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
                <p><a href="/pages/regras/">REGRAS GERAIS</a></p>
                <p><a href="/pages/extra/">EXTRA</a></p>
				<p><a href="/pages/download/" class="current">DOWNLOAD</a></p>
			</div>
		</section>
		
		<section class="sub_wrap">
			<div class="down_list">
				
				<div class="full">
					<h3>Dowload novo CLiente!</h3>
					<ul>
						<li>
							<p>CLIENT TAMANHO</p>
							<p>2.6GB</p>
						</li>
						<li>
							<p>ULTIMA ATT</p>
							<p>29-03-2020</p>
						</li>
						<li>
							<p>Versão</p>
							<p>V42</p>
						</li>
					</ul>
					<p class="btn"><a href="https://drive.google.com/open?id=1cHrsdwOmQxwOZ3arxp9_JeQQMeSD14Hz">DOWNLOAD</a></p>
				</div>
				
				
				<div class="part">
					<h3>Launcher Update pra quem nao tem a cliente Fatality!</h3>
					<ul>
						<li>
							<p>Launcher tamanho</p>
							<p>1.76KB</p>
						</li>
						<li>
							<p>ULTIMA ATT</p>
							<p>24-03-2020</p>
						</li>
						<li>
							<p>Versão</p>
							<p>V42</p>
						</li>
					</ul>
					<p class="btn"><a href="https://drive.google.com/open?id=1eQ5PqpNi2p7u7WhjW00XejBZRL7QC18P">DOWNLOAD</a></p>
				</div>
				
				<!-----------------------// 19-08-01 ìëí¨ì¹ ìë¡ë ----------------------->
				<!-- <div class="manual">
					<h3>MANUAL PATCHs</h3>
					<ul>
						<li>
							<p class="version">FILE 1</p>
							<p class="data">200M</p>
							<p class="date">21.08.2019</p>
							<p class="download"><a href="http://ptzepetto-pb.akamaized.net/pb_intall/partial/PointBlank_PH.zip.011">DOWNLOAD</a></p>
						</li>
					</ul>
					<p class="btn"><a href="javascript:popPatchList();">DOWNLOAD</a></p>
				</div> -->
				<!----------------------- 19-08-01 ìëí¨ì¹ ìë¡ë //----------------------->
			</div>
			<div class="system">
				<h3>Requisitos mínimos</h3>
				<p class="spec">
					<strong>RECOMENDANDO PC ESPECIFICAÇÕES</strong><br>
					<span>Windows :</span> Windows 7 ou superior<br>
					<span>Processador :</span> Intel Dual Core 2.8GHZ <span>|</span> AMD Athlon II X2 250<br>
					<span>VGA :</span> NVIDIA 9600GT(512MB), Radeon HD5570 ou superior<br>
					<span>RAM :</span> 2GB or above
				</p>
				<p class="btn_h48"><a class="btn_gy" href="https://discord.gg/FSPNr9e">Discord</a></p>
			</div>
		</section>
	
		<!--// Popup (Simple Explain) -->
		<div class="pop_simple">
			<p class="dimmed"></p>
			<div class="pop_layout">
				<h2>Simple Download<a href="#">CLOSE</a></h2>
				<div class="simple_guide">
					<div>
						<img src="/images/game_simple_1.jpg">
						<p class="tit">Start Install</p>
						<p><span>1.</span>Click the installation file after downloading.</p>
						<p><span>2.</span>Click the Next button to proceed to the next process.</p>
					</div>
					<div class="long">
						<img src="/images/game_simple_2.jpg">
						<p class="tit">Select Location Install</p>
						<p><span>1.</span>The location of the previous Point Blank Evolution client folder will automatically appear.</p>
						<p class="bul">If the folder cannot be found, specify the location manually.</p>
						<p><span>2.</span>The Zepetto folder for installation will automatically be made.</p>
						<p class="bul">If you want to change the installation location, you can create a folder and select the installation location manually.</p>
					</div>
					<div>
						<img src="/images/game_simple_3.jpg">
						<p class="tit">Error Message</p>
						<p><span>1.</span>An error will appear if there is no Point Blank Evolution client found on your PC.</p>
						<p class="bul">Please download and install the Full Client on the website download.</p>
						<p class="bul">If the Point Blank Evolution client is not on your PC, please select the Point Blank installation location manually.</p>
					</div>
					<div>
						<img src="/images/game_simple_4.jpg">
						<p class="tit">Copy dan Update</p>
						<p><span>1.</span>If all copy steps have been completed, the option will appear to start the launcher.</p>
						<p class="bul">After starting the launcher, update the client that has been copied.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- Popup (Simple Explain) //-->
		
		<!--// Popup (Partial Client) -->
		<div class="pop_part">
			<p class="dimmed"></p>
			<div class="pop_layout">
				<h2>Downlad por partes(OFF)<a href="javascript:void(0);">CLOSE</a></h2>
				<div class="down">
				
				
					
						
						<!--
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part01.rar"><p>PART 1<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part02.rar"><p>PART 2<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part03.rar"><p>PART 3<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part04.rar"><p>PART 4<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part05.rar"><p>PART 5<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part06.rar"><p>PART 6<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part07.rar"><p>PART 7<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part08.rar"><p>PART 8<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part09.rar"><p>PART 9<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part10.rar"><p>PART 10<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part11.rar"><p>PART 11<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part12.rar"><p>PART 12<br><strong>200MB</strong></p></a>
						
							<a href="http://zpt-ph.zepetto.com/PH/PointBlank/pb_intall/partial/PointBlank.part13.rar"><p>PART 13<br><strong>200MB</strong></p></a>
						
						//-->
						
					  
				
				</div>
				
			</div>
		</div>
		<!-- Popup (Partial Client) //-->
		<!-----------------------// 19-08-06 ìëí¨ì¹ ìë¡ë ----------------------->
		<!--// Popup (Tambal Manual) -->
		<div class="pop_manual">
			<p class="dimmed"></p>
			<div class="pop_layout">
				<h2>MANUAL PATCHS<a href="javascript:void(0);">CLOSE</a></h2>
				<div class="down">
					<ul>
						
						<li>
							<a href="http://ptzepetto-pb.akamaized.net/pb_intall/partial/PointBlank_PH.zip.011">
								<p class="info">21.08.2019<br><strong>FILE 1</strong></p>
								<p class="load">200M</p>
							</a>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		<!-- Popup (Tambal Manual) //-->
		<!----------------------- 19-08-06 ìëí¨ì¹ ìë¡ë //----------------------->
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
