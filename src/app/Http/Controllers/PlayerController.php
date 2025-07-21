<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\EncryptionHelper;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $player = $request->get('authenticated_player');
        $data = $player->get();
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($data));
        return response()->json(['data' => $encryptedResponse]);
    }
}
