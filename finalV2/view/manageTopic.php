<?php require('../controller/reqAdmin/req.manageTopic.php'); ?>

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
      <h1 style="text-align: center;">
      	Sujet : 
      	
      	<form method="post">
      		<div style="display: flex; flex-direction: row; justify-content: center; align-content: space-around;">
      			<input type="text" name="title" value="<?= $reponse['title'] ?>" style="height: 20px;">
	      		<div class="boutonparticiper">
		      		<button type="submit" name="modifyTitle" style="padding: 5px 15px; margin: 0; height: 30px; width: 200px;">Modifier le titre</button>
		      	</div>
      		</div>
      		
      	</form>
      	
      		
      </h1>
      <?php
        if (isset($er_title)){
          ?>
          <div><?= $er_title?></div>			  <br>

		  <?php
        }
        ?>
      <div style="background:linear-gradient(cornflowerblue,white); box-shadow: 0 5px 15px rgba(0, 0, 0); padding: 15px 5px; border-radius: 20px">
      	<h3><strong>Contenu</strong></h3>

      	<div style="border-top: 2px solid #eee; padding-top: 10px;">
      		<?php
	        if (isset($er_content)){
	          ?>
	          <div ><?= $er_content?></div>			  <br>

			  <?php
	        }
	        ?>
      		
      		<form method="post">
	      		<div style="display: flex; flex-direction: row; justify-content: center; align-content: space-around;">
	      			<input type="text" name="content" value="<?= $reponse['content'] ?>" style="height: 20px;">
		      		<div class="boutonparticiper">
			      		<button type="submit" name="modifyContent" style="padding: 5px 15px; margin: 0; height: 30px; width: 200px;">Modifier le contenu</button>
			      	</div>
	      		</div>
      		
      		</form>
      			
      	</div>

      	<div style="color: grey; font-size: 10px; text-align: right;">
      		<?= $reponse['date_c'] ?>
      		par
      		<?= assignFirstLastName($reponse['idUser']); ?>
      	</div>
      	
      </div>

      <?php
      if (isset($_SESSION['id'])){
      	?>
	      <div style=" background:linear-gradient(cornflowerblue,white);box-shadow: 0 5px 15px rgba(0, 0, 0); padding: 15px 5px; border-radius: 20px; margin-top: 10px;">
	      	<h3>Participer à la discussion</h3>
	      	
	      	<?php
	        if (isset($er_comment)){
	          ?>
	          <div ><?= $er_comment?></div>			  <br>

			  <?php
	        }
	        ?>

	      	<form method="POST">
		      	<div class="participerdiscussion">
		      		<textarea rows="4" name="text"></textarea>
		      	</div><br/>
		      	<div class="boutonparticiper">
		      		<button id="buttonGo" type="submit" name="createMessage">Envoyer</button>
		      	</div>
		    </form>
	       </div>
       <?php 
   		}else{
			   ?>
			   <br>
        <label>Veuillez vous connecter si vous souhaiter participer à la discussion <a class="linkProfil" href="connect.php">se connecter</a></label>
		<br>

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
	            <td>
	            	<div class="boutonparticiper">
	            		<a href="deleteComment.php?id=<?= $key['idComment'] ?>" style="padding: 5px 15px;">Supprimer le commentaire</a>
	            	</div>
	            </td>
	          </tr>
	        <?php } ?>
	      </table>
	   </div>
	   <p> Retour au forum <a class="box-nous" href="manageForum.php"> <strong>ici</strong></a></p>
          

   </div>
   <?php //require('templates/footer.php'); ?>


