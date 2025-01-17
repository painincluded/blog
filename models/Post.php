<?php

class Post
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');  // Adjust DB details
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Get all posts
    public function getAllPosts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a post by ID
    public function getPostById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a post
    public function updatePost($id, $title, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function deletePost($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function createPost($title, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }
}
