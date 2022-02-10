<?php

namespace App\Entity;

class Comment {
    
    public function __construct(
        private ?int $id,
        private string $title,
        private string $message,
        private User $user,
        private Post $post
    )
    {}


}