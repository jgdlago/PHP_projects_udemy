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

    // Atualizar usuário
    if ($type === "update") {

        $userData = $userDAO->verifyToken();

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $bio = filter_input(INPUT_POST, "bio");

        $userData->name = $name;
        $userData->name = $lastname;
        $userData->name = $email;
        $userData->name = $bio;

        $userDAO->update($userData);
        
        // Alterar senha
    } else if ($type === "changepassword") {


    } else {
        $message->setMessage("Informação inválida!", "error", "index.php");
    }