<?php include('configuration.php');

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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Forum</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>
  <div class="creationtopic">
    <?php
      require('templates/header.php');    
      ?>
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
      
      
         
          
          
        
      <?php include('templates/footer.php');?>
  </div>
  </body>
</html>