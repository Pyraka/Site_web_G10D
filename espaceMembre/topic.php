<?php include('configuration.php');

/*
if (!isset($_GET['id']) OR $_GET['id'] < 1){
	header("Location: forum.php");
	exit;
}*/

$requser = $bdd->prepare('SELECT *, DATE_FORMAT(date, "Le %d/%m/%Y à %H\h%i") as date_c FROM forum_topic WHERE idTopic = ? ORDER BY date DESC'); // on pourrait rajouter une LIMIT 10 
$requser->execute(array($_GET['id']));
$reponse = $requser->fetch();

$reqcom = $bdd->prepare('SELECT *, DATE_FORMAT(date, "Le %d/%m/%Y à %H\h%i") as date_c FROM forum_comments WHERE idTopic = ? ORDER BY date DESC');
$reqcom->execute(array($_GET['id']));
$reponse2 = $reqcom->fetchAll();

if (!empty($_POST)){
	$valid = true;

	if (isset($_POST['createMessage'])){

		$text = htmlspecialchars(trim($_POST['text']));

		if(empty($text)){
			$valid = false;
			$er_comment = "Veuillez entrer un message";
		}


		if($valid){
			$requser = $bdd->prepare("INSERT INTO forum_comments(idTopic, idUser, date, text) VALUES(?, ?, NOW(), ?)");
    		$requser->execute(array($_GET['id'], $_SESSION['id'], $text));
			header('Location: topic.php?id='.$_GET["id"]);
		}
	}
}


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
          


  </body>
</html>


