<?php
require_once 'models/Post.php';

class PostController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    // Display all posts
    public function index()
    {
        // Fetch all posts from the model
        $posts = $this->postModel->getAllPosts();

        // Load the view and pass the posts
        require_once 'views/posts/index.php';
    }

    // Show the edit form and update the post
    public function edit($id = null)
    {
        if ($id) {
            $post = $this->postModel->getPostById($id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'];
                $content = $_POST['content'];

                // Update the post using the model
                $this->postModel->updatePost($id, $title, $content);

                // Redirect to the index page (or show success)
                header("Location: /blog");
                exit;
            } else {
                // Load the edit form with the current post data
                require_once 'views/posts/edit.php';
            }
        } else {
            echo "Post ID is required for editing.";
        }
    }

    // Delete a post (you can implement this method similarly)
    public function delete($id = null)
    {
        if ($id) {
            // Call the model's deletePost method to delete the post
            $deleted = $this->postModel->deletePost($id);

            if ($deleted) {
                echo "Post deleted successfully!";
                header("Location: /blog");  // Redirect to the index page after deletion
                exit;
            } else {
                echo "Error deleting post.";
            }
        } else {
            echo "Post ID is required for deletion.";
        }
    }
    public function create()
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data
            $title = $_POST['title'];
            $content = $_POST['content'];

            // Validate the inputs (you can add more validation if needed)
            if (!empty($title) && !empty($content)) {
                // Create the new post using the model
                $this->postModel->createPost($title, $content);
                echo "Post created successfully!";
                header("Location: /blog");  // Redirect to the index page after creation
                exit;
            } else {
                echo "Title and content are required!";
            }
        }

        // Display the create post form using the create view
        include 'views/posts/create.php';
    }
    public function view($id = null)
    {
        if ($id) {
            // Fetch the post using the model
            $post = $this->postModel->getPostById($id);

            if ($post) {
                // Display the post's details
                echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
                echo '<p>' . nl2br(htmlspecialchars($post['content'])) . '</p>';
            } else {
                echo "Post not found.";
            }
        } else {
            echo "Post ID is required for viewing.";
        }
    }
}
