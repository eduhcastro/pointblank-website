


<?php
session_start();
 error_reporting(0);
require_once('../../include.php');
require('../../class/Ranking.class.php');
require('../../class/nome_patente.php');
require('../../_includes/rankp.php');

?>
<html>
<head>
<?php include('../../_includes/header.php');
    include('../../_includes/top.php');


	

	$id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
	$query = $db->prepare("SELECT * FROM noticias WHERE id = '$id';");
    $query->execute();
	$num_rows = $query->fetch(PDO::FETCH_ASSOC);

	if ($num_rows <= 0){
		echo "<script>alert('Noticia nao existente.');</script><script>window.location = '/';</script>";
	}
	$stmt = $db->query("SELECT * FROM noticias WHERE id = '$id';");

	while($row = $stmt->fetch()){

	?>
		
		<!--// 레이어팝업(회원가입) -->
		<div id="layer_popup" style="display:none;">
			<p class="dimmed"></p>
			<iframe src="" height="456" frameborder="0" scrolling="no"></iframe>
		</div>
		<!-- 레이어팝업(회원) //-->
		
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
	</script>
	<script type="text/javascript">
	//<![CDATA[
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
            url = "<p class=\"dimmed\"></p><iframe src=\"/ph/member/policy\" height=\"652\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        else if ($.trim(param) == "login") {
            url = "<p class=\"dimmed\"></p><iframe src=\"/ph/login/form\" height=\"416\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        else {
        	url = "<p class=\"dimmed\"></p><iframe src=\""+param+"\" height=\"565\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        $("#layer_popup").html(url).fadeIn("fast");
        //return false;
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
<?php 
function classn($numero){
    $i = $numero;
    switch ($i) {
        case 'Eventos':
            return "event";
            break;
        case 'Atualizacao':
            return "patch";
        break;
        case 'Noticias':
            return "promo";
        break;
        case 'Camps':
            return "esports";
        break;
        }
    }
?>
<script type="text/javascript">
		function MostraTudo($texto){
			$Mostra=str_replace(chr(10),"<br>",$texto);
			return $Mostra;
		} 
	</script>
	<div class="sub_container sub_news">
		<section class="visual"><h2>NOTICIAS / NOVIDADES</h2></section>
		<section class="sub_wrap">
			<div class="news_view">
				<div class="view_tit"> 
				<div class="category"><p class="<?php echo classn($row['tipo']); ?>"><?php echo $row['tipo']; ?></p></div>
					<p class="date"><?php echo date("d/m/Y", strtotime($row['data']));?></p>
					<h3><?php echo $row['titulo']; ?></h3>
				</div>
				<article class="view"><table style="text-align: center; width: 100%;">
  <tbody>
    <tr>
      <td style="width: 100%; background-color: rgb(0, 0, 0);"><p>
        <br>
      </p><p class="MsoNormal"><span style="font-size:10.0pt;line-height:115%;font-family:
" verdana","sans-serif";mso-bidi-font-family:arial"=""><span style="font-size: 18px; font-family: Arial; color: rgb(255, 255, 255);"><br></span></span></p><p class="MsoNormal" style="margin-left: 25px;"><span style="font-weight: bolder; color: rgb(255, 255, 0); font-size: 18px; font-family: Arial;"><?php echo $row['titulo']; ?></span><br></p><p class="MsoNormal" style="margin-left: 25px;"><font color="#ffffff" face="Arial"><span style="font-size: 18px;"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"></span><span style="font-size: 18px; color: rgb(255, 255, 0);"></span><span style="font-size: 18px; color: rgb(255, 255, 255);"></span><span style="color: rgb(255, 255, 0); font-size: 18px; font-weight: bold;"></span><span style="color: rgb(255, 255, 0); font-size: 18px; font-weight: 700;"></span><span style="color: rgb(255, 255, 0); font-size: 18px; font-weight: bold;"></span><span style="font-size: 18px; color: rgb(255, 255, 255);"></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><span style="color: rgb(255, 255, 255); font-family: Arial; font-size: 18px;"><?php echo $row['noticia']; ?></span></p><p class="MsoNormal" style="margin-left: 25px;"><span style="font-family: Arial; font-size: 18px;"><span style="color: rgb(255, 255, 255);"></span><span style="font-weight: bolder; color: rgb(255, 255, 0);"</span><span style="color: rgb(255, 255, 255);"> </span><br></span></p><p class="MsoNormal" style="margin-left: 25px;"><font color="#ffffff" face="Arial"><span style="font-size: 18px;"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font color="#ffffff" face="Arial"><span style="font-size: 18px;"></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><br></p><p class="MsoNormal" style="margin-left: 25px;"><br></p><p class="MsoNormal" style="margin-left: 25px;"><span style="font-size: 18px; color: rgb(255, 255, 255); font-family: Arial;"></span></p><p class="MsoNormal" style="margin-left: 25px;"><span style="font-size: 18px; color: rgb(255, 255, 255); font-family: Arial;"><br></span></p><p class="MsoNormal" style="margin-left: 25px;"><span style="font-size: 18px; color: rgb(255, 255, 255); font-family: Arial;">Anteciosamente, Equipe Fatality </span><span style="font-family: Arial; font-size: 18px; font-weight: bold; color: rgb(255, 255, 0);"></span><span style="font-size: 18px; color: rgb(255, 255, 255); font-family: Arial;"><br></span></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px;"><span style="color: rgb(255, 255, 255);"></span><span style="font-weight: bold; color: rgb(255, 255, 0);"><?php echo date("d/m/Y", strtotime($row['data']));?></span><span style="color: rgb(255, 255, 255);">.</span></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px;"><span style="color: rgb(255, 255, 255);"><br></span></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px;"><span style="color: rgb(255, 255, 255);"> </span></span></font></p><p style="margin-left: 25px;"><br style="background-color: rgb(255, 255, 255);"></p></td></tr></tbody></table>
</article>
				<div class="share_btn">
				
				</div>				
			</div>
			<ul class="prev_next">
			
        	
        		
        	
			</ul>
			<div class="sub_btn">
				<p class="btn_h72"><a class="btn_rd" href="javascript:void(0);" onclick="document.location='/pages/noticias'">VOLTAR</a></p>
			</div>
		</section>
	</div>
	    


	<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>
<script type="text/javascript">
//<![CDATA[
	   $(document).ready(function () {
	       var snsLink = new Array("dev_link_sns_facebook_share", "dev_link_sns_google_share");
	       for (var i=0; i < snsLink.length; i++) {
	           var sns = "." + snsLink[i];
	
	           $(sns).unbind("click");
	           $(sns).attr("href", "javascript:void(0)");
	           $(sns).attr("onclick", "");
	           $(sns).attr("index", i);
	           $(sns).bind("click", function () {
	               var loc = escape(document.location);
	               var index = $(this).attr("index");
	
	               if (index == 0) {
	                   window.open('http://www.facebook.com/sharer/sharer.php?u='+loc, 'child', 'scrollbars,width=600,height=500');
	               } else if (index == 1) {
	                   window.open('https://plus.google.com/share?url='+loc, 'child', 'scrollbars,width=600,height=500');
	               }
	           });
	       }

		});
		function copyToClipboard(text) {
			window.prompt("Press Ctrl+C to copy to clipboard", text);
		}
		$(document).ready(function(){
			$(".link").click(function() {
				copyToClipboard(window.location.href);
				return false;
			});
		});
//]]>
</script>
<?php }?>