<?php

require_once("models/Movie.php");
require_once("models/Message.php");

class movieDAO implements MovieDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildMovie($data) {
        $movie = new Movie();

        $movie->id = $data['id'];
        $movie->title = $data['name'];
        $movie->description = $data['lastname'];
        $movie->image = $data['email'];
        $movie->trailer = $data['password'];
        $movie->category = $data['image'];
        $movie->length = $data['bio'];
        $movie->users_id = $data['token'];
        
        return $movie;
    }
    public function findAll() {

    }
    public function getLatestMovies() {

    }
    public function getMoviesByCategory($category) {

    }
    public function getMoviesByUserId($id) {

    }
    public function findById($id) { 

    }
    public function findByTitle($title) {

    }
    public function create(Movie $movie) {

    }
    public function update(Movie $movie) {

    }
    public function destroy($id) {

    }
}