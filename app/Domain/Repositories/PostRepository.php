<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Post;

interface PostRepository
{

    public function findById(int $id): ?Post;
    public function findAll(): array;
    public function save(Post $post): void;
    public function update(Post $post): void;
    public function delete(int $id): void;
}

?>
