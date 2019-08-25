<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Canducci\ZipCode\Facades\ZipCode;

class CEPController extends Controller
{
    protected function query_cep(Request $request) {
        if (isset($request->cep)){
            $zipCodeInfo = ZipCode::find($request->cep)->getJson();

            return $zipCodeInfo;
        }
    }
}
