<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
   {
        if (Auth::guard('admin')->user()->type == 2) {
            return 'you are admin';
        }else{
            abort(404);
        }
   }
}
