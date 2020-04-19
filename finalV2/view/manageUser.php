<?php
require ("../model/configuration.php");
require ("../controller/functions.php");

   //ajout d'un utilisateur


 if (isset($_POST['submit'])) {
         echo("Les mots de passe ne sont pas identiques");
    }


else if(isset($_GET['ban'])){    
    if (isBan($_GET['ban'])==true){ echo "Cet utilisateur est déjà bannis.";}
   //bannissment d'un utilisateur
   else{
   $ban = (int) $_GET['ban'];
   $req = $bdd->prepare('INSERT INTO ban(idUser, dateBan) VALUES (?,NOW())');
   $req -> execute(array($ban));
   }
}//débannissmenet d'un utilisateur
    else if(isset($_GET['deban'])){
        if (isBan($_GET['deban'])!== true){echo "Cet utilisateur est déjà non bannis.";}
        else{
            $deban = (int) $_GET['deban'];
            $req = $bdd->prepare('DELETE FROM ban WHERE idUser = ?');
            $req->execute(array($deban));
        }
}

$members = $bdd->query('SELECT * FROM user WHERE allow = 0'); //allow = 0 c'est un utilisateur
$managers = $bdd->query('SELECT * FROM user WHERE allow = 1'); //allow = 1 c'est un gestionnaire (hors cas admin alow = 2)
$admins = $bdd->query('SELECT * FROM user WHERE allow = 2 ORDER BY idUser DESC'); // admin = 2
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
    <title>Administration utilisateur</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

        <?php require "templates/header.php"; ?>
        <h2 class="manageUsers" > Utilisateurs </h2>
        <div class = "underline"> </div> 
        <div class="firstAdmin">

        <ul class="pucesUser">
        <a> <strong>Clients</strong></a>
        <br></br>

            <?php while($m = $members->fetch()) { ?>
            <li>
            <?= $m['email'] ?> - <a href="modifyProfile.php?id=<?= $m['idUser'] ?>">Modifier</a>
            <?php
            if (isban($m['idUser'])){
                ?>
                - (banni)
                - <a href="manageUser.php?deban=<?= $m['idUser'] ?>">Débannir </a>
                
                <?php
            }else{
                ?>
                - <a href="manageUser.php?ban=<?= $m['idUser'] ?>">Bannir </a>
                - <a href="messagerie.php?id=<?= $m['idUser'] ?>">Message</a>
                <?php
            }
            ?>
            
            </li>
             
            <?php } ?>
        </ul>
        
        <ul>
        <a> <strong>Gestionnaires</strong></a>
        <br></br>
            <?php while($m = $managers->fetch()) { ?>
            <li>
            <?= $m['email'] ?> - <a href="modifyProfile.php?id=<?= $m['idUser'] ?>">Modifier</a>
            <?php
            if (isban($m['idUser'])){
                ?>
                - (banni)
                - <a href="manageUser.php?deban=<?= $m['idUser'] ?>">Débannir </a>
                
                <?php
            }else{
                ?>
                - <a href="manageUser.php?ban=<?= $m['idUser'] ?>">Bannir </a>
                - <a href="messagerie.php?id=<?= $m['idUser'] ?>">Message</a>
                
                <?php
            }
            ?>
            
            </li>
            <?php } ?>
        </ul>
        <ul>
        <a> <strong>Admins</strong></a>
        <br></br>
            <?php while($m = $admins->fetch()) { ?>
            <li>
            <?= $m['email'] ?>
            - <a href="messagerie.php?id=<?= $m['idUser'] ?>">Message</a>
            </li>
            <?php } ?>
        </ul>

        <h2><a href="createAdmin.php">Ici</a> pour créer un utilisateur manellement </h2>
        

<script type="text/javascript" src="../js/checkPassword.js"></script>


<?php //require "templates/footer.php"; ?>