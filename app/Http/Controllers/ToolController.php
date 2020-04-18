<?php

namespace App\Http\Controllers;

use App\Http\Requests\WelcomeRequest;
use App\Managers\TemplatesManager;
use App\Models\Template;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function teams()
    {
        return view('tools.teams');
    }

    public function locations()
    {
        return view('tools.locations');
    }

    public function privacy()
    {
        return view('tools.privacy');
    }

    public function terms()
    {
        return view('tools.terms');
    }

}
