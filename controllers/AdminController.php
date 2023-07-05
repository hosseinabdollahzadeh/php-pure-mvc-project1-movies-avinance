<?php

namespace app\controllers;

use thecodeholic\phpmvc\Controller;

class AdminController extends Controller
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
        return $this->render('admin/dashboard');
    }
}