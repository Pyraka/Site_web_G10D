<?php

function isIdBan($idBan){
    include "configuration.php";
    $allBan = $bdd ->prepare('SELECT * FROM ban WHERE idUser = ?');
    $allBan -> execute(array($idBan));
     $banExist = $allBan->rowCount();

      if($banExist != 0){
        return true;
      }
}
?>