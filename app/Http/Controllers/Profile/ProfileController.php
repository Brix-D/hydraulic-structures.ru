<?php

namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {


    public function index(): View
    {

        $name = Auth::user()->name;
        $data = [
            'name' => $name,
        ];

        return view('pages.profile.index', $data);
    }
}