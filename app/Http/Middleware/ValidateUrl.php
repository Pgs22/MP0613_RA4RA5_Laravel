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
    
    // Si no pasa el filtro
    public function handle(Request $request, Closure $next)
    {
        $url = $request->input('imagen_url'); // Usamos input en vez de route porque es un formulario tipo POST no GET

        // Si el campo imagen_url no contiene http nos mostrará el mensaje de error y redirige a home
        if (!str_contains($url, 'http')) {
            return redirect('/')
                ->withInput() // Para guardar los datos y no tener que volver a escribir si falla el enviar formuario
                ->with('error', 'La URL debe ser completa (incluir http:// o https://)');
        }

        return $next($request);
    }


}
