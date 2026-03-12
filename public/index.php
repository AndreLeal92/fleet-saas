<?php

require "../core/Router.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

Router::route($uri);