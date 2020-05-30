<?php require('../controller/reqAdmin/req.faqAdd.php');

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