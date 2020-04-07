<?php require "templates/header.php"; ?>

<form action="verification.php" method="post" name="login">
  <h1>Connexion</h1>
  <input type="text" name="mail" placeholder="Adresse Email">
  <input type="password" name="userPassword" placeholder="Mot de passe">
  <input type="submit" value="connect " name="submit">
  <p class="box-register">Vous êtes nouveau ici? <a href="create.php">S'inscrire</a></p>
  <?php if (!empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
  <?php } ?>
</form>
</body>


<a href="index.php">Retour à l'accueil</a>
<?php require "templates/footer.php"; ?>