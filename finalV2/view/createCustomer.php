<?php require('../controller/reqUser/req.createUser.php') ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title> Inscription client</title>

  <link rel="stylesheet" href="css/style.css" />
</head>
<?php require("templates/header.php") ?>
<h2 class="createTitle">S'inscrire</h2>
<div class="underline"></div>   

<form method="post" class="formCreate" onsubmit="return isSubmittable()">
    <div class="firstPart">
        <label for="firstName">Prénom</label>
        <input type="text" name="firstName" id="firstName" placeholder="Prénom" required>
        <label for="lastName">Nom</label>
        <input type="text" name="lastName" id="lastName" placeholder="Nom" required>
        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" placeholder="Adresse email" required>
        <span id='messageEmail'></span>
        <label for="birthDate">Date de naissance</label>
        <input type="date" name="birthDate" id="birthDate" placeholder="dd/mm/aa" required>
        <span id='messageDate'></span>
        <label for="gender">Genre</label>
        <input type="radio" name="gender" value="Homme"> Homme
        <input type="radio" name="gender" value="Femme"> Femme
        <input type="radio" name="gender" value="Autre"> Autre
    </div>
    <div class="secondPart">
        <label for="userPassword">Mot de passe</label>
        <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe" required>
        <span id='messagePass'></span>
        <label for="mdp_verif">Vérification du mot de passe</label>
        <input type="password" name="mdp_verif" id="mdp_verif" placeholder="Mot de passe" required>
        <span id='message'></span> <br></br>
        <input type="submit" name="submit" value="S'inscrire">
        <span id='messageForm'></span>
    </div>
</form>
</br>
<span> Si vous êtes gestionnaire, l'inscription c'est <a class="box-register" href="createManager.php"><strong> ici </strong></a> </span>
<p>Vous avez déjà un compte ? <a class="box-register" href="connect.php"><strong>Se connecter</strong></a></p>
</br>
<a class="box-register" href="index.php"><strong> Retour à l'accueil</strong></a>

<script type="text/javascript" src="../js/checkPassword.js"></script>

<?php require("templates/footer.php") ?>


