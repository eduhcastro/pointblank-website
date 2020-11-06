<?php
session_start();
error_reporting();
$db = new PDO('pgsql:dbname=postgres;host=localhost;', 'postgres', '123456');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!isset($_SESSION['username'])) {
	
	}else{
        $inicio = $_SESSION['username'];

$rank = $db->prepare("SELECT * FROM accounts WHERE login = '$inicio'");
    $rank->execute();
    $ranking = $rank->fetch(PDO::FETCH_ASSOC);

    $exp = $ranking['exp'];
    $posiçao = $db->query("SELECT * FROM accounts WHERE exp > '$exp' AND rank<'52'");
    $posiçao = $posiçao->fetchAll();
    $posiçao = count($posiçao);

    $pos = $posiçao+1;


$patente = $ranking['rank'];
$emailp = $ranking['email'];
$kill = $ranking['kills_count'];
$dead = $ranking['deaths_count'];
$desistir = $ranking['escapes'];
$ganhar = $ranking['fights_win'];
$perder = $ranking['fights_lost'];
$total = $ranking['fights'];
$hs2 = $ranking['headshots_count'];
@$kdp = round(($ganhar * 100) / $total, 1);
@$kd = round($kill / ($kill+$dead) * 100);
@$hs = round(($hs2 * 100) / $kill, 1);
    }


    $_COOKIE['return'] = $_SERVER["REQUEST_URI"]; 
    $return = $_COOKIE['return'];
    

?>

<script>function openLoginPopup() {
        var url = "";
        
        url = "<p class=\"dimmed\"></p><iframe src=\"/pages/login/?return=<?php echo $return; ?>\" height=\"416\" style=\"border:none;\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        
        $("#layer_popup").html(url).fadeIn("fast");
        //return false;
}</script>
<div id="layer_popup" style="display:none;">
			<p class="dimmed"></p>
			<iframe src="" height="456" frameborder="0" scrolling="no"></iframe>
		</div>