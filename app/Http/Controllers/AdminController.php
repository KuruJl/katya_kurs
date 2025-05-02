<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
{
    if (Auth::check() && Auth::user()->is_admin) {
        abort(403, 'Доступ запрещён');
    }
    
    return view('admin.dashboard');
}
}
