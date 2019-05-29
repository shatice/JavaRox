<?php
  require_once __DIR__.'/vendor/autoload.php';

  if ($_POST["log"] != null and $_POST["mdp"] != null){

    
    $log = $_POST['log'];
    $mdp = $_POST['mdp'];
    $bdd = new Entity\Bdd();
    $user = $bdd->getUser($log);
    $correctPassword = password_verify($mdp, $user->password());
    if ($correctPassword ) {

      session_start();
      $_SESSION['user'] = $user ;

      header('Location: accueil.php');
      exit();
    } else {
      header('Location: index.php');
      exit();
    }
} else {
  header('Location: index.php');
  exit();
}
