<?php include('../../_includes/recarga.php'); 

error_reporting(0);

$username = $_SESSION['username'];
$playerid = $_SESSION['player_id'];
$pin = $_POST["pin"];
$cuponfilter = substr($pin, 0, 5);

if ($cuponfilter == "CUPON"){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['captcha'] == $_SESSION['cap_code']) {
    

            if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["pin"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos!');</script>");
	exit();
}

if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["captcha"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos!');</script>");
	exit();
}

            $db = new PDO('pgsql:dbname=postgres;host=127.0.0.1;port=5535', 'postgres', '871414');
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
            $pin = $_POST["pin"];
    $datax = date("d/m/Y");
    
    
    error_reporting(0);             
    
        $cuponsall = $db->query("SELECT * FROM cupon WHERE cupon = '$pin'");
        $cuponsall = $cuponsall->fetchAll();
        $cuponsactive = count($cuponsall);
    
            if($cuponsactive > 0){
                $sql = $db->query("SELECT * FROM cupon WHERE cupon = '$pin'");
                while ($rows = $sql->fetch()){
                    $itemnome = $rows['citem_name'];
                    $itemid = $rows['citem_id'];
                    $count = $rows['c_count'];
                    $categoria = $rows['c_category'];
                    $equip = '1';
                }
                
                $inicio = $_SESSION['username'];
                $rank = "SELECT * FROM accounts WHERE login = '$inicio'";
                foreach ($db->query($rank) as $ranking);
                
                $strSQL3 = $db->prepare("INSERT INTO player_items (item_id,item_name,count,category,equip, owner_id) VALUES (?,?,?,?,?,?)");
                $strSQL3->execute(array($itemid, $itemnome, $count, $categoria, $equip, $ranking['player_id']));
    
    
                if($strSQL3->rowCount()){
                        
                        $query324 = $db->prepare("DELETE FROM cupon WHERE cupon = '$pin'");
                        $query324->execute();
                    
      
    
                    echo "<script>alert('Cupon ativado com sucesso');</script><script>window.location = '/pages/cupon';</script>";
                }else{
                    echo "<script>alert('Erro Interno');</script>";
                }
            }else{
                echo "<script>alert('Cupon code Invalido');</script>";
            }
        }else{
            echo "<script>alert('O Captcha esta errado!');</script>";
        }	
    }
    }else{
        $username = $_SESSION['username'];
$playerid = $_SESSION['player_id'];
$pin = $_POST["pin"];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['captcha'] == $_SESSION['cap_code']) {

        $db = new PDO('pgsql:dbname=postgres;host=127.0.0.1;port=5535', 'postgres', '871414');
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
		$pin = $_POST["pin"];
$datax = date("d/m/Y");


if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["pin"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos!');</script>");
	exit();
}

if(!preg_match("#^[aA-zZ0-9\-_]+$#",trim($_POST["captcha"])))
{
	echo("<script> alert('Por favor use caracteres alfanumericos!');</script>");
	exit();
}


    $pinsall = $db->query("SELECT * FROM pin WHERE pin = '$pin'");
    $pinsall = $pinsall->fetchAll();
    $pinsactive = count($pinsall);

		if($pinsactive > 0){
            $sql = $db->query("SELECT * FROM pin WHERE pin = '$pin'");
            while ($rows = $sql->fetch()){
				$valor1 = $rows['valor'];
            }
            
           
            $sql = "UPDATE accounts SET money=money+? WHERE login=?";
            $stmt= $db->prepare($sql);
            $stmt->execute([$valor1, $username]);
			if($stmt->rowCount()){
                    $strSQL1 = $db->prepare("INSERT INTO pin_log (login,pin,valor,data) VALUES (?,?,?,?)");
                    $strSQL1->execute(array($username, $pin, $valor1, $datax));
                    $query32 = $db->prepare("DELETE FROM pin WHERE pin = '$pin'");
                    $query32->execute();
				
  

				echo "<script>alert('Pin-Code ativado com sucesso');</script><script>window.location = '/pages/cupon';</script>";
			}else{
				echo "<script>alert('Erro Interno');</script>";
			}
		}else{
			echo "<script>alert('Pin code Invalido');</script>";
		}
	}else{
		echo "<script>alert('O Captcha esta errado!');</script>";
	}	
}
    }
?>

<style>
    .vermelho{
        color: #FFF;
    }
    </style>

<script type="text/javascript" src="/js/javascript/pin.js"></script>
<section class="sub_purchase">
    <ul class="tab">
        <li class="topup" date-view-page="Topup"><a href="/pages/recarga/">TOPUP</a></li>
        <li class="coupon current" date-view-page="Coupon"><a href="">COUPON</a></li>
        <li class="history" date-view-page="History"><a href="/pages/historico">HISTORY</a></li>
    </ul>
    <div class="coupon_entry" style="
    height: 400px;
">
        <div>
            <h2>COUPON</h2>
            <form id="pincode" name="pincode" method="post" action="">
            <p class="txt">Ative o CUPON! Receba CASH Na hora!</p>
            <p class="input">
                <label id="coupoan"></label>
                <input type="text" id="pin" name="pin" maxlength="16" placeholder="Insira aqui seu PIN Code de 16 números" autocomplete="off">
<button id="btnCouponReg">APPLY</button>
<h2 class="vermelho">CAPTCHA</h2>
<img src="/captcha.php"/><Br>
<input type="text" name="captcha" id="captcha" autocomplete="off"/>
                
            </p>
        </div>
        </form>
    </div>
    <ul class="coupon_explain">
        <li class="tit"><h4>AVISO</h4></li>
        <li class="txt">Todos os PIN-CODES Só podem ser ativados 1 vez</li>
        <li class="txt">Você pode ativar quantos PINs Desejar!</li>
        <li class="txt">Você pode ativar seu PIN em qualquer conta!</li>
    </ul>
</section>


<!-- 레이어팝업(쿠폰사용완료) -->
<div class="popup successPopup" style="display: none;">
    <p class="dimmed"></p>
    <div class="popup_layout">
        <p class="completed">
            <strong>COMPLETED</strong>
            Your coupon code has been successfully confirmed.<br>
            Please click the HISTORY menu below to check your item status.
        </p>
        <div class="pop_btn">
            <a class="btn_gy" href="javascript:;">Close</a>
            <a class="btn_rd" href="/History/Index">HISTORY</a>
        </div>
    </div>
</div>
<!-- //레이어팝업(쿠폰사용완료) -->

<!-- 레이어팝업(쿠폰사용실패) -->
<div class="popup failPopup" style="display: none;">
    <p class="dimmed"></p>
    <div class="popup_layout">
        <p class="warning">
            <strong>Sorry, unexpected error ocurred.</strong>
            <span id="couponErrMsg"></span><br><br>
            If you have any other inquiries,<br>
            please contact us by e-mail. <span>ask_pbph@zepetto.biz</span><br>
            Thank you.
            <br><br>
        </p>
        <div class="pop_btn">
            <a class="btn_rd" href="javascript:;">Close</a>
        </div>
    </div>
</div>
<!-- //레이어팝업(쿠폰사용실패) -->
        <!---------- END BODY ---------->
    </div>

    <!---------- BEGIN FOOTER ---------->
    <footer>
        <img src="/Common/Images/footer_zepetto.png" alt="PT. Zepetto Interactive Philippines">
        <p>2020</p>
        <a class="top" href="#">TOP</a>
    </footer>
    <!---------- END FOOTER ---------->


    <!---------- BEGIN AJAX LODER IMAGE ---------->
    <section class="loding"><p><img src="/Common/Images/loading.gif" alt="Loading"></p></section>

    <!---------- END AJAX LODER IMAGE ---------->

    <!---------- BEGIN BLOCK CSRF TOKE ---------->
    <!---------- END BLOCK CSRF TOKE ---------->

    <!---------- BEGIN FOOTER SCRIPT ---------->
    <!---------- BEGIN FOOTER SCRIPT ---------->

</body></html>