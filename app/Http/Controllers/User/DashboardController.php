<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
   {
        if (Auth::guard('admin')->user()->type == 3) {
            return 'you are user';
        }else{
            abort(404);
        }
   }
}
