<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Helper\EncryptionHelper;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        $manager = $request->get('authenticated_manager');
        $data = $manager->get();
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($data));

        return response()->json(['data' => $encryptedResponse]);
    }
}
