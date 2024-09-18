<?php

namespace App\Http\Controllers;

use App\UseCases\CreatePostUseCase;
use App\Domain\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    private PostRepository $postRepository;
    private CreatePostUseCase $createPostUseCase;

    public function __construct(PostRepository $postRepository, CreatePostUseCase $createPostUseCase)
    {
        $this->postRepository = $postRepository;
        $this->createPostUseCase = $createPostUseCase;
    }

    public function index()
    {
        $posts = $this->postRepository->findAll();
        return view('posts.index', compact('posts'));

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = $this->createPostUseCase->execute($validateData['title'], $validateData['content']);

        Log::debug('debug in store of PostController', ['post->getId' => $post->getId()]);
        Log::info('Created post:', ['post' => $post, 'id' => $post->getId() ?? 'null']);

        if ($post->getId() === null) {
            // IDがnullの場合、一時的に別のページにリダイレクト
            return redirect()->route('posts.index')->with('error', 'Failed to create post with valid ID');
        }

        return redirect()->route('posts.show', ['id' => $post->getId()]);
    }

    public function show($id)
    {
        $post = $this->postRepository->findById($id);
        if (!$post) {
            abort(404);
        }
        return view('posts.show', compact('post'));
    }
}

?>
