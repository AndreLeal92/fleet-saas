<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {

        $users = $this->userModel->all();

        require __DIR__ . '/../views/users/index.php';
    }

    public function create() {

        require __DIR__ . '/../views/users/create.php';

    }

    public function store() {

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'user';

        $this->userModel->create($name,$email,$password,$role);

        header("Location: /users?created=1");
        exit;

    }

    public function edit($id) {

        $user = $this->userModel->findById($id);

        require __DIR__ . '/../views/users/edit.php';

    }

    public function update($id) {

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? 'user';
        $password = $_POST['password'] ?? '';

        $this->userModel->update($id,$name,$email,$role,$password);

        header("Location: /users?updated=1");
        exit;

    }

    public function delete($id) {

        $this->userModel->delete($id);

        header("Location: /users?deleted=1");
        exit;

    }

}