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
        $data['title'] = $data['user']->getFullNameAttribute() . ' Blog Posts';
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
        $user = Auth::user();

        if ($user->id == $id || $user->is_admin() == true) {
            $data['user'] = User::find($id);

            return view('users.profile', $data);
        } else {
            return redirect('/');
        }
    }

    public function updateProfile(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $update = $this->create($request->all());


        return $update ? redirect()->back()->with('success',  'Updated information successfully!') : Redirect::back()->withErrors('Failed to update');
    }

    protected function validator($data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'alpha', 'max:255'],
            'last_name' => ['required', 'alpha', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        if(Auth::user()->is_admin()) {
            $updateWhere = ['id' => $data['user_id']];
        } else {
            $updateWhere =  ['email' => auth()->user()->email];
        }

        return User::updateOrCreate(
            $updateWhere,
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'user_name' => $data['user_name']
                ]
        );
    }

    public function admin(Request $request)
    {
        return view('admin.profile', ['user' => $request->admin]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
