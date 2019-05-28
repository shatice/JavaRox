<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();
//verifier lenvoie du formulaire
if (!isset($_POST['login_post'])) {
  echo 'formulaire non envoyé !';
} else {
  if (empty($_POST['title']) && empty($_POST['title_post'] && empty($_POST['content_post']))) {
    echo 'lourd!';
  } elseif (strlen($_POST['title_post']) > 100) {
    echo 'titre du post trop long';
  } elseif (strlen($_POST['title']) > 100) {
    echo 'titre du topic trop long';
  } else {
    $newTopic = new Entity\Topics('', $_POST['title'], 0, $_SESSION['user']->id());
    var_dump($newTopic);
    $newTopic->saveBdd();
    $date = date("d-m-Y");
    $lastId = Entity\Bdd::getLastIdTopics();
    $newPost = new Entity\Post('', $_POST['title_post'], $_POST['content_post'], $date, $_SESSION['user']->id(), $lastId[0]);
    $newPost->saveBdd();

    $message = 'Topics bien poster';
    header('Location: accueil.php?message=' . $message);
    exit();
  }
}
?>