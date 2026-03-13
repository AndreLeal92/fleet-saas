<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index(){

        AuthMiddleware::handle();

        $users = $this->userModel->all();

        require __DIR__ . '/../../app/views/users/index.php';

    }

    public function create(){

        require __DIR__ . '/../../app/views/users/create.php';

    }

    public function store(){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $this->userModel->create($name,$email,$password,$role);

        header("Location: /users?success=1");
        exit;

    }

    public function delete(){

        $id = $_GET['id'];

        $this->userModel->delete($id);

        header("Location: /users?deleted=1");
        exit;

    }

}
