<?php

namespace App\Http\Controllers\User;

use App\Http\Collections\UsersProfilesCollection;
use App\Http\Controllers\Controller;


class UsersProfilesController extends Controller
{
    public function index(Request $request)
    {
        return UsersProfilesCollection::collection($request);
    }
}
