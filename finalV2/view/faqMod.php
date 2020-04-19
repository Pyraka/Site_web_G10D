<?php
include('../model/configuration.php');

if (!isset($_GET['id']) OR $_GET['id'] < 1){
  header('Location: faqAdmin.php');
}

if (!empty($_POST)){
  $valid = true;


  if (isset($_POST['modifyQuestion'])){
    $question = htmlspecialchars(trim($_POST['textQuestion']));
    $answer = htmlspecialchars(trim($_POST['textAnswer']));

    if(empty($question)){
      $valid = false;
      $er_question = "Veuillez mettre une question";
    }

    if(empty($answer)){
      $valid = false;
      $er_answer = 'Veuillez mettre une réponse';
    }
  }

  if($valid){

    $requser = $bdd->prepare("UPDATE faq SET textQuestion = ?, textAnswer= ? WHERE idQuestion= ?");
    $requser->execute(array($question, $answer, $_GET['id']));
    header('Location: faqAdmin.php');

  }

}


$requser = $bdd->prepare("SELECT * from faq WHERE idQuestion = ?");
$requser->execute(array($_GET['id']));
$reponse = $requser->fetch();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>FAQ- Admin - InfiniteMeasures</title>
        <link rel="stylesheet" href="foot/style.css">
    </head>
    <?php require('templates/header.php'); ?>
    <h2 class="titleFaq">Modifier question</h2>
    <form method="post">

        <p> <strong>MODIFIER UNE QUESTION</strong><br/><br>
            <?php
            if (isset($er_question)){
                ?>
                <div><?= $er_question ?></div>
                <?php
            }
            ?>
            <label for="textQuestion"></label><br> <textarea placeholder="Insérez une question..."name="textQuestion" id="textQuestion" rows="5" cols="70"><?php if (isset($question)){echo $question;}else{echo $reponse['textQuestion'];} ?></textarea><br><br />
            <?php
            if (isset($er_answer)){
                ?>
                <div><?= $er_answer ?></div>
                <?php
            }
            ?>
            <label for="textAnswer"></label><br> <textarea  placeholder="Insérez une réponse..." name="textAnswer" id="textAnswer" rows="5" cols="70"><?php if (isset($answer)){echo $answer;}else{echo $reponse['textAnswer'];} ?></textarea><br><br />
            <input type="submit" name="modifyQuestion" value="Modifier" />
        </p>
    </form>


    <p><a href="faqAdmin.php">Retour aux faq</a> </p>
    </body>
</html>
