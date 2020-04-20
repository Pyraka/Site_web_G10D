<?php
require "../model/configuration.php";

   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT *, DATE_FORMAT(birthDate, "Né le %d/%m/%Y") as date_b, DATE_FORMAT(subDate, "Le %d/%m/%Y") as date_s FROM user WHERE idUser = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

   $reqImage = $bdd->prepare("SELECT imageDirectory FROM imageprofil WHERE idImage=?");
   $reqImage -> execute(array($_SESSION['photo']));
   $imageProfil = $reqImage->fetch();

?>