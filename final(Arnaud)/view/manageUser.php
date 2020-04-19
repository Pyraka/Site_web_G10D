<?php
require "../controller/reqAdmin/req.manageUser.php"; ?>


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
        </div>
        <form method="POST">
            <div class="secondAdmin">

                <strong> Ajouter un utilisateur manuellement </strong>
                <label for="firstName">Prénom</label>
                <input type="text" name="firstName" id="firstName" placeholder="Prénom" required>
                <label for="lastName">Nom</label>
                <input type="text" name="lastName" id="lastName" placeholder="Nom" required>
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" placeholder="Adresse email" required>
                <label for="birthDate">Date de naissance</label>
                <input type="date" name="birthDate" id="birthDate" placeholder="dd/mm/aa" required>
                <label for="gender">Genre</label>
                <input type="radio" name="gender" value="Homme"> Homme
                <input type="radio" name="gender" value="Femme"> Femme
                <input type="radio" name="gender" value="Autre"> Autre 
                </div>

                <div class="thirdAdmin">
                <label for="userPassword">Mot de passe</label>
                <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe" required >
                <label for="mdp_verif">Vérification du mot de passe</label>
                <input type="password" name="mdp_verif" id="mdp_verif" placeholder="Mot de passe" required >
                <span id='message'></span> <!-- permet d'insérer le message de vérification de mot de passe en js -->
                <label for="productKey">Clé produit</label>
                <input type="int" name="productKey" id="productKey" placeholder="XXXXXXXX"> 
                <br></br>
                <input type="submit" name="submit" value="Ajouter manuellement">
               
        </form>
        <br></br>
            <a classe="retunrBut" href="index.php"> Retour à la page d'accueil</a>
            </div>
            <?php require "templates/footer.php"; ?>
    </body>
</html>



