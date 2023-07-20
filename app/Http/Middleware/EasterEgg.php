<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EasterEgg
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        # dump($request);
        if ($request->easteregg) {
            $easter = Carbon::createFromDate(null, 4, 8);
            // $easter = Carbon::createFromDate(null, 7, 19);
            if ($easter->isToday()) {       
                // isToday() ist eine Helper-Methode der Carbon-Klasse Comparison.php, die Datumswerte vergleicht
                return redirect()->away('https://images.unsplash.com/photo-1522184462610-d9493b82cdf2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=564&amp;q=80');
            } else {
                abort(403, 'Its not easter yet');
            }
        } else {
            echo 'Du musst schon ein easteregg mitgeben', PHP_EOL;
        }
        return $next($request);
    }
}
