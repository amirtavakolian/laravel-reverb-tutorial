<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\Example;

class TestController extends Controller
{
    public function test()
    {
        broadcast(new Example('Hello, World!', User::find(1)));
    }
}
