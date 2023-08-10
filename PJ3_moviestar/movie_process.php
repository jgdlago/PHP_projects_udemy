<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");
    require_once("models/Movie.php");
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);

    $type = filter_input(INPUT_POST, "type");

    $userData = $userDao->verifyToken();

    if ($type === "create") {

        $title = filter_input(INPUT_POST, "title");
        $description = filter_input(INPUT_POST, "description");
        $trailer = filter_input(INPUT_POST, "trailer");
        $category = filter_input(INPUT_POST, "category");
        $length = filter_input(INPUT_POST, "length");

        $movie = new Movie();

        if (!empty($title) && !empty($description) && !empty($category)) {

            $movie->title = $title;
            $movie->description = $description;
            $movie->trailer = $trailer;
            $movie->category = $category;
            $movie->length = $length;

            // imagem
            if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
                
                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];

                if (in_array($image["type"], $imageTypes)) {

                    if (in_array($image, $jpgArray)) {
                        $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                    } else {
                        $imageFile = imagecreatefrompng($image["tmp_name"]);
                    }
    
                    $imageName = $user->imageGenerateName();
    
                    imagejpeg($imageFile, "./img/users/" . $imageName, 100);
    
                    $userData->image = $imageName;
    
                } else {
                    $message->setMessage("Tipo inválido de imagem!", "error", "back");
                }
            }

            $movieDao->create($movie);
            
        } else {
            $message->setMessage("Preencha as informações!", "error", "back");
        }

    } else {
        $message->setMessage("Informação inválida!", "error", "index.php");
    }