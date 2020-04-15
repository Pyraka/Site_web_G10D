<?php include "configuration.php";
include "templates/header.php"; ?>



<title>Page d'administration</title>

Bonjour, Administrateur <!-- http://localhost/APPmaster/adminSpace/secure/adminHome.php -->
<ul>
  <li>
    <a href="manageUser.php"><strong>Gérer les utilisateurs</strong></a>
  </li>
  <li>
    <a href="manageKey.php"><strong>Gérer les clés produit</strong></a>
  </li>

  <li><a href="msgAdmin"><strong>Messagerie administrative</strong>
</li>
  
    

</ul>
<a href="index.php"> <strong>Retour à l'accueil</strong>

<?php include "templates/footer.php"; ?>
  </body>
</html>
