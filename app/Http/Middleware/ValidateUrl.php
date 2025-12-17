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
    
    /* PARA PROBAR SI LEE EL VALIDATE
    public function handle(Request $request, Closure $next)
{
    // Esto matará la ejecución y mostrará "ESTOY AQUÍ" en pantalla.
    // Si al enviar el formulario NO ves esto, el Middleware no se está ejecutando.
    dd("ESTOY AQUÍ"); 

    return $next($request);
}
    */
    

    public function handle(Request $request, Closure $next)
    {
        $url = $request->input('imagen_url');

        // Forzamos que si NO contiene "http", siempre dé error
        if (!str_contains($url, 'http')) {
            return redirect('/')
                ->withInput()
                ->with('error', 'La URL debe ser completa (incluir http:// o https://)');
        }

        return $next($request);
    }


}
