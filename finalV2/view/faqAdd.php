<?php
include('../model/configuration.php');

if (!empty($_POST)){
  $valid = true;


  if (isset($_POST['createQuestion'])){
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

    $requser = $bdd->prepare("INSERT INTO faq(textQuestion, textAnswer, isDeleted) VALUES(?, ?, 0)");
    $requser->execute(array($question, $answer));
    header('Location: faqAdmin.php');

  }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>FAQ- Admin - InfiniteMeasures</title>
        <link rel="stylesheet" href="foot/style.css">
    </head>
    <?php require('templates/header.php'); ?>
    <h2 class="titleFaq">Ajouter question</h2>
    <div class="underline"></div>
<div class="faqbody">
    <form method="post">

        <p> <strong>AJOUTER UNE QUESTION</strong><br/><br>
            <?php
            if (isset($er_question)){
                ?>
                <div><?= $er_question ?></div>
                <?php
            }
            ?>
            <label for="textQuestion"></label><br> <textarea placeholder="Insérez une question..."name="textQuestion" id="textQuestion" rows="5" cols="70"><?php if (isset($question)){echo $question;} ?></textarea><br><br />
            <?php
            if (isset($er_answer)){
                ?>
                <div><?= $er_answer ?></div>
                <?php
            }
            ?>
            <label for="textAnswer"></label><br> <textarea  placeholder="Insérez une réponse..." name="textAnswer" id="textAnswer" rows="5" cols="70"><?php if (isset($answer)){echo $answer;} ?></textarea><br><br />
            <input type="submit" name="createQuestion" value="Ajouter" />
        </p>
    </form>


    <p><a class="box-nous" href="faqAdmin.php">Retour aux faq</a> </p>
    </div>
    </body>
</html>
