<?php

namespace App\Controller;

use PDO;
use App\PDO\Connexion;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\RoleRepository;

class PostController {

    private PDO $pdo;
    private PostRepository $postRepository;
    private RoleRepository $roleRepository;
    private UserRepository $userRepository;
    private CategoryRepository $categoryRepository;
    private CommentRepository $commentRepository;

    public function __construct()
    {
        $this->pdo = (new Connexion())->getPdo();
        $this->roleRepository = new RoleRepository($this->pdo);
        $this->userRepository = new UserRepository($this->pdo, $this->roleRepository);
        $this->categoryRepository = new CategoryRepository($this->pdo);
        $this->postRepository = new PostRepository($this->pdo, $this->userRepository, $this->categoryRepository);
        $this->commentRepository = new CommentRepository($this->pdo, $this->postRepository, $this->userRepository);
    }

    public function index(){
        // Récuperer la liste des posts
        $posts = $this->postRepository->findAll();
        require_once './src/Template/Post/home.php';
    }
    
    public function details($id){
        $post = $this->postRepository->find($id);
        $comments = $this->commentRepository->findPostComments($post->getId());
        require_once './src/Template/Post/details.php';
    }
}