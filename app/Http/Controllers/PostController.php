<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{

  public function index()
  {
    //fetch 5 posts from database which are active and latest
    $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(10);
    //page heading
    $title = 'Latest Posts';
    //return home.blade.php template from resources/views folder
    return view('home')->withPosts($posts)->withTitle($title);
  }

  public function create(Request $request)
  {
    //
    if ($request->user()->can_post()) {
      return view('posts.create');
    } else {
      return redirect('/')->withErrors('You have not sufficient permissions for writing post');
    }
  }

  public function store(PostFormRequest $request)
  {
    $post = new Posts();
    $post->title = $request->get('title');
    $post->body = $request->get('body');
    $post->slug = Str::slug($post->title);

    $duplicate = Posts::where('slug', $post->slug)->first();
    if ($duplicate) {
      return redirect('new-post')->withErrors('Title already exists.')->withInput();
    }

    $post->author_id = $request->user()->id;
    if ($request->has('save')) {
      $post->active = 0;
      $message = 'Post saved as draft';
    } else {
      $post->active = 1;
      $message = 'Post published successfully';
    }
    $post->save();
    return redirect('edit/' . $post->slug)->with('success',  $message);
  }

  public function show($slug)
  {
    $post = Posts::where('slug',$slug)->first();
    if(!$post)
    {
       return redirect('/')->withErrors('requested page not found');
    }
    return view('posts.show')->withPost($post);
  }

  public function edit(Request $request,$slug)
  {
    $post = Posts::where('slug',$slug)->first();
    if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
      return view('posts.edit')->with('post',$post);
    return redirect('/')->withErrors('you have not sufficient permissions');
  }

  public function update(Request $request)
  {
    $post_id = $request->input('post_id');
    $post = Posts::find($post_id);
    if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
      $title = $request->input('title');
      $slug = Str::slug($title);
      $duplicate = Posts::where('slug', $slug)->first();
      if ($duplicate) {
        if ($duplicate->id != $post_id) {
          return redirect('edit/' . $post->slug)->withErrors('Title already exists.')->withInput();
        } else {
          $post->slug = $slug;
        }
      }

      $post->title = $title;
      $post->body = $request->input('body');

      if ($request->has('save')) {
        $post->active = 0;
        $message = 'Post saved as draft';
        $landing = 'edit/' . $post->slug;
      } else {
        $post->active = 1;
        $message = 'Post updated and published successfully';
        $landing = 'post/' . $post->slug;
      }
      $post->save();
      return redirect($landing)->with('success',  $message) ;
    } else {
      return redirect('/')->withErrors('you have not sufficient permissions');
    }
  }

  public function destroy(Request $request, $id)
  {
    $post = Posts::find($id);
    if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
      $post->delete();
      $data['success'] = 'Post deleted Successfully';
    }
    else {
      $data['errors'] = 'Invalid Operation. You have dont have sufficient permissions';
    }
    return redirect('/')->with($data);
  }
}
