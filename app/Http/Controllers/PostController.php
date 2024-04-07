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
    // Check if the authenticated user is authorized to delete the post
    if (auth()->user()->role === 'admin') {
        // Delete the post
        $post->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Post deleted successfully.');
    } else {
        // If user is not authorized, show error message
        return redirect()->back()->with('error', 'Unauthorized to delete post.');
    }

    }
}
