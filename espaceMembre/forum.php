<?php include('configuration.php');

$requser = $bdd->query('SELECT *, DATE_FORMAT(date, "Le %d/%m/%Y à %H\h%i") as date_c FROM forum_topic ORDER BY date DESC'); // on pourrait rajouter une LIMIT 10 
$reponse = $requser->fetchAll();



function assignFirstLastName($id){
  global $bdd;
  $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
  $requser->execute(array($id));
  $answer = $requser->fetch();
  echo $answer['firstName'], " ", $answer['lastName'];
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Forum</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>
    <?php
      require('templates/header.php');    
      ?>
      <h1 style="text-align: center;">Forum</h1>
      <?php
      if (isset($_SESSION['id'])){
        ?>
        <a href="createTopic.php" style="">Creer un nouveau sujet</a>
        <?php
      }
      else{
        ?>
        <label>Veuillez vous connecter si vous souhaiter créer un nouveau sujet <a href="connect.php"> se connecter</a></label>

        <?php
      }
      ?>
      
      
      <table style="margin-top: 10px;">
        <tr>
          <th>Titre</th>
          <th>Date</th>
          <th>Par</th>
        </tr>
        <?php
        foreach ($reponse as $key) {
          ?>
          <tr>
            <td>
              <a href="topic.php?id=<?=$key['idTopic']?>"><?= $key['title'] ?></a>
            </td>
            <td>
              <?= $key['date_c'] ?>
            </td>
            <td>
              <?= assignFirstLastName($key['idUser']); ?>
            </td>
          </tr>
        <?php } ?>
      </table>
      
         
          
          
        
      <?php include('templates/footer.php'); ?>
  </body>
</html>