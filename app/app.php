<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Tamagotchi.php';

    session_start();

    if (empty($_SESSION['tamagotchis'])) {
        $_SESSION['tamagotchis'] = array();
    };

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {

        return $app['twig']->render('root.html.twig', array('tamagotchis' => Tamagotchi::getAll()));

    });

    $app->post("/", function() use ($app) {
        if (empty($_SESSION['tamagotchis'])) {
          $usrTamagotchi = new Tamagotchi($_POST['name']);
          $usrTamagotchi->save();
        }
        return $app->redirect('/');
    });

    $app->post("/fed", function() use ($app) {
      $feedTamagotchi = $_SESSION['tamagotchis'];
      $feedTamagotchi[0]->setHunger($feedTamagotchi[0]->getHunger() + 10);
      return $app->redirect('/');
    });

    $app->post("/play", function() use ($app) {
      $playTamagotchi = $_SESSION['tamagotchis'];
      $playTamagotchi[0]->setHappiness($playTamagotchi[0]->getHappiness() + 10);
      return $app->redirect('/');
    });

    $app->post("/rest", function() use ($app) {
      $restTamagotchi = $_SESSION['tamagotchis'];
      $restTamagotchi[0]->setSleep($restTamagotchi[0]->getSleep() + 10);
      return $app->redirect('/');
    });

    $app->post("/time", function() use ($app) {
      $restTamagotchi = $_SESSION['tamagotchis'];
      $restTamagotchi[0]->setSleep($restTamagotchi[0]->getSleep() - 10);
      $restTamagotchi[0]->setHunger($restTamagotchi[0]->getHunger() - 10);
      $restTamagotchi[0]->setHappiness($restTamagotchi[0]->getHappiness() - 10);
      return $app->redirect('/');
    });

    $app->post("/new-game", function() use ($app) {
        Tamagotchi::deleteAll();
        return $app->redirect('/');
    });

    return $app;
?>
