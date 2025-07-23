<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Club;
use App\Models\Player;
use App\Models\Manager; // Tambahkan model Manager

class ClientAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        // Cek token di tiga model
        $club = Club::where('api_token', $token)->first();
        $player = Player::where('api_token', $token)->first();
        $manager = Manager::where('api_token', $token)->first();

        if (!$club && !$player && !$manager) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        // Tentukan siapa yang terautentikasi
        if ($club) {
            $request->merge(['authenticated_club' => $club]);
        } elseif ($player) {
            $request->merge(['authenticated_player' => $player]);
        } else {
            $request->merge(['authenticated_manager' => $manager]);
        }

        return $next($request);
    }
}
