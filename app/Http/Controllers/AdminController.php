<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;

class AdminController extends Controller
{
    public function get_admin_dashboard() {
        $data["users"] = User::all();

        return view('admin.profile', $data);
    }

    public function get_user_posts($userId) {
        $data["posts"] = Posts::where('author_id', $userId)->get();

        return view('admin.user_posts', $data);
    }
}
