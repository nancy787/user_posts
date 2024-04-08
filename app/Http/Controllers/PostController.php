<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::whereHas('votes', function ($query) {
            $query->where('total_votes', '<', 5);
        })->paginate(10);

        return view('posts.index', compact('posts'));
    }   

    public function destroy($id) {
       $post =  Post::find($id);
            if (auth()->user()->role === 'admin') {
                $post->delete();
                return redirect()->back()->with('success', 'Post deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Unauthorized to delete post.');
            }

    }
}
