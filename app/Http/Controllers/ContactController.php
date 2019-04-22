<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractSend;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(ContractSend $request)
    {
        return response()->json([
            'code' => 'success',
            'msg' => 'Thank you for subscribing'
        ]);
    }
}
