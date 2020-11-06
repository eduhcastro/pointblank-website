<?php 	

error_reporting(0);
    $bannery = "SELECT * FROM noticias ORDER BY data DESC";
    $num = 1;
    foreach ($db->query($bannery) as $banner) 
    {

    $image = $banner['url_img'];
    $url = $banner['id'];
    echo '<li><a href="pages/ler_noticia/?&id='.$url.'" target="_SELF"><img src="'.$image.'" alt="Main Banner"></a></li>';
                                        
                                                
        } 
    ?>
</ul>		
</div>
</section>

<section class="main_news">
<ul>
<li>
    <h2>Evento</h2>
    
    <?php
    $eventoy = "SELECT * FROM noticias WHERE tipo= 'Eventos' ORDER BY data DESC LIMIT 1";
    $num = 1;
    foreach ($db->query($eventoy) as $evento) 
{
    $ide = $evento['id'];
    $imge = $evento['url_img'];
    $tituloe = $evento['titulo'];
    $datae = $evento['data'];
    $minie = $evento['noticia_mini'];

        echo '<a href="/pages/ler_noticia/?&id='.$ide.'">';
        echo '<img src="'.$imge.'" height="342" width="198" alt="News thumbnail" >';
        echo '<p class="tit">'.$tituloe.' - '.date("d/m/Y", strtotime($datae)).'</p>';
        echo ''.$minie.'';
        echo "</a>";

    } 
?>
        
        
    
            
    
            
        
    
    
        
        
        
    
        
        

        
    
    
</li>
<li>
    <h2>Atualização</h2>
    
    
   
        
    <?php
    $eventoy = "SELECT * FROM noticias WHERE tipo= 'Atualizacao' ORDER BY data DESC LIMIT 1";
    $num = 1;
    foreach ($db->query($eventoy) as $evento) 
{
    $ide = $evento['id'];
    $imge = $evento['url_img'];
    $tituloe = $evento['titulo'];
    $datae = $evento['data'];
    $minie = $evento['noticia_mini'];

        echo '<a href="/pages/ler_noticia/?&id='.$ide.'">';
        echo '<img src="'.$imge.'" height="342" width="198" alt="News thumbnail" >';
        echo '<p class="tit">'.$tituloe.' - '.date("d/m/Y", strtotime($datae)).'</p>';
        echo ''.$minie.'';
        echo "</a>";

    } 
?>
        
        
        
    
        
        
        

        
        
    
    
</li>
<li>
    <h2>Noticia</h2>
    
    
        
        
    <?php
    $eventoy = "SELECT * FROM noticias WHERE tipo= 'Noticias' ORDER BY data DESC LIMIT 1";
    $num = 1;
    foreach ($db->query($eventoy) as $evento) 
{
    $ide = $evento['id'];
    $imge = $evento['url_img'];
    $tituloe = $evento['titulo'];
    $datae = $evento['data'];
    $minie = $evento['noticia_mini'];

        echo '<a href="/pages/ler_noticia/?&id='.$ide.'">';
        echo '<img src="'.$imge.'" height="342" width="198" alt="News thumbnail" >';
        echo '<p class="tit">'.$tituloe.' - '.date("d/m/Y", strtotime($datae)).'</p>';
        echo ''.$minie.'';
        echo "</a>";

    } 
?>
        
        
    
    
</li>
<li>
    <h2>CAMPS</h2>
    
    
    <?php
    $eventoy = "SELECT * FROM noticias WHERE tipo= 'Camps' ORDER BY data DESC LIMIT 1";
    $num = 1;
    foreach ($db->query($eventoy) as $evento) 
{
    $ide = $evento['id'];
    $imge = $evento['url_img'];
    $tituloe = $evento['titulo'];
    $datae = $evento['data'];
    $minie = $evento['noticia_mini'];

        echo '<a href="/pages/ler_noticia/?&id='.$ide.'">';
        echo '<img src="'.$imge.'" height="342" width="198" alt="News thumbnail" >';
        echo '<p class="tit">'.$tituloe.' - '.date("d/m/Y", strtotime($datae)).'</p>';
        echo ''.$minie.'';
        echo "</a>";

    } 
?>
    
        

        
        
        
    
        