<?php
error_reporting(0);
$db = new PDO('pgsql:dbname=postgres;host=localhost', 'postgres', '123456');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class Ranking {
    
    private $top_players;
    private $top_clan;
    private $rank;
    private $quantidade = 10;
    private $quantidade2 = 10;
    private $quantidade_pag = 20;
    private $quantidade_pag2 = 20;
	
    function clanTop(){
        try{
            $ranking2 = pg_query("SELECT * FROM clan_data ORDER BY clan_rank DESC LIMIT 10");
            $this->top_clan = pg_fetch_all($ranking2);
        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
        
    } 
    
    function getQuantidade_pag() {
        return $this->quantidade_pag;
    }
	
	function getQuantidade_pag1() {
        return $this->quantidade_pag2;
    }

    function TotalPaginas(){
        try{
			global $db;

		 $rank = $db->query("SELECT * FROM accounts WHERE rank<'53' AND player_name<>'' AND rank>'5' AND ban_obj_id='0'");
    $rank = $rank->fetchAll();
    $total = count($rank);
            $tp = $total / $this->quantidade_pag;
            return $tp;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
        
	}
	


    
    function TotalPaginasClan(){
        try{

			global $db;
$rank = $db->query("SELECT * FROM clan_data WHERE owner_id<>0 AND clan_name<>''");
    $rank = $rank->fetchAll();
    $total = count($rank);
            $tp = $total / $this->quantidade_pag;
            return $tp;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
        
    }

	
	function Historico($inicio){
        try{
			$inicioa = $_SESSION['username'];
            $rank = pg_query("SELECT * FROM pin_log WHERE login = '$inicioa' ORDER BY data DESC LIMIT 10  OFFSET '$inicio'");
            $ranking = pg_fetch_all($rank);
            return $ranking;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
	}
	

	function RankingGeral($inicio){
        try{
			global $db;

			$rank = $db->prepare("SELECT * FROM accounts WHERE rank < '53' AND player_name<>'' AND ban_obj_id='0' AND rank>'5' ORDER BY exp DESC LIMIT 20 OFFSET '$inicio'");
			$rank->execute();
			$ranking = $rank->fetchAll();
            return $ranking;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
	}
	
    function RankingGeralClan($inicio){
		try{
			global $db;
			$rank1 = $db->prepare("SELECT * FROM clan_data WHERE owner_id<>0 AND clan_name<>'' ORDER BY clan_exp DESC LIMIT 20 OFFSET '$inicio'");
	$rank1->execute();
	$ranking1 = $rank1->fetchAll();
			return $ranking1;
		}catch(PDOException $e){
			echo "Erro: ".$e->getMessage();
		}
	}
	
    function getTop_players() {
        return $this->top_players;
    }
	
	function getTop_clan() {
        return $this->top_clan;
    }

    function getQuantidade() {
        return $this->quantidade;
    }
	
	function getQuantidade2() {
        return $this->quantidade2;
    }
	
	
	function anti_injection($sql){
		// remove palavras que contenham sintaxe sql
		$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
		$sql = trim($sql);//limpa espaços vazio
		$sql = strip_tags($sql);//tira tags html e php
		$sql = addslashes($sql);//Adiciona barras invertidas a uma string
		return $sql;
	}

	
	function nome($numero){
		$i = $numero;
		switch ($i) {
			case 0:
				echo "Novato";
				break;
			case 1:
				echo "Recruta";
				break;
			case 2:
				echo "Soldado";
				break;
			case 3:
				echo "Cabo";
				break;
			case 4:
				echo "Sargento";
				break;
			case 5:
				echo "3º Sargento 1";
				break;
			case 6:
				echo "3º Sargento 2";
				break;
			case 7:
				echo "3º Sargento 3";
				break;
			case 8:
				echo "2º Sargento 1";
				break;
			case 9:
				echo "2º Sargento 2";
				break;
			case 10:
				echo "2º Sargento 3";
				break;
			case 11:
				echo "2º Sargento 4";
				break;
			case 12:
				echo "1º Sargento 1";
				break;
			case 13:
				echo "1º Sargento 2";
				break;
			case 14:
				echo "1º Sargento 3";
				break;
			case 15:
				echo "1º Sargento 4";
				break;
			case 16:
				echo "1º Sargento 5";
				break;
			case 17:
				echo "2º Tenente 1";
				break;
			case 18:
				echo "2º Tenente 2";
				break;
			case 19:
				echo "2º Tenente 3";
				break;
			case 20:
				echo "2º Tenente 4";
				break;
			case 21:
				echo "1º Tenente 1";
				break;
			case 22:
				echo "1º Tenente 2";
				break;
			case 23:
				echo "1º Tenente 3";
				break;
			case 24:
				echo "1º Tenente 4";
				break;
			case 25:
				echo "1º Tenente 5";
				break;
			case 26:
				echo "Capitao 1";
				break;
			case 27:
				echo "Capitao 2";
				break;
			case 28:
				echo "Capitao 3";
				break;
			case 29:
				echo "Capitao 4";
				break;
			case 30:
				echo "Capitao 5";
				break;
			case 31:
				echo "Major 1";
				break;
			case 32:
				echo "Major 2";
				break;
			case 33:
				echo "Major 3";
				break;
			case 34:
				echo "Major 4";
				break;
			case 35:
				echo "Major 5";
				break;
			case 36:
				echo "Tenente Coronel 1";
				break;
			case 37:
				echo "Tenente Coronel 2";
				break;
			case 38:
				echo "Tenente Coronel 3";
				break;
			case 39:
				echo "Tenente Coronel 4";
				break;
			case 40:
				echo "Tenente Coronel 5";
				break;
			case 41:
				echo "Coronel 1";
				break;
			case 42:
				echo "Coronel 2";
				break;
			case 43:
				echo "Coronel 3";
				break;
			case 44:
				echo "Coronel 4";
				break;
			case 45:
				echo "Coronel 5";
				break;
			case 46:
				echo "General de Brigada";
				break;
			case 47:
				echo "General de Divisao";
				break;
			case 48:
				echo "General de Exercito";
				break;
			case 49:
				echo "Marechal";
				break;
			case 50:
				echo "Heroi de Guerra";
				break;
			case 51:
				echo "Hero";
				break;
			case 53:
				echo "Game Master";
				break;
		}
	}
	
	function clan($numero){
		if ($numero == 0){
			echo "-";
		}else{
			try{
				$rank = pg_query("SELECT * FROM clan_data WHERE clan_id = '$numero'");
				$ranking = pg_fetch_assoc($rank);
				$total = pg_num_rows($rank);
				if ($total == 0){
					echo "-";
				}else{
					echo "".$ranking['clan_name']."";
				}
			}catch(PDOException $e){
				echo "Erro: ".$e->getMessage();
			}
		}
	}
	
	function statusticket($numero1){
		if ($numero1 == 0){
			return "<span style='color:#FF0505;'>Pendente</span>";
		}else{
			return "<span style='color:Green;'>Respondido</span>";
		}
	}
	
	function tipodeconta($numero){
		if ($numero == 0)
			echo "Normal";
		else if ($numero == 1)
			echo "Premium";
		else if ($numero == 2)
			echo "Vip Gold";
		else if ($numero == 3)
			echo "Youtuber";
		else if ($numero == 4)
			echo "Moderador";
		else if ($numero == 5)
			echo "Administrador (<a href='painel_de_adm/' style='text-decoration:none;color:red;'>Painel ADM</a>)";
	}

    
}