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

function isEmailBan($email){
    if (session_status()!==PHP_SESSION_ACTIVE){session_start();}
    include "configuration.php";
    $emailBan = $bdd -> prepare('SELECT idUser FROM email = ? ');
    $emailBan -> execute(array($email));

    echo " bojjour";

    if(isIdBan($emailBan)==true){
        return true;
    }

    else return false;
}

?>