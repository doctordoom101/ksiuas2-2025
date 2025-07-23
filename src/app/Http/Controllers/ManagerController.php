<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Helper\EncryptionHelper;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        $manager = Manager::all(); // Ambil semua manager
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($manager));
        return response()->json(['data' => $encryptedResponse]);
    }
}
