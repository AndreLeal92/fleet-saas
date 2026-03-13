<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class UserController {

    private $userModel;

    public function __construct(){

        $this->userModel = new UserModel();

    }

    public function index(){

        AuthMiddleware::handle();

        $users = $this->userModel->all();

        $view = __DIR__ . '/../views/users/index.php';

        require __DIR__ . '/../views/layout.php';

    }

}
