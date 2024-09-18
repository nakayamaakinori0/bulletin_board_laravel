<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Post;
use App\Domain\Repositories\PostRepository;
use App\Models\Post as EloquentPost;


class EloquentPostRepository implements PostRepository
{

    public function findById(int $id): ?Post
    {
        $eloquentPost = EloquentPost::find($id);
        return $eloquentPost ? $this->toEntity($eloquentPost) : null;

    }

    public function findAll(): array
    {
        return EloquentPost::all()->map(function ($eloquentPost) {
            return $this->toEntity($eloquentPost);
        })->toArray();
    }

    public function save(Post $post): void
    {
        $eloquentPost = new EloquentPost();
        $eloquentPost->title = $post->getTitle();
        $eloquentPost->content = $post->getContent();
        $eloquentPost->save();

        $post->assignId($eloquentPost->id);
    }

    public function update(Post $post): void
    {
        $eloquentPost = EloquentPost::find($post->getId());
        if ($eloquentPost) {
            $eloquentPost->title = $post->getTitle();
            $eloquentPost->content = $post->getContent();
            $eloquentPost->save();
        }
    }

    public function delete(int $id): void
    {
        EloquentPost::destroy($id);
    }

    private function toEntity(EloquentPost $eloquentPost): Post
    {
        return new Post(
            $eloquentPost->id,
            $eloquentPost->title,
            $eloquentPost->content,
            new \DateTimeImmutable($eloquentPost->created_at)
        );
    }

}


?>
