<?php
namespace App\UseCases;

use App\Domain\Entities\Post;
use App\Domain\Repositories\PostRepository;
use Illuminate\Support\Facades\Log;


class CreatePostUseCase
{

    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(string $title, string $content): Post
    {
        $post = new Post(null, $title, $content);
        Log::info('Post created in UseCase', ['post' => $post->getTitle()]);
        $this->postRepository->save($post);
        return $post;
    }
}




?>
