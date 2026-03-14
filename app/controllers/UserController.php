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

    public function create(){

        AuthMiddleware::handle();

        $view = __DIR__ . '/../views/users/create.php';

        require __DIR__ . '/../views/layout.php';

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
