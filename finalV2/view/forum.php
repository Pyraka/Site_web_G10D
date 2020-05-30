<?php 
 require ('../controller/req.forum.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Forum</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
    <?php
      require('templates/header.php');    
      ?>
      <div class="bodyForum">
      <h1 id="titleForum">Forum</h1>
      <div class="underline"></div>

      <?php
      if (isset($_SESSION['id'])){
        ?>
          <div class="creersujet">
              <a href="createTopic.php"> Creer un nouveau sujet </a>
          </div>

              <?php
      }
      else{
        ?>
        <br>
        <label id="coToGo">Veuillez vous connecter si vous souhaiter créer un nouveau sujet <a class="box-register" href="connect.php"> se connecter</a></label>
        <br>

        <?php
      }
      ?>
      
      <div class="tableforum" >
          <table>
              <div class="contenuforum" >
                  <tr class ="topCol">
                      <th>Titre</th>
                      <th>Date</th>
                      <th>Par</th>
                  </tr>
              <?php
              foreach ($reponse as $key) {
                  ?>
                  <tr >
                      <td id="idTopic">
                          <a class="textTopic" href="topic.php?id=<?=$key['idTopic']?>"><?= $key['title'] ?></a>
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

      
  </body>
</html>
      <?php //require('templates/footer.php'); ?>