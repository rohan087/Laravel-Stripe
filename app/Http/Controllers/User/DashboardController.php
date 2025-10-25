<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // You can pass user-specific data here if needed
        return view('user.index');
    }
}
