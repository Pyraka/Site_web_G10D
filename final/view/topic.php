<?php require('../controller/req.topic.php'); ?>

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
      <h1 style="text-align: center;">Sujet : <?= $reponse['title'] ?></h1>
      <div style="background:linear-gradient(cornflowerblue,white); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); padding: 15px 5px; border-radius: 20px">
      	<h3><strong>Contenu</strong></h3>
      	<div style="border-top: 2px solid #eee; padding-top: 10px;"><?= $reponse['content'] ?></div>
      	<div style="color: grey; font-size: 10px; text-align: right;">
      		<?= $reponse['date_c'] ?>
      		par
      		<?= assignFirstLastName($reponse['idUser']); ?>
      	</div>
      	
      </div>

      <?php
      if (isset($_SESSION['id'])){
      	?>
	      <div style=" background:linear-gradient(cornflowerblue,white);box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); padding: 15px 5px; border-radius: 20px; margin-top: 10px;">
	      	<h3>Participer à la discussion</h3>
	      	
	      	<?php
	        if (isset($er_comment)){
	          ?>
	          <div><?= $er_comment?></div>
	          <?php
	        }
	        ?>

	      	<form method="POST">
		      	<div class="participerdiscussion">
		      		<textarea rows="4" name="text"></textarea>
		      	</div><br/>
		      	<div class="boutonparticiper">
		      		<button type="submit" name="createMessage">Envoyer</button>
		      	</div>
		    </form>
	       </div>
       <?php 
   		}else{
   			?>
        <label>Veuillez vous connecter si vous souhaiter participer à la discussion <a href="connect.php"> se connecter</a></label>

        <?php
      }
      ?>


      <div style="background: linear-gradient(cornflowerblue,white); box-shadow: 0 5px 15px rgba(35, 0, 15, 0.15); padding: 15px 5px; border-radius: 20px; margin-top: 10px;">
      	<h3><strong>Commentaires :</strong></h3>
	      <table style="size: 15px">
	        <?php
	        foreach ($reponse2 as $key) {
	          ?>
	          <tr>
	            <td>
	              <?= $key['date_c'] ?>
	            </td>
	            <td>
	              <?= "==>", assignFirstLastName($key['idUser']); ?>
	            </td>
	            <td style="font-family: 'Sitka Small'  ">
	              <?=": ", $key['text'] ?>
	            </td>
	          </tr>
	        <?php } ?>
	      </table>
	   </div>
	   <p> Retour au forum <a href="forum.php"> <strong>ici</strong></a></p>
          

   </div>
   <?php require('templates/footer.php'); ?>


