<?php

require_once __DIR__ . "/../../vendor/autoload.php";

$app = new Silex\Application();
$app->register(new Silex\Provider\SessionServiceProvider());

$app['debug'] = true;

$app->get('/', function () {
    return "Hello World";
});

$app->get('/session', function (Silex\Application $app) {
    if ($app['session']->has('foo')) {
        $data = $app['session']->get('foo');
        $app['session']->remove('foo');
        return "From session: {$data}";
    } else {
        $app['session']->set('foo', "Aloha!");
        return "Set session!";
    }
});

return $app;
