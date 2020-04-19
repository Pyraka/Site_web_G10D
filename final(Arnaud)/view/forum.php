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
      <h1 style="text-align: center;">Forum</h1>
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
        <label>Veuillez vous connecter si vous souhaiter créer un nouveau sujet <a href="connect.php"> se connecter</a></label>

        <?php
      }
      ?>
      
      <div class="tableforum" >
          <table style="margin-top: 10px;">
              <div class="contenuforum" >
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

      
         
          
          
        </div>
      <?php require('templates/footer.php'); ?>