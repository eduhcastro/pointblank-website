<?php
session_start();
error_reporting(E_ALL);
require_once('include.php');
require('class/Ranking.class.php');
require('class/nome_patente.php');

$cPlayer = $db->prepare('SELECT player_id FROM accounts');
$cPlayer->execute();
$countPlayer = $cPlayer->rowCount();

$cPlayerOnline = $db->prepare('SELECT player_id FROM accounts WHERE online = true');
$cPlayerOnline->execute();
$countPlayerOnline = $cPlayerOnline->rowCount();


  ?>

<html>
<head>
	<?php include('_includes/header.php');
	 include('_includes/top.php');
	?>
	<style>
	.data{
		color: #de0b0b;
	}
	</style>
		<!--// 레이어팝업(회원가입) -->
		<div id="layer_popup" style="display:none;">
			<p class="dimmed"></p>
			<iframe src="" height="456" frameborder="0" scrolling="no"></iframe>
		</div>
		<!-- 레이어팝업(회원) //-->
		<script data-ad-client="ca-pub-6513573635393876" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
    function openLoginPopup() {
        var url = "";
        
        url = "<p class=\"dimmed\"></p><iframe src=\"/pages/login/\" height=\"416\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        
        $("#layer_popup").html(url).fadeIn("fast");
        //return false;
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

	<div class="quick">
		<div>
			<div>
				<!--  <p class="manual"><a href="/ph/game/download">MANUAL<br>PATCHS</a></p> -->
				<p class="act_quick"><a href="/pages/rankplayer">TOTAL PLAYERS : <br> <?php echo $countPlayer; ?> </a></p>
				<p class="warnet"><a href="/pages/download">TOTAL ON : <br><?php echo $countPlayerOnline; ?></a></p>
				<p class="cheat"><a href="/pages/suporte">REPORTAR HACKER</a></p>
				<p class="topup"><a href="/pages/recarga">COMPRAR CASH</a></p>
				<p class="pboc"><a href="/pages/noticias">CAMPS 2020</a></p>
			</div>
		</div>
	</div>
	<div class="main_wrap">
		<section class="main_visual">
			<div class="banner_wrap" style="display: ;">		
			<ul>						
			
			<?php include('_includes/novidades.php'); ?>
						
						
				
					
					
				</li>
			</ul>
			<div class="btn_h72"><a class="btn_rd wide" href="/pages/noticias">+NOVIDADES</a></div>
		</section>
		
		<section class="main_cont">
			<div>
				<div class="vod">
					<h2>VIDEOS</h2>
					<p class="page">
						<a class="prev" href="javascript:void(0);" onclick="bcBoard.pageLoad('prev');">Preview</a>
						<a class="next" href="javascript:void(0);" onclick="bcBoard.pageLoad('next');">Nextview</a>
					</p>
					<ul id="devVod">
						
						
						<li class="video">
							<a href="https://www.youtube.com/watch?v=QCF3PRlmak4&feature=youtu.be">
								<p class="play">PLAY</p>
								<p class="thumb">
								
								<img src="/images/youtube/1.jpg" alt="Video thumbnail">
								
								</p>
								<h3>PROJECT FATALITY VOLTOU 100K DE CASH !!! COMO BAIXA E CRIA CONTA</h3>
							</a>
						</li>
						
						<li class="video">
							<a href="https://www.youtube.com/watch?v=FWCYooEjQ_s">
								<p class="play">PLAY</p>
								<p class="thumb">
								
								<img src="/images/youtube/2.jpg" alt="Video thumbnail">
								
								</p>
								<h3>Project Fatality | Como Baixar e Criar Conta (2020)</h3>
							</a>
						</li>
						
						
						
						
					</ul>
				</div>
			
				<div class="ranking">
					<div class="ranking_tab">
						<a href="javascript:clickRankinTab('individual');" class="current" id="individualTab">INDIVIDUAL RANK</a>
						<a href="javascript:clickRankinTab('clan');" class="" id="clanTab">CLAN RANK</a>
					</div>
					<!--// ê°ì¸ë­í¹ -->
					<div class="individu" style="display: ;">
						<p class="more"><a href="/pages/rankplayer">Mais</a></p>
						<ul>
					
			
						
						<?php 	
				


           	$rankplayery = "SELECT * FROM accounts WHERE rank < '53' AND player_name<>'' AND ban_obj_id='0' AND rank>'5' ORDER BY exp DESC LIMIT 10";
			   
			   foreach ($db->query($rankplayery) as $rowp) 
			   {

                    @$kd = round($kill / ($kill+$dead) * 100);
                  
							
							
						
														
							echo "<li>";
							echo "<p>".$num."</p>";
							echo "<p class='nick'>".$rowp['player_name']."</p>";
							echo "<p class='exp'>".str_replace(",", ".", number_format($rowp['exp']))."</p>";
						
		
							@$hs = ($rowp['headshots_count'] * 100) / $kill2;
							
			
							$num++;
							echo "</li>";
			   }
							
						
					?>
					
						
						</ul>
					</div>
					<!-- ê°ì¸ë­í¹ //-->
					<!--// í´ëë­í¹ -->
					<div class="clan" style="display: none;">
						<p class="more"><a href="/pages/rankclan/">Mais</a></p>
						<ul>
						
						<?php 
              $rankclan = "SELECT * FROM clan_data WHERE owner_id<>0 AND clan_name<>'' ORDER BY clan_exp DESC LIMIT 20";
			  $num = 1;
			  foreach ($db->query($rankclan) as $row1) 
			  {
					
					
					@$kdclan = ($row1['vitorias'] * 100) / $row1['partidas'];
					echo "<li>";
					
								
								
							
					echo "<p>".($num)."</p>";
                    echo "<p class='nick'>".$row1['clan_name']."</p>";
                    echo "<p class='exp'>".$row1['clan_exp']."</p>";
						echo "</li>";
						$num++;} 
            ?>
							
							
							
							
							
							
						
						</ul>
					</div>
					<!-- í´ëë­í¹ //-->
				</div>
			</div>
		</section>
	</div>
	<!--// ë ì´ì´íì(ë¯¸ëì´) -->
	<div class="pop_media">
		<p class="dimmed"></p>
		<div class="video">
			<p class="btn_close"><a href="#">CLOSE</a></p>
			<div class="youtube"><iframe width="960" height="540" src="" frameborder="0"></iframe></div>
			<h3></h3>
		</div>
	</div>
	<!-- ë ì´ì´íì(ë¯¸ëì´) //-->
<script>
	//<![CDATA[
	$(function() {
		$(".vod li a").on("click", function() {
			var name = $(this).parent("li").attr("class"),
				title = $(this).find("h3").text(),
				link = $(this).attr("href");
			$(".pop_media").fadeIn("fast");
			if (name == "video") {
				$(".pop_media .video").fadeIn("fast");
				$(".pop_media .video iframe").attr("src", link);
				$(".pop_media .video h3").empty().append(title);
			}
			return false;
		});
		$(".pop_media .dimmed, .pop_media .btn_close a").on("click", function() {
			$(".pop_media .video iframe, .pop_media .screen img").attr("src", "");
			$(".pop_media").fadeOut("fast");
		});
	});

    var bcBoard = {
    	curPage : 1,
        lastPage : 1,
        pageLoad : function (navi) {
        	if (navi == 'prev') {
        		if (bcBoard.curPage < 2) return;
        		bcBoard.curPage = bcBoard.curPage - 1;
        	}
        	else {
        		if (bcBoard.curPage > bcBoard.lastPage - 1) return;
        		bcBoard.curPage = bcBoard.curPage + 1;
        	}
        	$.ajax({
           	    url: "/ph/video/page",
       			dataType : "json",
       			type: "GET",
       			data:  "page=" + bcBoard.curPage,
       			contentType : "application/x-www-form-urlencoded;charset=UTF-8",
       			success: function (data) {
       				if (data != null) {
       					if (data) {
                        	if (data.length > 0) {
                        		$("#devVod").html("");
                        		var htmlStr = "";
                            	for (var i = 0; i < data.length; i++) {
		                            var row = data[i];
		                            
		                            htmlStr += "<li class=\"video\">";
		                            htmlStr += "<a href=\""+row.link+"\"><p class=\"play\">PLAY</p><p class=\"thumb\">";
									if ($.trim(row.thumbnail)!="") {
										htmlStr += "<img src=\""+row.thumbnail+"\" alt=\"Video thumbnail\"></p>";
									}
									else { 
										htmlStr += "<img src=\"/images/thumb_news.jpg\" alt=\"Video thumbnail\"></p>";
									}
									htmlStr += "<h3>"+row.idx+row.title+"</h3></a></li>";
		                            
                                }
                            	$("#devVod").html(htmlStr);
                            }
       					}
       				}
       			}, error: function(xhr, status, error) {
       				alert("status=" + xhr.status + "\nreadyState=" + xhr.readyState);
       			}
       		});
		}
    };
    
	$(window).on("load", function() {
		
	});
	
	function clickRankinTab(type) {
		if (type != "clan") {
			$("#individualTab").addClass("current");
			$("#clanTab").removeClass("current");
			$(".individu").show();
			$(".clan").hide();
		}
		else {
			$("#individualTab").removeClass("current");
			$("#clanTab").addClass("current");
			$(".individu").hide();
			$(".clan").show();
		}
	}
	$(window).on("load", function() {
		initSimpleBanner();
	});
	function initSimpleBanner(){
		var wrap;
		var W;
		var H;
		var lis;
		var li;
		var banner_nav;
		var nav_ul;
		var cnt;
		var i;
		var itv;
		var type;
		var nav_type;
		$(".banner_wrap").each(function(idx){
			// init variables
			wrap = $(this);
			wrap.data("index", idx);
			wrap.data("current", 0);
			wrap.data("mouseenter", false);
			W = wrap.width();
			H = wrap.height();
			switch(wrap.data("type")){
				case "hslide":
				case "vslide":
				case "alpha":
					type = wrap.data("type");
				break;
				
				default:
					wrap.data("type", "alpha");
					type = "alpha";
				break;
			}
			switch(wrap.data("nav-type")){
				case "numeral":
				case "bullet":
				case "prev_next":
					nav_type = wrap.data("nav-type");
				break;
				
				default:
					wrap.data("nav-type", "bullet");
					nav_type = "bullet";
				break;
			}
			if(isNaN(wrap.data("interval"))){
				wrap.data("interval", 4000);
			}
			lis = wrap.find("ul li");
			cnt = lis.length;
			wrap.data("total", cnt);
			
			// init banners
			if(type == "hslide"){
				lis.each(function(idx, itm){
					li = $(itm);
					li.css("left", W * idx + "px");
				});
			}else if(type == "vslide"){
				lis.each(function(idx, itm){
					li = $(itm);
					li.css("top", H * idx + "px");
				});
			}else{
				lis.each(function(idx, itm){
					li = $(itm);
					if(idx == 0){
						li.css({zIndex:1, opacity:1});
					}else{
						li.css("opacity", 0);
					}
				});
			}
			
			// init navigation
			wrap.append('<div class="banner_nav ' + nav_type + '"><ul></ul></div>');
			banner_nav = wrap.find(".banner_nav");
			nav_ul = wrap.find(".banner_nav ul");
			switch(nav_type){
				case "numeral":
				case "bullet":
					for(i=0; i<cnt; i++){
						nav_ul.append('<li>'+(i+1)+'</li>');
					}
					nav_ul.find("li").bind("click", sbNavClickListener);
					nav_ul.find("li").eq(0).addClass("on");
				break;
				
				case "prev_next":
					nav_ul.append('<li>&lt;</li>');
					nav_ul.append('<li>&gt;</li>');
					nav_ul.find("li").bind("click", sbNavClickListener);
				break;
			}
			
			banner_nav.css("left", (W - banner_nav.width())/2 + "px" );
			
			// rest timer
			i = idx;
			itv = wrap.data("interval");
			//setTimeout("sbAnimateBannerTimer("+i+")", itv);
			wrap.data("stid", setTimeout("sbAnimateBannerTimer("+i+")", itv));
			// init events
			wrap.bind("mouseenter", sbMouseEnterListener);
			wrap.bind("mouseleave", sbMouseLeaveListener);
		});
	}

	/**
	 * mouse enter listener
	 * kill timer on mouse enter
	 */
	function sbMouseEnterListener(e){
		var wrap = $(e.currentTarget);
		wrap.data("mouseenter", true);
		
		if(wrap.data("stid")){
			clearTimeout(wrap.data("stid"));
		}
	}
	/**
	 * mouse leave listener
	 * reset timer on mouse leave
	 */
	function sbMouseLeaveListener(e){
		var wrap = $(e.currentTarget);
		wrap.data("mouseenter", false);
		var n = wrap.data("index");
		var itv = wrap.data("interval");
		wrap.data("stid", setTimeout("sbAnimateBannerTimer("+n+")", itv));
	}

	/**
	 * timer callback function
	 */
	function sbAnimateBannerTimer(idx){
		var wrap = $(".banner_wrap").eq(idx);
		//console.log("timeout", idx, wrap.data("current"), wrap.data("total"), wrap.data("stid"));
		
		var c = wrap.data("current") + 1;
		if(c >= wrap.data("total")){
			c = 0;
		}
		sbAnimateBanner(wrap, c);
	}

	/**
	 * navigation click listener
	 */
	function sbNavClickListener(e){
		var n;
		var nav = $(e.target);
		var wrap = nav.parents(".banner_wrap");
		switch(wrap.data("nav-type")){
			case "numeral":
			case "bullet":
				n = nav.html() - 1;
			break;
			
			case "prev_next":
				var total = wrap.data("total");
				n = wrap.data("current");
				if(nav.html() == "&lt;"){
					n--;
					if(n < 0){
						n = total - 1;
					}
				}else{
					n++;
					if(n >= total){
						n = 0;
					}
				}
			break;
		}
		
		sbAnimateBanner(wrap, n);
	}

	/**
	 * animates banners
	 */
	function sbAnimateBanner(wrap, cur){
		// kill timer
		if(wrap.data("stid")){
			clearTimeout(wrap.data("stid"));
		}
		
		// init variables
		wrap.data("current", cur);
		var type = wrap.data("type");
		var W = wrap.width();
		var H = wrap.height();
		var wrap_ul = wrap.children("ul");
		var wrap_lis = wrap_ul.children();
		var nav_li;
		
		// animate banner
		if(type == "hslide"){
			wrap_ul.stop(true);
			wrap_ul.animate({left:-W*cur+"px"}, 200);
		}else if(type == "vslide"){
			wrap_ul.stop(true);
			wrap_ul.animate({top:-H*cur+"px"}, 200);
		}else{
			var li;
			wrap_lis.each(function(idx, itm){
				li = $(itm);
				li.stop(true);
				if(idx == cur){
					li.css("z-index", 1);
					li.animate({opacity:1}, 200);
				}else{
					li.css("z-index", 0);
					li.animate({opacity:0}, 200);
				}
			});
		}
		
		// update navigation
		switch(wrap.data("nav-type")){
			case "numeral":
			case "bullet":
				wrap.find(".banner_nav ul li").each(function(idx, itm){
					nav_li = $(itm);
					if(idx == cur){
						nav_li.addClass("on");
					}else{
						nav_li.removeClass("on");
					}
				});
			break;
			
			//case "prev_next":
				// do nothing
			//break;
		}
		
		// reset timer
		if(wrap.data("mouseenter") == false){
			var n = wrap.data("index");
			var itv = wrap.data("interval");
			wrap.data("stid", setTimeout("sbAnimateBannerTimer("+n+")", itv));
		}
	}
	//]]>
</script>


	<?php include('_includes/footer.php'); ?>
	</div>
</body>
</html>