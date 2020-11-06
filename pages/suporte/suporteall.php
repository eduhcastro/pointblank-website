


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
				<li class="ticket"><a href="" id="ticket">SUPORTE</a></li>
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
				
				<table class="bbs_list bbs_link" cellpadding="0" cellspacing="0">
					
                <section class="sub_purchase">
                <input type="hidden" id="hidPageNo" value="1">
        <table class="bbs_list" id="bbs_list" cellpadding="0" cellspacing="0"><colgroup>
        <col width="25%">
        <col width="25%">
        <col width="20%">
        <col width="30%">
        </colgroup><tbody><tr class="bbs_tit">
        <th scope="col">NUMERO</th>
        <th scope="col">TITULO</th>
        <th scope="col">STATUS</th>
        <th scope="col">GM</th></tr><tr>
        <td class="none" colspan="6">        
					
                <?php
                            		if (!isset($_SESSION['username'])) {
                                        echo "<script>window.location = '/';</script>";
                                        exit;
                                    }
                                    error_reporting(0);
                                    $rank = new Ranking();
                                                
                                    $pagina=$_GET['pagina']; 
                                    if ($pagina == null) {
                                        $pc = "1"; 
                                        $pagina = "1";
                                    } else { 
                                        $pc = $pagina; 
                                    }
                                                
                                    $inicio = $pc - 1; 
                                    $inicio = $inicio * 20;
                                ?>
                            
								
							<?php 
							$ticketay = $db->query("SELECT * FROM suporte WHERE nickname='$_SESSION[username]'");
							$ticketay = $ticketay->fetchAll();
							$ticketa = count($ticketay);

							
							if ($ticketa == 0){ ?>
									<div class="row">
										<div class="col-md-11">
											<div class="panel-body">
												<p class="text-center" style="font-size: 25px;color:Red;">Sem tickets criados</p>
											</div>
										</div>
									</div>
								<?php }else{ ?>
                                    <script>
$(document).ready(function(){
    $('table tr').click(function(){
        window.location = $(this).data('url');
        returnfalse;
    });
});
</script>

							<?php 				
                
				  
					$ticketsall = "SELECT * FROM suporte WHERE nickname='$_SESSION[username]' ORDER BY status DESC, id DESC LIMIT 5";
							$num = 1;
							foreach ($db->query($ticketsall) as $ticketsalla) 
							{

					$titulo = $ticketsalla['titulo'];
					$status = $ticketsalla['status'];
					$gm = $ticketsalla['gm'];
                  

			
       echo '<tr style="cursor:pointer" data-url="/pages/suporte/ler_msg.php?&nick='.$_SESSION['username'].'&id='.$ticketsalla['id'].'">';
       echo '<td class="win"><p class="champion">'.$ticketsalla['id'].'</p></td>';
       echo '<td class="win"><p class="champion">'.$titulo.'</p></td>';
       echo '<td class="win"><p class="champion">'.$rank->statusticket($ticketsalla['status']).'</p></td>';

            echo "<td>$gm</td>";
			$num++;
            echo'</tr>';
           
            
                } 

                
            ?>

						<?php } ?>
				  
				</td></tr></tbody></table>
				<div class="paging">
					<a href="javascript:void(0);" class="first">First</a>
	<a href="javascript:void(0);" class="prev">previous</a>
<ul>
</ul>
	<a href="javascript:void(0);" class="next">Next</a>
	<a href="javascript:void(0);" class="last">End</a>

				</div>
			</div>	
		</section>
	</div>


	<?php include('../../_includes/footer.php'); ?>
	</div>
</body>
</html>
