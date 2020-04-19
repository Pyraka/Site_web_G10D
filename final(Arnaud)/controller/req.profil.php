<?php
require "../model/configuration.php";

   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();



   $reqImage = $bdd->prepare("SELECT imageDirectory FROM imageprofil WHERE idImage=?");
   $reqImage -> execute(array($userinfo['idImage']));
   $imageProfil = $reqImage->fetch();

