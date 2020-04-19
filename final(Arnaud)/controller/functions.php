<?php
$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');

// Fonction permettant de calculer l'age de l'utilisateur en fonction de sa date de naissance 

function age($date){

    return intval(date('Y', time() - strtotime($date))) - 1970;

}


function assignFirstLastName($id){
  global $bdd;
  $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
  $requser->execute(array($id));
  $answer = $requser->fetch();
  echo $answer['firstName'], " ", $answer['lastName'];
}

function emailUse($email){
  $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
  $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
  $requser->execute(array($email));
  $userexist = $requser->rowCount();
  //on vérifie que l'adresse mail n'est pas déjà utilisée
  if($userexist != 0){
      echo "Cette adresse mail est déjà utilisée";
  }
  else{
      // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
      $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, allow) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?,0)");
      $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));
      // On refait une requete maintenant que l'utilisateur a été ajouté
      $requser->execute(array($_POST['email']));
      $utilisateur = $requser->fetch();
      }
}

function emailUseManager($email){
  $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
  $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
  $requser->execute(array($email));
  $userexist = $requser->rowCount();
  //on vérifie que l'adresse mail n'est pas déjà utilisée
  if($userexist != 0){
      echo "Cette adresse mail est déjà utilisée";
  }
  else{
      // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
      $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, allow) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?,1)");
      $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));
      // On refait une requete maintenant que l'utilisateur a été ajouté
      $requser->execute(array($_POST['email']));
      $utilisateur = $requser->fetch();
      }
}


//fonction permettant de savoir si un utilisateru est banni
function isBan($id){

  //require "configuration.php";

  $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
 
  $allBan = $bdd ->prepare('SELECT * FROM ban WHERE idUser = ?');
  $allBan -> execute(array($id));
   $banExist = $allBan->rowCount();

    if($banExist != 0){
      return true;
    }
    else{
      return false;
    }
}

function userExists($id){
  global $bdd;

  $user = $bdd ->prepare('SELECT * FROM user WHERE idUser = ?');
  $user -> execute(array($id));
  $userExist = $user->rowCount();

  if($userExist != 0){
    return true;
  }else{
    return false;
  }

}


//fonction permettant de savoir si la clé existe bien
function isKey($key){

  //require "configuration.php";
  
  $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
  
  $allKey = $bdd ->prepare('SELECT * FROM keyproduct WHERE keyProd = ?');
  $allKey -> execute(array($key));
   $keyExist = $allKey->rowCount();
  
    if($keyExist != 0){
      return true;
    }
  }

//fonction utiliser dans la fonction d'apres


  function isIdBan($idBan){
    $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
    $allBan = $bdd ->prepare('SELECT * FROM ban WHERE idUser = ?');
    $allBan -> execute(array($idBan));
     $banExist = $allBan->rowCount();

      if($banExist != 0){
        return true;
      }
}

  //fonction permettant de savoir si qqun est banni en fonction de son adresse email


function isEmailBan($email){
    if (session_status()!==PHP_SESSION_ACTIVE){session_start();}
    $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
    $emailBan = $bdd -> prepare('SELECT idUser FROM email = ? ');
    $emailBan -> execute(array($email));

    if(isIdBan($emailBan)==true){
        return true;
    }

    else return false;
}

function getMessages(){
	global $bdd;

	$idUser = $_SESSION['id'];
	$idDestinataire = $_SESSION['idCorresp'];



	// On cherche les derniers messages dans la bdd
	//$resultats = $bdd->prepare("SELECT DISTINCT * FROM messaging WHERE (idWritter = ? AND idReceiver = ?) OR (idReceiver = ? AND idWritter = ?) ORDER BY date DESC LIMIT 20"); 

	$resultats = $bdd->query("SELECT DISTINCT * FROM messaging WHERE (idWritter = $idUser AND idReceiver = $idDestinataire) OR (idReceiver = $idUser AND idWritter = $idDestinataire) ORDER BY date DESC LIMIT 20");

	//$resultats = $bdd->query("SELECT * FROM messaging ORDER BY date DESC LIMIT 20");
	//$resultats->query(array($idUser, $idDestinataire, $idUser, $idDestinataire));

	$messages = $resultats->fetchAll();

	// on affiche les données sous forme de JSON pour rendre les données exploitables dans le js
	echo json_encode($messages);


}


function postMessage(){
	global $bdd;

	if (!isset($_POST['destinataire']) OR !isset($_POST['content']) OR empty($_POST['destinataire']) OR empty($_POST['content'])){
		echo json_encode(["status" =>"erreur", "message" => "Un ou plusieurs champs n'ont pas ete remplis"]);
		return;
	}

	// on analyse les paramètre passés en POST (destinataire, message)
	$author = $_SESSION['id'];
	$destinataire = htmlspecialchars($_POST['destinataire']);
	$content = htmlspecialchars($_POST['content']);


	$requser = $bdd->prepare("INSERT INTO messaging(textMessage, date, idWritter, idReceiver) VALUES(?, NOW(), ?, ?)"); 
	$requser->execute(array($content, $author, $destinataire));


	echo json_encode(["statut" => "success"]);

	
}

?>