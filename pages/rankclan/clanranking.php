


<<?php
session_start();
 error_reporting(0);
require_once('../../include.php');
require('../../class/Ranking.class.php');
require('../../class/nome_patente.php');
require('../../class/nome_rank.php');
require('../../_includes/rankp.php');

?>
<html>
<head>
    <?php include('../../_includes/header.php');
    include('../../_includes/top.php');
    $inicio = $_SESSION['username'];
	$rank2 = pg_query("SELECT * FROM accounts WHERE login = '$inicio'");
    $ranking2 = pg_fetch_assoc($rank2);
	
    
	?>


	
		
		<!--// 레이어팝업(회원가입) -->
		<div id="layer_popup" style="display:none;">
			<p class="dimmed"></p>
			<iframe src="" height="456" frameborder="0" scrolling="no"></iframe>
		</div>
		<!-- 레이어팝업(회원) //-->
		
	
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

	<div class="sub_container sub_rank">
		<section class="visual">
			<h2 class="depth">RANK</h2>
			<div class="menu_2depth">
				<p><a href="/pages/rankplayer/">INDIVIDUAL RANK</a></p>
				<p><a href="javascript:void(0);" class="current">CLAN RANK</a></p>
			</div>
		</section>
		<section class="title_tab">
			<div>
				<h3>CLAN RANK</h3>
				<ul>
					<li class="current"><a href="">TOTAL</a></li>
				</ul>
			</div>
		</section>
		<section class="sub_wrap">
			<div class="bbs">
				<table class="bbs_list" cellpadding="0" cellspacing="0">
					<colgroup>
						<col width="108px">
						<col width="60px">
						<col width="*">
						<col width="174px">
						<col width="216px">
						<col width="264px">
					</colgroup>
					<tr class="bbs_tit">
						<th scope="col" class="bbs_red" colspan="2"><h4>RANKING</h4></th>
						<th scope="col" class="bbs_red"><h4>CLANNOME</h4></th>
						<th scope="col" class="bbs_red"><h4>EXP</h4></th>
						<th scope="col" class="bbs_red"><h4>WIN / LOSE</h4></th>
						<th scope="col" class="bbs_red"><h4>CLAN RANK</h4></th>
					</tr>
					
						
							
	
							
								
					<?php 			
  
$rank = new Ranking();
			  	
$pagina=$_GET['pagina']; 
if ($pagina == null) {
	$pc = "1"; 
} else { 
	$pc = $pagina; 
}

$inicio = $pc - 1; 
$inicio = $inicio * 20;
for($b = 0; $b < 20; $b++){
                 
	$posicao = $b+1+$inicio;
	@$kdclan = ($rank->RankingGeralClan($inicio)[$b]['vitorias'] * 100) / $rank->RankingGeralClan($inicio)[$b]['partidas'];


   echo '<tr class="bg">';	
			echo'<td class="win"><p class="champion">'.($posicao).'</p></td>';
		echo'<td class="change">-</td>';
		echo'<td class="tit">'.$rank->RankingGeralClan($inicio)[$b]['clan_name'].'</td>';
		echo '<td><span class="txt_red">'.$rank->RankingGeralClan($inicio)[$b]['clan_exp'].'</span></td>';
		echo '<td>';
		echo $rank->RankingGeralClan($inicio)[$b]['vitorias']." / ".$rank->RankingGeralClan($inicio)[$b]['derrotas'];
		if($rank->RankingGeralClan($inicio)[$b]['partidas'] < (1)){ 
		   echo '<span class="txt"> (0%)</span>';
		}else{
		echo '<span class="txt"> ('.round($kdclan).'%)</span>';
		}
		echo '</td>';
		echo '<td class="rank">';                         
		if($rank->RankingGeralClan($inicio)[$b]['clan_rank'] <=(9)){ 
		echo '<img src="https://pointblank.zepetto.com/images/icon_ranking/clan_0'.$rank->RankingGeralClan($inicio)[$b]['clan_rank'].'.png" alt="Rank icon">';
		}else{
		   echo '<img src="https://pointblank.zepetto.com/images/icon_ranking/clan_'.$rank->RankingGeralClan($inicio)[$b]['clan_rank'].'.png" alt="Rank icon">';
		}
		echo nomec($rank->RankingGeralClan($inicio)[$b]['clan_rank'])."</td>";
echo '</tr>'; 

   
$atual = count($rank->RankingGeralClan($inicio));
if($b > $atual - 2){ break; }
}

					 
					
					 
	  
            ?>
							
                            </table>	
					
					
						
							
							
								
							
					
                            <?php		

$pags = ceil($rank->TotalPaginasClan()); 
$max_links = 5;


for($a = $pagina-$max_links; $a <= $pagina-1; $a++) {
    if($a <=0) { } 
    
    else { 
        echo '<div class="paging">';
    echo "<li><a href='../../pages/rankclan/?&pagina=$a'>$a </a></li> "; 
    } 
} 
echo '<div class="paging">';
 echo '<ul>';
if($pagina == 1){ 

    echo '<li class="current">1</li> ';
}else{

    echo '<li  class="current">'.$pagina.'</li> ';
}

for($a = $pagina+1; $a <= $pagina+$max_links; $a++) {
    if($a > $pags) {} 
    else { 
    echo "<li><a  href='../../pages/rankclan/?&pagina=$a'>$a</a></li>"; 
    } 
} 

echo " <li> <a  href='../../pages/rankclan/?&pagina=".$pags."'>".$pags."</a></li>";

echo '</ul>';
?>
</div>
</div>
</section>
							
							
						
				
				
<section class="rank_explain">
			<ul>
				<li>O Ranking é atualizado todo dia.</li>
				<li>Normalmente demora 24hrs para o Ranking Atualizar</li>
				<li>Clans com mais Rank/XP estão no TOPO,caso não o veja no ranking do seu clan,mude a pagina.</li>
				<li>Em breve novos recursos no ranking,aguarde.</li>
				<li>Tenha um bom jogo!</li>
			</ul>
		</section>
		
	
	</div>
	<script type="text/javascript"> 
	//<![CDATA[
	function inon(obj,idnm)
	{if(obj.value=='') document.getElementById(idnm).style.display='none'; obj.className='entry'}
	function inout(obj,idnm)
	{if(obj.value=='') document.getElementById(idnm).style.display='block'; obj.className='basic'}
	function inup(obj,idnm)
	{if(obj.value.lengt>0) document.getElementById(idnm).style.display='none';}
	
	function goPage(n) {
		var url = "/ph/ranking/individual/list";
		var keyword = $('#keyword').val();
		
		url += "?page=" + n;
		url += "&termtype=3";
		url += "&keyword="+encodeURIComponent(keyword);
	
		document.location.href = url;
	}

	function goSearch() {
		var url = "/ph/ranking/individual/list";
		var keyword = $('#keyword').val();

		url += "?termtype=3";
		url += "&keyword="+encodeURIComponent(keyword);

		document.location.href = url;
	}
	
	function goRankType(n) {
		var url = "/ph/ranking/individual/list";
		
		url += "?termtype=" + n;
	
		document.location.href = url;
	}

	function getDetail(termtype, uid, nick) {
		$.ajax({
		    url: "/ph/ranking/individual/detail",
			dataType : "json",
			type: "GET",
			data:  "termtype="+ termtype+"&uid="+uid,
			contentType : "application/x-www-form-urlencoded;charset=UTF-8",
			success: function (data) {
				if (data != null && data.rank && parseInt(data.rank) > 0) {
					setRankDetailView(true, data, nick)
				}else {
					alert("An error has occurred.");
				}
			}, error: function(xhr, status, error) {
				alert("status=" + xhr.status + "\nreadyState=" + xhr.readyState);
			}
		});
	}
	
	function setRankDetailView(isView, data, nick) {
		if (isView == true) {
			$(".popup .nickname").empty().text(nick);
			//$("#layer_nick").text(data.Nick);
			
			$("#layer_exp").html("<span class=\"tit\">EXP</span>"+data.exp);
			$("#layer_rank").html("<span class=\"tit\">RANKING</span>"+data.rank);
			$("#layer_clan").html("<span class=\"tit\">CLAN</span>"+data.clanName);
			
			$("#layer_kill").text(data.kill);
			$("#layer_death").text(data.death);
			$("#layer_headshot").text(data.headshot);

			$("#layer_clanmaster").text(data.clanMasterNick);
			$("#layer_clanrank").text(data.clanExpRank);
			$("#layer_clanmembers").text(data.clanTroops);
			
			$("#layer_rankdetail").fadeIn();
		}
		
	}

	$(document).ready(function () {
		$("#nickname").focusin(function() {
			if ($.trim($("#keyword").val())=="") $(this).val("");
		}).focusout(function() {
			var keyword = $(this).val()
			keyword = keyword.replace(/\\/gi,"\\\\");
			keyword = keyword.replace("\"","\\\"");
			$("#keyword").val(keyword);	
		});
		$(".popup .dimmed, .btn_pop_close a").on("click",function() {
			$(".popup").hide();
		});
		$("#keyword").keydown(function(key) {
			if (key.keyCode == 13 && $.trim($(this).val())!="") {
				goSearch();
			}
		});
		if ($.trim($("#keyword").val())!="") $("#search").hide();
	});
	//]]>
	</script>


<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>