<?php

namespace App\Http\Controllers;

use App\Http\Requests\WelcomeRequest;
use App\Managers\TemplatesManager;
use App\Models\Template;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(WelcomeRequest $request , TemplatesManager $templates_manager)
    {
//        $templates = Template::all();
        return view('welcome', compact('templates'));
    }
}
