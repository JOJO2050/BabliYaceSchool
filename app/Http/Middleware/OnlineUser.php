<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class OnlineUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userId = Auth::id();

            Cache::put(
                'OnlineUser' . $userId,
                true,
                now()->addMinutes(2)
            );

            User::where('id', $userId)->update([
                'updated_at' => now()
            ]);
        }

        return $next($request);
    }
}