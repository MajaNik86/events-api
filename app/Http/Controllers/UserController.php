<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){
$user->load('events', 'events.images'); 
return response()->json($user);
    }
}