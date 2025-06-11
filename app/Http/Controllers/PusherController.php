<?php

namespace App\Http\Controllers;

use App\Events\Chat;
use Illuminate\Http\Request;
use PHPUnit\Framework\returnArgument;

class PusherController extends Controller
{
    public function index() {
        event(new Chat('hello world'));
        return view('pusher.index');
    }
}
