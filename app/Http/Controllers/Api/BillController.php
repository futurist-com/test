<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bill;
use App\User;
use Illuminate\Support\Facades\Auth;


class BillController extends Controller
{
    //
    public function index ()
    {
        return  User::find(Auth::id())->bill;
    }
}
