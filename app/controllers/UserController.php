<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {

        $users = $this->userModel->all();

        $view = 'users/index';

        require __DIR__ . '/../views/layout.php';
    }

    public function create() {

        $view = 'users/create';

        require __DIR__ . '/../views/layout.php';
    }

    public function edit($id) {

        $user = $this->userModel->findById($id);

        $view = 'users/edit';

        require __DIR__ . '/../views/layout.php';
    }

    public function store() {

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'user';

        $this->userModel->create($name,$email,$password,$role);

        header("Location: /users");
        exit;
    }

    public function update($id) {

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? 'user';
        $password = $_POST['password'] ?? '';

        $this->userModel->update($id,$name,$email,$role,$password);

        header("Location: /users");
        exit;
    }

    public function delete($id) {

        $this->userModel->delete($id);

        header("Location: /users");
        exit;
    }

}