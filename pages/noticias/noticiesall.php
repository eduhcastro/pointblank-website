


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
    $inicio = $_SESSION['username'];

		
	function pos1($posiao){
		if ($posiao <= 3){
			return "<img src=\"/img/user{$posiao}.png\" title=\"{$posiao}\"/>";
		}else{
			Return "".$posiao."";
		}
    }
    
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

	<div class="sub_container sub_news">
		<section class="visual"><h2>NOTICIAS / NOVIDADES</h2></section>
		<section class="news_notice">
			<ul>
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

				
								$rankplayer = "SELECT * FROM noticias ORDER BY id DESC LIMIT 15";
							$num = 1;
							foreach ($db->query($rankplayer) as $row) 
							{

        
					echo "<li>";
                    echo "<a href=/pages/ler_noticia/?&id=".$row['id'].">";
                    echo '<div class="category"><p class="'.classn($row['tipo']).'">'.$row['tipo'].'</p></div>';
                    echo '<p class="thumb">';
                    echo '<img src="'.$row['url_img'].'" alt="News thumbnail">';
                    echo '</p>';
                    echo '<div class="cont">';
                    echo '<p class="date">'.date("d-m-Y", strtotime($row['data'])).'</p>';
                    echo '<h3>'.$row['titulo'].'</h3>';
                    echo  $row['noticia_mini'];                                  
                    echo "</div>";
                    echo "</a>";
                   echo "</li>";
                    
    
				      $num++; } 
				
            ?>
		
		
				
				
				
					
					
						
						
						
						
						
					
					
						
						
						
				
				
				
				
			</ul>
		</section>
		
	
	</div>





	<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>
<script type="text/javascript">
//<![CDATA[
    $(document).ready(function () {
        bcBoard.moreBtn();
    });

    var bcBoard = {
    	isToggle : false,
    	curPage : 1,
        lastPage : 3,
        pageLoad : function () {
            if (bcBoard.isToggle == false && bcBoard.curPage < bcBoard.lastPage) {
               	$.ajax({
            	    url: "/ph/news/page",
        			dataType : "json",
        			type: "GET",
        			data:  "page="+ (bcBoard.curPage + 1),
        			contentType : "application/x-www-form-urlencoded;charset=UTF-8",
        			success: function (data) {
        				if (data != null) {
        					if (data.boardList) {
                                if (data.boardList.length > 0) {
                                    for (var i = 0; i < data.boardList.length; i++) {
			                            var row = data.boardList[i];
			                            
			                            var html = "<li><a href=\"/ph/news/view?idx="+row.idx+"&page="+(bcBoard.curPage+1)+"\">";
			                            html += "<div class=\"category\"><p class=\""+row.categoryName.toLowerCase()+"\">"+row.categoryName.toUpperCase()+"</p></div>";
			                            if ($.trim(row.thumbnail)!="") {
			                            	html += "<p class=\"thumb\"><img src=\"" + row.thumbnail + "\" alt=\"News thumbnail\"></p>";
			                            }
			                            else {
			                            	html += "<p class=\"thumb\"><img src=\"/images/news_thumb.jpg\" alt=\"News thumbnail\"></p>";
			                            }
			                            html += "<div class=\"cont\">";
			                            html += "<p class=\"date\">"+row.createFormatDate+"</p>";
			                            html += "<h3>" + row.title + "</h3>";
			                            html += "<p>" + row.contentsShort + "</p>";
			                            html += "</div>";
			                            html += "</a></li>";
			                            
			                            $(".devList:last").append(html);
                                    }
                                    
                                }
        					}
        					bcBoard.curPage = bcBoard.curPage + 1;
                            bcBoard.moreBtn();
        				}else {
        					alert("alert.no.data");
        				}
        			}, error: function(xhr, status, error) {
        				alert("status=" + xhr.status + "\nreadyState=" + xhr.readyState);
        			}
        		});
            }
		},
        moreBtn : function () {
            if (bcBoard.curPage >= bcBoard.lastPage) {
                $("#moreBtn").hide();
            }
		}
    };

    //$(window).scroll(function() {
    //    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
    //        PageLoad();
    //    }
    //});
//]]>
</script>