<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // 1. Obtenemos el campo 'imagen_url' que viene del formulario (<input name="imagen_url">)
        $url = $request->input('imagen_url');

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return redirect('/')
            ->with('error', 'La URL de la imagen no es válida.');
        }
        return $next($request);

    }
}
