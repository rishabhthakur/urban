<?php

namespace Urban\Http\Controllers;

use Urban\Post;
use Urban\User;
use Urban\Comment;
use Urban\Dsettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    private $dsettings;

    public function __construct() {
        $this->dsettings = Dsettings::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        if ($this->dsettings->discussion_full) {
            if (Auth::check()) {
                $user_id = Auth::id();
                $email = Auth::user()->email;
                $name = Auth::user()->name;
            } else {
                $user_id = false;
                $email = $request->email;
                $name = $request->name;
            }
        } else {
            if (Auth::check()) {
                $user_id = Auth::id();
                $email = Auth::user()->email;
                $name = Auth::user()->name;
            } else {
                $user_id = null;
                $email = null;
                $name = 'New user';
            }
        }

        if ($this->dsettings->discussion_approve) {
            $approve = 0;
        } else {
            $approve = 1;
        }

        if ($this->dsettings->discussion_approve_once) {
            if (Auth::user()) {
                $approve = 0;
            } else {
                $approve = 1;
            }
        }

        $comment = Comment::create([
            'post_id' => $id,
            'user_id' => $user_id,
            'email' => $email,
            'name' => $name,
            'approve' => $approve,
            'content' => $request->comment
        ]);

        if ($this->dsettings->discussion_email) {
            // Mail admin user (user with 'admin' marked 1)
            User::where('admin', 1)->first()->notify(new \Urban\Notifications\NewPostComment($comment->name));
        } elseif ($this->dsettings->discussion_email && $this->dsettings->discussion_spam_email) {
            // Mail admin user, notifying comment for approval
            User::where('admin', 1)->first()->notify(new \Urban\Notifications\NewPostCommentWaitingApproval($comment->name));
        }

        $post = Post::find($id);

        if ($approve) {
            return redirect(route('blog.post', ['slug' => $post->slug]));
        } else {
            return redirect(route('blog.post', ['slug' => $post->slug]))->with([
                'success' => 'Your comment will be applied as soon as it is approved.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
