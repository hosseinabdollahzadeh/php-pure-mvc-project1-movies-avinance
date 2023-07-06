<?php
/**
 * User: TheCodeholic
 * Date: 7/7/2020
 * Time: 9:57 AM
 */


use app\controllers\AboutController;
use app\controllers\AdminController;
use app\controllers\MovieController;
use app\controllers\SiteController;
use thecodeholic\phpmvc\Application;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->on(Application::EVENT_BEFORE_REQUEST, function(){
    // echo "Before request from second installation";
});

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/register', [SiteController::class, 'register']);
$app->router->post('/register', [SiteController::class, 'register']);
$app->router->get('/login', [SiteController::class, 'login']);
$app->router->get('/login/{id}', [SiteController::class, 'login']);
$app->router->post('/login', [SiteController::class, 'login']);
$app->router->get('/logout', [SiteController::class, 'logout']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [SiteController::class, 'about']);
$app->router->get('/profile', [SiteController::class, 'profile']);
$app->router->get('/profile/{id:\d+}/{username}', [SiteController::class, 'login']);

// admin routes
$app->router->get('/admin', [AdminController::class, 'index']);
$app->router->get('/admin/movies', [MovieController::class, 'index']);
$app->router->get('/admin/movies/create', [MovieController::class, 'create']);
$app->router->get('/admin/movies/edit/{id}', [MovieController::class, 'edit']);
$app->router->post('/admin/movies/update/{id}', [MovieController::class, 'update']);
$app->router->post('/admin/movies/delete/{id}', [MovieController::class, 'delete']);
$app->router->post('/admin/movies/info', [MovieController::class, 'infofromhtml']);
$app->router->post('/admin/movies/store', [MovieController::class, 'store']);

$app->run();
