


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
	$("#profile").attr("href", "javascript:void('0');");
	$("#profile").addClass("current");
});
//]]>
</script>

		<?php include("../../_includes/menu-perfil.php"); ?>
		<section class="sub_wrap">
        <?php // if (!isset($_SESSION['username'])) { ?>
			<!--// ì ë³´ ìì ë -->
			
			<!-- ì ë³´ ìì ë //-->
            <?php //} ?>
			
			
			<?php if($ranking['player_name'] = $ranking['player_name']){?>
			<div class="my_rank">
			<?php if($ranking['rank'] <= (9)) {?>
			
				<p><img src="https://pointblank.zepetto.com/images/icon_ranking/rank_0<?php echo $ranking['rank'];?>.png" alt="Rank icon"><?php echo $ranking['player_name']; ?></p>
				<?php }	?>

				<?php if($ranking['rank'] > (9)) {?>
					<p><img src="https://pointblank.zepetto.com/images/icon_ranking/rank_<?php echo $ranking['rank'];?>.png" alt="Rank icon"><?php echo $ranking['player_name']; ?></p>
					<?php }	?>
				<p><span></span></p>
			</div>
			<div class="my_rank_exp">
				<ul>
					<li class="branco"><h4>KILL</h4><?php echo $kill; ?></li>
					<li class="branco"><h4>EXP</h4><?php echo str_replace(",", ".", number_format($ranking['exp'])); ?></li>
					<li class="branco"><h4>POSIÇÃO</h4><?php echo $pos; ?></li>	
				</ul>
			</div>
			<div class="cont_tab">
			
				<div id="tab_normal">
					<ul class="tabmenu">
						<li class="on"><a href="javascript:void(0);">DETALHES</a></li>
					</ul>
					<div class="tab_conts">
						<ul class="rank_match">
							<li>
								<h4>Partidas</h4>
								<p class="branco"><?php echo $total; ?></p>
							</li>	
							<li>
								<h4>Vitorias</h4>
								<p class="branco"><?php echo $ganhar; ?></p>
							</li>
							<li>
								<h4>Derrotas</h4>
								<p class="branco"><?php echo $perder; ?></p>
							</li>	
							<li>
								<h4>Desistencias</h4>
								<p class="branco"><?php echo $desistir; ?></p>
							</li>	
						</ul>
						<ul class="rank_count">
							<li>
								<h4>Kill</h4>
								<p class="branco"><?php echo $kill; ?></p>
							</li>	
							<li>
								<h4>Dead</h4>
								<p class="branco"><?php echo $dead; ?></p>
							</li>	
							<li>
								<h4>Desistencia</h4>
								<p class="branco"><?php echo $desistir; ?></p>
							</li>
							<li>
								<h4>K/D RATE</h4>
								<p class="branco"><?php echo $kd; ?>%</p>
							</li>	
							<li>
								<h4>Headshot</h4>
								<p class="branco"><?php echo round($hs) ?>%</p>
							</li>	
						</ul>
					</div>
				</div>
				
				<div id="tab_season" style="display: none;">
					<ul class="tabmenu">
						<li><a href="javascript:tab_show('1');">Normal Match Data</a></li>
						<li class="on"><a href="javascript:void(0);">Ranking Match Data</a></li>
					</ul>
					<div class="tab_conts">
						<select class="season_list" name="season" id="season">
							
						</select>
						<ul class="rank_match">
							<li>
								<h4>Grade</h4>
								<p id="record_grade"></p>
							</li>
							<li>
								<h4>Match</h4>
								<p id="record_match"></p>
							</li>	
							<li>
								<h4>Win</h4>
								<p id="record_win"></p>
							</li>
							<li>
								<h4>lose</h4>
								<p id="record_lose"></p>
							</li>	
							<li>
								<h4>draw</h4>
								<p id="record_draw"></p>
							</li>	
						</ul>
						<ul class="rank_count">
							<li>
								<h4>Kill</h4>
								<p id="record_kill"></p>
							</li>	
							<li>
								<h4>Assist</h4>
								<p id="record_assist"></p>
							</li>	
							<li>
								<h4>Death</h4>
								<p id="record_death"></p>
							</li>
							<li>
								<h4>K/D Rate</h4>
								<p id="record_kdrate"></p>
							</li>	
							<li>
								<h4>Headshot</h4>
								<p id="record_headshot"> </p>
							</li>	
						</ul>
					</div>
				</div>
				<?php }else{ ?>
					<div class="none" ><p class="nocha">Voce não tem personagem!</p></div>
				<?php } ?>
			
		</section>
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