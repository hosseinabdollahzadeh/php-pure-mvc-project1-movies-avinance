<?php

namespace app\controllers;

use app\models\Movie;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;
use Symfony\Component\DomCrawler\Crawler;
use thecodeholic\phpmvc\Application;
use thecodeholic\phpmvc\Controller;
use thecodeholic\phpmvc\Request;

require_once __DIR__ . '/../vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class MovieController extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            return true;
        } else {
            header("Location: /login");
            exit();
        }
    }

    public function index()
    {
        $this->setLayout('admin');

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = 10; // Number of movies per page

        $offset = ($page - 1) * $perPage;

        $movies = Movie::getAll($offset, $perPage);

        $totalMovies = Movie::countAll();

        return $this->render('admin/movies/index', [
            'movies' => $movies,
            'totalMovies' => $totalMovies,
            'currentPage' => $page,
            'perPage' => $perPage
        ]);
    }

    public function create()
    {
        $this->setLayout('admin');

        return $this->render('admin/movies/create');
    }

    public function store(Request $request)
    {
        if ($request->getMethod() === 'post') {
            $movieUrl = $_POST['movieUrl'];

            $movie = new Movie();
            $movie->title_fa = $_POST['titleFaInput'];
            $movie->user_id = 1;
            $movie->movie_url = $movieUrl;
            $movie->description_fa = $_POST['descriptionFaInput'];
            if ($movie->save()) {
                Application::$app->response->redirect('/admin/movies');
                return;
            }
        }
    }


    public function edit(Request $request)
    {

        $id = $request->getRouteParams()['id'];
        $movie = Movie::findOne(['id' => $id]);

        $this->setLayout('admin');
        return $this->render('admin/movies/edit', [
            'movie' => $movie
        ]);
    }


    public function update(Request $request)
    {
        if ($request->getMethod() === 'post') {
            $id = $request->getRouteParams()['id'];
            $movie = Movie::findOne(['id' => $id]);

            if ($movie) {
                $movie->title_fa = $_POST['title_fa'];
                $movie->title_en = $_POST['title_en'];
                $movie->movie_url = $_POST['movie_url'];
                $movie->description_fa = $_POST['description_fa'];
                $movie->description_en = $_POST['description_en'];
                if ($movie->save()) {
                    Application::$app->response->redirect('/admin/movies');
                }
            }
        }
    }


    public function delete(Request $request)
    {
        if ($request->getMethod() === 'post') {
            $id = $request->getRouteParams()['id'];
            $movie = Movie::findOne(['id' => $id]);
            if ($movie && $movie->delete()) {
                Application::$app->response->redirect('/admin/movies');
            }
        }
    }


    public function infofromhtml(Request $request)
    {
        if ($request->getMethod() === 'post') {
            $movieUrl = $_POST['movieUrl'];
            $response = $this->getInfoFromHtml($movieUrl);
            echo json_encode($response);
        }
    }

    public function infofromapi(Request $request)
    {
        if ($request->getMethod() === 'post') {
            $movieUrl = $_POST['movieUrl'];
            $response = $this->getInfoFromApi($movieUrl);
            echo json_encode($response);
        }
    }

    private function getInfoFromHtml($movieUrl)
    {
        $host = 'http://localhost:4444/wd/hub'; // Selenium server address

        $capabilities = DesiredCapabilities::chrome();
        $driver = RemoteWebDriver::create($host, $capabilities);

        $driver->get($movieUrl);
        $wait = new WebDriverWait($driver, 10);
        $wait->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::className('styles__Description-sc-1d4ix3x-15'))
        );
        $pageContent = $driver->getPageSource();
        $driver->quit();

        $html = $pageContent;
        $crawler = new Crawler($html);

        // title
        $h1Tag = $crawler->filter('h1.styles__Title-sc-1d4ix3x-11.ijfgBi');
        $h1TagValue = $h1Tag->text();
        $titleFa = str_replace('null', '', $h1TagValue);

        // description
        $divTag = $crawler->filter('div.styles__Description-sc-1d4ix3x-15.itgZub');
        $divTagValue = $divTag->text();
        $descriptionFa = str_replace('null', '', $divTagValue);

        $response = array();
        $response['title_fa'] = $titleFa;
        $response['description_fa'] = $descriptionFa;

        return $response;
    }

    private function getInfoFromApi($movieUrl)
    {
        $path = parse_url($movieUrl, PHP_URL_PATH);
        $movieNumber = basename($path);
        $apiUrl = 'https://api.episode.club/v4/movie/' . $movieNumber;

        $jsonContent = file_get_contents($apiUrl);

        $data = json_decode($jsonContent, true);
        $response = array();
        if ($data) {
            $response['title_fa'] = $data['data']['title_fa'];
            $response['title_en'] = $data['data']['title_en'];
            $response['description_fa'] = $data['data']['description_fa'];
            $response['description_en'] = $data['data']['description_en'];
        } else {
            $response = "Error ...";
        }
        return $response;
    }
}