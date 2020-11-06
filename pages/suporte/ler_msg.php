


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

if (isset($_SESSION['username'])) {

   
    }
    
    date_default_timezone_set('America/Sao_Paulo');
?>
<html>
<head>
    <?php include('../../_includes/header.php');
    include('../../_includes/top.php');

   


    if (!isset($_SESSION['username'])) {
        echo "<script>window.location = '/';</script>";
        exit;
    }
    $rank = new Ranking();
    $id = @$_GET['id'];
    $nick = @$_GET['nick'];
    if ($nick != $_SESSION['username']){
        echo "<script>alert('Ticket Inexistente.');</script><script>window.location = '/';</script>";
        exit;
	}
	$ine = $db->query("SELECT * FROM suporte WHERE id = '$id' AND nickname='$nick';");
													$xis = $ine->fetchAll();
													$inexistente = count($xis);

    
    if (($inexistente) != 1){
        echo "<script>alert('Ticket Inexistente.');</script><script>window.location = '?pg=suporte';</script>";
        exit;
	}
	
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
		<section class="visual"><h2>SUPORTE</h2></section>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$("#ticket").attr("href", "javascript:void('0');");
	$("#ticket").addClass("current");
});
//]]>
</script>
		<section class="purchase">
			<div>
				<h4><span><!-- 100,000,000 --></span> <!-- CASH --></h4>
				<h4><span><!-- 100,000,000 --></span> <!-- BONUS CASH --></h4>
				<p class="btn_shop"><a href="/pages/recarga">COMPRAR CASH</a></p>
			</div>
		</section>
		<section class="tab">
			<ul>
				<li class="info"><a href="/pages/info" id="info">INFO</a></li>
				<li class="ticket"><a href="/pages/suporte" id="ticket">SUPORTE</a></li>
				<li class="profile"><a href="/pages/perfil" id="profile">PERFIL</a></li>
			</ul>
		</section>
		<section class="sub_wrap">
			<div class="explain explain_top">
				<p>
                <strong>Você precisa de ajuda?</strong><br>
					Você pode criar um ticket agora mesmo.
					<a class="btn_write" href="/pages/suporte/nova_msg.php">Criar Ticket</a>

				</p>
			</div>
			<div class="bbs">
				
            <article class="view"><table style="text-align: center; width: 100%;">
  <tbody>
    <tr>
      <td style="width: 100%; background-color: rgb(0, 0, 0);"><p>

        <br>
      </p>
	  <?php   $inicio = $_SESSION['username'];
				
				
				$sth = $db->prepare("SELECT * FROM suporte WHERE id = '$id' AND nickname='$nick';");
    $sth->execute();
	$row = $sth->fetch(PDO::FETCH_ASSOC);
				
				
				?>
      <p class="MsoNormal">
      <span style="font-size:10.0pt;line-height:115%;font-family:
" verdana","sans-serif";mso-bidi-font-family:arial"="">
<span style="font-size: 18px; font-family: Arial; color: rgb(255, 255, 255);"><br></span></span></p>
<p class="MsoNormal" style="margin-left: 25px;">
<span style="font-weight: bolder; color: rgb(255, 255, 0); font-size: 18px; font-family: Arial;">Titulo : <?php echo $row['titulo'];?></span><br></p>
<p class="MsoNormal" style="margin-left: 25px;"><font color="#ffffff" face="Arial">
<span style="font-size: 18px;">Status: <?php echo $rank->statusticket($row['status']); ?></span></font></p>
<p class="MsoNormal" style="margin-left: 25px;"><font face="Arial"><span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span>
<span style="font-size: 18px; color: rgb(255, 255, 0);">Sua Mensagem = <br></span>
<span style="font-size: 18px; color: rgb(255, 255, 255);">[ <?php echo $row['nickname']; ?>  ] :</span><span style="color: rgb(255, 255, 0); font-size: 18px; font-weight: bold;"> Data :  </span>
<span style="color: rgb(255, 255, 0); font-size: 18px; font-weight: 700;"><?php echo date("d.m.Y  H:i:s", strtotime($row['create_data']));?></span>
<span style="font-size: 18px; color: rgb(255, 255, 255);">.  </span></font></p>
<p class="MsoNormal" style="margin-left: 25px;"><br>
<span style="color: rgb(255, 255, 255); font-family: Arial; font-size: 18px;"><?php echo $row['mensagem'];?></span></p> <br>
<p class="MsoNormal" style="margin-left: 25px;">
<span style="font-family: Arial; font-size: 18px;">
<p class="MsoNormal" style="margin-left: 25px;"><font face="Arial">
<span style="font-size: 18px; color: rgb(255, 255, 255);">
<br></span></font></p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial">
<span style="font-size: 18px; color: rgb(255, 255, 255);"><br></span></font>
</p><p class="MsoNormal" style="margin-left: 25px;"><font face="Arial">
<span style="font-size: 18px; color: rgb(255, 255, 255);">
<br></span></font></p><p class="MsoNormal" style="margin-left: 25px;">
<br></p><p class="MsoNormal" style="margin-left: 25px;"><br>
<?php if ($row[status] <= 0) {?>
</p><p class="MsoNormal" style="margin-left: 25px;">
<span style="font-size: 18px; color: #FF0505; font-family: Arial;">Ainda Sem Resposta</span>
<?php }else{ ?>
</p><p class="MsoNormal" style="margin-left: 25px;">
<span style="font-weight: bolder; color: #FF0505; font-size: 18px; font-family: Arial;">[ <?php echo $row['gm'];?> ] Resposta :</span><br></p>
<span style="font-size: 18px; color: rgb(255, 255, 255); font-family: Arial;"><br>
</span></p><p class="MsoNormal" style="margin-left: 25px;">
<span style="color: #FF0505; font-family: Arial; font-size: 18px;"><?php echo $row['resposta'];?></span>
<span style="font-size: 18px; color: rgb(255, 255, 255); font-family: Arial;"><br>
</span></p><p class="MsoNormal" style="margin-left: 25px;">
<font face="Arial"><span style="font-size: 18px;">
<span style="color: rgb(255, 255, 255);"> </span> <br>
<span style="font-weight: bold; color: #FF0505;"> DATA DA RESPOSTA : <?php echo date("d.m.Y  H:i:s", strtotime($row['resp_date']));?>
</span>
</font>
</p>
<p class="MsoNormal" style="margin-left: 25px;">
<font face="Arial">
<span style="font-size: 18px;">
<span style="color: rgb(255, 255, 255);">
<br></span></span></font></p><p class="MsoNormal" style="margin-left: 25px;">
<font face="Arial"><span style="font-size: 18px;">
<span style="color: rgb(255, 255, 255);"> </span></span></font></p>
<p style="margin-left: 25px;">
<br style="background-color: rgb(255, 255, 255);">
<?php } ?>
</p></td></tr></tbody></table>
</article>
				<div class="paging">
		
<ul>
</ul>


				</div>
			</div>	
		</section>
	</div>


	<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>
