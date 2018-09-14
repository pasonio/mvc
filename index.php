<?php

define('ROOTPATH', __DIR__);

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/App/App.php';

session_start();

App::init();
App::$kernel->launch();