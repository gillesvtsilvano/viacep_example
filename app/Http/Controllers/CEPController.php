<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Canducci\ZipCode\Facades\ZipCode;

class CEPController extends Controller
{
    protected function query_cep(Request $request) {

        $msg = array(
            "code" => 0,
            "message" => 'Ok.',
            "response" => '',
        );
        $zipCodeInfo = null;

        if (isset($request['cep'])){

            $zipCodeInfo = ZipCode::find($request['cep']);

            if (isset($zipCodeInfo) && !empty($zipCodeInfo)) {
                $msg['response'] = $zipCodeInfo->getArray();
            } else {
                $msg['code'] = 1;
                $msg['message'] = "CEP não encontrado.";
            }
        } else {
            $msg['code'] = 2;
            $msg['message'] = "Requisição malformatada.";
        }
        return $msg;    // Laravel returns JSON by default
    }
}
