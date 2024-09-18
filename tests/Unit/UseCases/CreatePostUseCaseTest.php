<?php

namespace Tests\Unit\UseCases;

use App\Domain\Entities\Post;
use App\Domain\Repositories\PostRepository;
use App\UseCases\CreatePostUseCase;
use PHPUnit\Framework\TestCase;
use Mockery;

class CreatePostUseCaseTest extends TestCase
{
    public function testCreatePost()
    {
        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->expects($this->once())->method('save');

        $useCase = new CreatePostUseCase($postRepository);


        $post = $useCase->execute('Test Title', 'Test Content');

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals('Test Title', $post->getTitle());
        $this->assertEquals('Test Content', $post->getContent());
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

}


?>
