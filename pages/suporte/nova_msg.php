


<?php
session_start();
 error_reporting(0);
 if (!isset($_SESSION['username'])) {
	echo "<script>alert('Por Favor, Faça o login primeiro!');</script><script>window.location = '/';</script>";
	exit;
	}
require_once('../../include.php');


$stmt = $db->query("SELECT * FROM suporte WHERE nickname='$_SESSION[username]' AND status='0'");
													$rows = $stmt->fetchAll();
													$ticktes_not = count($rows);

													if($ticktes_not === 4){
														echo "<script>alert('Você tem 4 tickets,Aguarde até que todos sejam respondidos');</script><script>window.location='/pages/suporte';</script>"; }

require('../../class/Ranking.class.php');
require('../../class/nome_patente.php');
require('../../_includes/rankp.php');

													

?>
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
			<ul>
				<li class="info"><a href="/pages/info" id="info">INFO</a></li>
				<li class="ticket"><a href="/pages/suporte" id="ticket">SUPORTE</a></li>
				<li class="profile"><a href="/pages/perfil" id="profile">PERFIL</a></li>
			</ul>
			</ul>
		</section>	
		<section class="sub_wrap">
			<div class="explain explain_top">
				<ul>
					<li class="branco">Explique detalhamente seu problema,(Algum problema Interno/Externo/Denuncia) Ou Sugestão.</li>
					<li class="branco">Para melhores resultados, use imagens e videos. (Faça O Upload De videos no Youtube, e Imagens em sites como o prnt.sc.</li>
                    <li class="branco">(Se Existir)Coloque a URL Do Video/Imagem no campo de mensagem</li>
				</ul>
			</div>
			<div class="bbs">
				<form method="POST" name="userForm" id="userForm" class="dev_check_enter" enctype="multipart/form-data">
				<ul class="bbs_write">
					<form >
					<li>
						<h4>Title *</h4>
						<input type="text" name="titulo" id="title" placeholder="TITULO">
					</li>
					<li>
						<h4>MENSAGEM *</h4>
						<textarea name="area1" id="contents" cols="0" rows="0" placeholder="Seu problema - denuncia &frasl; sugestão"></textarea>
					</li>
				 
				</ul>
				
			</div>
            <div class="col-md-12">
											<center><input class="mb-xs mt-xs mr-xs btn btn-sm btn-primary" type="submit" name="go" value="Publicar"/></center>						
										</div>
            
			</div>
		</section>
	</div>
    </form>
	
    <?php


	
									if($_POST['go']){
										if ($_POST['area1'] <> ""){
											if ($_POST['titulo'] <> ""){
												try{
													$stmt = $db->query("SELECT * FROM suporte WHERE nickname='$_SESSION[username]' AND status='0'");
													$rows = $stmt->fetchAll();
													$ticktes_not = count($rows);
												
													if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["titulo"])) || !preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["area1"])))
													{
														echo("<script> alert('Por favor use caracteres alfanumericos');</script><script>window.location='/pages/suporte';</script>");
														exit();
													}
													
													
													if($ticktes_not === 4){
														echo "<script>alert('Você tem 4 tickets,Aguarde até que todos sejam respondidos');</script><script>window.location='/pages/suporte';</script>";
													}else{

														
																												

														$result = $db->prepare("SELECT max(id) as id FROM suporte");
                                                        $result->execute();
                                                         $num_rows = $result->fetchObject();
														
														$id = $num_rows->id + 1;
														$sucesso = $db->prepare("INSERT INTO suporte (nickname, titulo, mensagem, status, id, create_data) VALUES (?,?,?,?,?,?)");

														$sucesso->execute(array($_SESSION[username], $_POST['titulo'], $_POST['area1'], 0, $id, date("Y-m-d H:i:s")));

														if($sucesso>0){
															echo "<script>alert('Ticket Publicado. Aguarde um GM responder!');</script><script>window.location='/pages/suporte';</script>";
														}	
													}
												}catch(Exception $e){
													echo "Erro: ".$e->getMessage();
												}   
											}else{
												echo "<script>alert('O Titulo nao pode ficar em branco');</script>";
											}
										}else{
											echo "<script>alert('O ticket nao pode ficar em branco');</script>";
										}
									}
									?>

<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>
<script type="text/javascript">
function drawMsg(focusId, str) {
	alert(str);
	if ($.trim(focusId)!="") $("#"+focusId).focus();
}

function formSend() {
	sendIt();
	return false;
}

function sendIt() {
	if ($("#category option:selected").val() == "") {
		drawMsg("category", "Please select the category.");
        return;
	} 
    if ($.trim($("#title").val())=="") {
    	drawMsg("title", "Please enter the subject.");
        return;
	}
	/*else if ($.trim($("#title").val()).length < 6 || $.trim($("#title").val()).length > 16) {
		drawMsg("title", "Please enter a subject between 6 and 16 characters.");
		return;
	}*/
	if ($.trim($("#contents").val()).length <= 0) {
		drawMsg("contents", "Please enter your question.");
		return;
	}
	var fileErr = 0;
	$("input:file").each(function() {
		if ($.trim(this.value)!="") {
			if (this.files[0].size > 2097152){
				fileErr = 1;	
				return false;
			}
			var filename = this.value; 
			var ext = filename.split('.').pop().toLowerCase();
			if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
				fileErr = 2;	
				return false;
			}
		}
	});

	if (fileErr == 1) {
		drawMsg("", "The uploaded file exceeds capacity.");
		return;
	}
	else if (fileErr == 2) {
		drawMsg("", "Only images can be uploaded.");
		return;
	}

    var frm = $("#userForm");
    frm.attr("method", "POST");
    frm.attr("action", "/ph/ticket/create");
    frm.attr("onsubmit", "return true");
    frm.submit();
}

function cbEnter() {
	sendIt();
}
$(window).on("load", function() {
	$("#category").val("");	
});
</script>
