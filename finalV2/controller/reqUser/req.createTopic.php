<?php require('../model/configuration.php');

if (!isset($_SESSION['id'])){
  header('Location: forum.php');
  exit;
}

if (!empty($_POST)){
  $valid = true;


  if (isset($_POST['createTopic'])){
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));

    if(empty($title)){
      $valid = false;
      $er_title = "Veuillez mettre un titre";
    }

    if(empty($content)){
      $valid = false;
      $er_content = 'Veuillez mettre un contenu';
    }
  }

  if($valid){

    $requser = $bdd->prepare("INSERT INTO forum_topic(title, content, date, idUser, isClosed) VALUES(?, ?, NOW(), ?, ?)");
    $requser->execute(array($title, $content, $_SESSION['id'], 0));
    header('Location: forum.php');
  }
}
?>
