


<?php
session_start();
 error_reporting(0);
 if (!isset($_SESSION['username'])) {
	echo "<script>alert('Por Favor, Faça o login primeiro!');</script><script>window.location = '/';</script>";
	exit;
	}
require_once('../../include.php');
require('../../class/Ranking.class.php');
require('../../class/nome_patente.php');
require('../../_includes/rankp.php');
$block = substr($emailp, 5, 15);

?>
<html>
<head>
    <?php include('../../_includes/header.php');
    include('../../_includes/top.php');
    
	?>
	
		
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
            url = "<p class=\"dimmed\"></p><iframe src=\"/ph/login/form\" height=\"576\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        else {
        	url = "<p class=\"dimmed\"></p><iframe src=\""+param+"\" height=\"576\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        $("#layer_popup").html(url).fadeIn("fast");
        //return false;
    }
	//]]>
	</script>
	</header>

	<div class="sub_container sub_my">
		<section class="visual"><h2>MINHA CONTA</h2></section>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$("#info").attr("href", "javascript:void('0');");
	$("#info").addClass("current");
});
//]]>
</script>

		<?php include("../../_includes/menu-perfil.php"); ?>
		<section class="sub_wrap">
        <div class="my_info">
				<div class="detail">
					<h3>Personal Details</h3>
					<ul>
						<li>
							<p class="tit">ID</p>
							<p class="cont"><strong><?php echo $inicio ?> </strong></p>
						</li>
						<li>
							<p class="tit">SENHA</p>
							<p class="cont">************</p>
							<a class="btn_h36_rd" href="javascript:windowPopup('/pages/password/');">EDITAR</a>
						</li>
						<li>
							<p class="tit">E-MAIL</p>
							<p class="cont">****<?php echo $block ?>**</p>
							<a class="btn_h36_rd" href="javascript:windowPopup('/pages/email/');">EDITAR</a>
												
						</li>
						
						<!-- <li>
							<p class="tit">HANDPHONE NUMBER</p>
							<p class="cont"></p>
							<a class="btn_h36_rd" href="javascript:windowPopup('/phone/change/input');">IDENTIFICATION</a>
							<span class="emp_btn">Users who have received verification message can use premium channel.</span>
						</li>
						<li>
							<p class="tit">SMS SERVICE</p>
							<div class="btn_toggle">
							
					        	
					        	
								<a id="phoneAllow0" href="javascript:receiveAgree('phone',0);" class="on">DISAGREE</a>
								<a id="phoneAllow1" href="javascript:receiveAgree('phone',1);">AGREE</a>
					        	
					        
							</div>				
						</li> -->
						
					</ul>					
				</div>
				
					
				</div>
			</div>
		</section>
		<div id="layer_popup" class="layer_popup_center" style="display: none;">
			<p class="dimmed"></p>
		</div>
	</div>
<script type="text/javascript">
//<![CDATA[
function windowPopup(url) {
	openLayerPopup(url);
	$( 'html, body' ).animate( { scrollTop : 280 }, 10 );
}

function tab_show(tab_my_rank) {
	
	document.all.tab_normal.style.display="none";
	document.all.tab_season.style.display="none";

	switch(tab_my_rank) {
	case '1': document.all.tab_normal.style.display=""; break;
	case '2': document.all.tab_season.style.display=""; break;

}}
$(document).ready(function() {
	$("#season").change(function() {
		$.ajax({
		    url: "/ph/mypage/season/record",
			dataType : "json",
			type: "GET",
			data:  "seasonId="+ $(this).val(),
			contentType : "application/x-www-form-urlencoded;charset=UTF-8",
			success: function (data) {
				if (data != null) {
					for (var key in data) {
						$("#record_"+key).html(data[key]);
					}
				}else {
					alert("An error has occurred.");
				}
			}, error: function(xhr, status, error) {
				alert("status=" + xhr.status + "\nreadyState=" + xhr.readyState);
			}
		});
	});
});
//]]>
</script>


<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>