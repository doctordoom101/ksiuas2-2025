<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\EncryptionHelper;

class ClubController extends Controller
{
    public function index(Request $request)
    {
        $Club = $request->get('authenticated_club');
        $data = $Club->get();
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($data));
        return response()->json(['data' => $encryptedResponse]);
    }
}
