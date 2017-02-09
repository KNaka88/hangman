<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Game.php";

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;

    session_start();
    if(empty($_SESSION['game'])){
        $_SESSION['game'] = new Game();
        $_SESSION['game']->setAnswer();
        var_dump($_SESSION['game']);
    }

    $app->get('/', function() use ($app) {

        return $app['twig']->render('game.html.twig', array('game' => $_SESSION['game']));
    });

    $app->post('/reset', function() use ($app) {
        Game::resetData();
        return $app['twig']->render('game.html.twig', array('game' => $_SESSION['game']));
    });

    $app->post('/', function() use ($app) {
        var_dump($_SESSION['game']->getCorrectAnswer());
        return $app['twig']->render('game.html.twig', array('game' => $_SESSION['game']));
    });


    return $app;
