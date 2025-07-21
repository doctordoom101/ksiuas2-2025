<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Club;
use App\Models\Player;

class ClientAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        $club = Club::where('api_token', $token)->first();
        $player = Player::where('api_token', $token)->first();

        if (!$club && !$player) {
            return response()->json([
                'message' => 'Unauthorized',
                'player' => $player,
            ], 401);
        }

        // Attach whichever is authenticated
        if ($club) {
            $request->merge(['authenticated_club' => $club]);
        } else {
            $request->merge(['authenticated_player' => $player]);
        }

        return $next($request);
    }
}
