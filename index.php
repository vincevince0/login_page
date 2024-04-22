<?php
session_start();
include 'vendor\autoload.php';

use App\Views\Page;
use App\Controllers\UserController;
use App\Controllers\Request;
use App\Database\Install;

Page::head();
if (!Install::dbExists()) {
    Page::installBtn();
}
else {
    Page::nav();
}
Request::handle();
Page::footer();