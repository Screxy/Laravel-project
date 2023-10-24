<?php

namespace App\Http\Controllers;

use App\Jobs\MailJob;
use App\Mail\AdminComment;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Models\Article;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('comments.index', ['comments' => $comments]);
    }
    public function accept(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->accept = true;
        $comment->save();
        return redirect('/comment');
    }
    public function reject(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->accept = false;
        $comment->save();
        return redirect('/comment');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'article_id' => 'required'
        ]);
        $article = Article::findOrFail($request->article_id);
        $comment = new Comment;
        $comment->title = $request->title;
        $comment->text = $request->text;
        $comment->article_id = $request->article_id;
        $comment->user()->associate(auth()->user());
        $res = $comment->save();
        if ($res)
            // MailJob::dispatch($comment->text, $article->name);
            Mail::to('vladisdvb@gmail.com')->send(new AdminComment($comment->text, $article->name));
        return redirect()->route('article.show', ['article' => $comment->article_id, 'res' => $res]);
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        return view('comments.edit', ['comment' => $comment]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);
        $comment = Comment::findOrFail($id);
        $comment->title = $request->title;
        $comment->text = $request->text;
        $comment->article_id = $comment->article_id;
        $comment->save();
        return redirect()->route('article.show', ['article' => $comment->article_id]);
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        $comment->delete();
        return redirect()->route('article.show', ['article' => $comment->article_id]);
    }
}