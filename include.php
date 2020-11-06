<?php
//CASTROMS//
   $db = new PDO('pgsql:dbname=postgres;host=localhost', 'postgres', '123456');
   $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>