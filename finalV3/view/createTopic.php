<?php require('../controller/reqUser/req.createTopic.php') ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Forum</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>

  <?php require('templates/header.php');  ?>

  <div class="creationtopic">
    <?php
      ?>
      <div class="bodyForum">
        <h1 style="text-align: center;">Créer un sujet</h1>

        <form method="POST">
          <?php
          if (isset($er_title)){
            ?>
            <div><?= $er_title?></div>
            <?php
          }
          ?>

            <div class="titretopic">
              <input type="text" name="title" placeholder="Votre titre" value="<?php if (isset($title)){ echo $title;} ?>">
            </div><br/>

          <?php
          if (isset($er_content)){
            ?>
            <div><?= $er_content ?></div>
            <?php
          }
          ?>

          <div class="questiontopic">
            <textarea rows="4" placeholder="Décrivez votre question" name="content"><?php if(isset($content)){echo $content;} ?></textarea>
            <br/><br/><button type="submit" name="createTopic">Envoyer</button>
          </div>
          


        </form>
        
        
         
          
          
      </div>
  </div>
  <a href="forum.php" class="linkBack">Revenir au forum</a>

      <?php require('templates/footer.php');?>
 