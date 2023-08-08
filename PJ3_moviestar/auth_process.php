<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    $userDAO = new UserDAO($conn, $BASE_URL);

    //Verifica tipo do form
    $type = filter_input(INPUT_POST, "type");

    if ($type === "register") {

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword");

        if($name && $lastname && $email && $password) {
            
            if ($password === $confirmPassword) {

                if($userDAO->findByEmail($email) === false) {
                    
                    $user = new User();

                    // Criar token e senha
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDAO->create($user, $auth);

                } else {
                    $message->setMessage("Email já cadastrado", "error", "back");
                }

            } else {
                $message->setMessage("As senhas devem ser iguais", "error", "back");
            }

        } else {
            $message->setMessage("Preencha todos os campos", "error", "back");
        }
        
    } else if ($type === "login") {
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        if ($userDAO->authenticateUser($email, $password)) {

            $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

        } else {
            $message->setMessage("Usuário e/ou senha incorretos", "error", "back");
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }