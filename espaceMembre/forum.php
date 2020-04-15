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
          <div class="creersujet">
              <a href="createTopic.php" >Creer un nouveau sujet</a>
          </div>

              <?php
      }
      else{
        ?>
        <label>Veuillez vous connecter si vous souhaiter créer un nouveau sujet <a href="connect.php"> se connecter</a></label>

        <?php
      }
      ?>
      
      <div class="tableforum" >
          <table style="margin-top: 10px;">
              <div class="contenuforum" style="">
                  <tr style="background:linear-gradient(#8BACED,white)">
                      <th>Titre</th>
                      <th>Date</th>
                      <th>Par</th>
                  </tr>
              <?php
              foreach ($reponse as $key) {
                  ?>
                  <tr >
                      <td style="text-decoration: none;text-align: center;font-family: 'Franklin Gothic Medium'">
                          <a href="topic.php?id=<?=$key['idTopic']?>"><?= $key['title'] ?></a>
                      </td>
                      <td>
                          <?= $key['date_c'] ?>
                      </td>
                      <td>
                          <?= assignFirstLastName($key['idUser']); ?>
                      </td>
                  </tr>
              </div>
              <?php } ?>
          </table>
      </div>

      
         
          
          
        
      <?php include('templates/footer.php'); ?>
  </body>
</html>