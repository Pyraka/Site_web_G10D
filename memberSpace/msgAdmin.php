<?php include "configuration.php";
include "templates/header.php";

$msgReceived = $bdd -> query("SELECT * FROM messaging WHERE idReceiver = 10100");
$msgWritten = $bdd -> query("SELECT * from messaging WHERE idWritter = 10100");


 while($m = $msgReceived->fetch()) { }?>

    <br /><br />
   <a href="adminHome.php"> Retour à la page d'administration</a>
   <?php include "templates/footer.php"; ?>
  </body>
</html>