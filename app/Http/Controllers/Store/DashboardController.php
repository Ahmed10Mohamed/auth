<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
         if (Auth::guard('admin')->user()->type == 1) {
            return 'you are store';
        }else{
            abort(404);
        }
    }
}
