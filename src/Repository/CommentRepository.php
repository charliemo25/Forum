<?php

namespace App\Repository;

use PDO;

class CommentRepository
{
    public function __construct(
        private PDO $pdo
    )
    {}
}