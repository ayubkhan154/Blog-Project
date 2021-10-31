<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /*
     * Display active posts of a particular user
     *
     * @param int $id
     * @return view
     */
    public function user_posts($id)
    {
        $data['user'] = User::find($id);
        $data['title'] = 'My Posts';
        $data['posts'] = Posts::where('author_id', $id)->where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
        $data['posts_count'] = $data['user']->posts->count();
        $data['posts_active_count'] = $data['user']->posts->where('active', '1')->count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];

        return view('posts', $data);
    }

    /*
     * Display all of the posts of a particular user
     *
     * @param Request $request
     * @return view
     */
    public function user_posts_all(Request $request)
    {
        $user = $request->user();
        $posts = Posts::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $title = $user->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }

    /*
     * Display draft posts of a currently active user
     *
     * @param Request $request
     * @return view
     */
    public function user_posts_draft(Request $request)
    {
        //
        $user = $request->user();
        $posts = Posts::where('author_id', $user->id)->where('active', 0)->orderBy('created_at', 'desc')->paginate(5);
        $title = $user->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
     * profile for user
     */
    public function profile(Request $request, $id)
    {
        $data['user'] = User::find($id);

        return view('users.profile', $data);
    }

    public function updateProfile(Request $request)
    {

        dd($request);
        $validate = $this->create($request->all());

        $validator = $this->validator($validate->validate());

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
    }

    protected function validator($data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'old_password' => ['required|null', 'string', 'min:8'],
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password'

        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function admin(Request $request) {
        return view('admin.profile', ['user' => $request->admin]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
