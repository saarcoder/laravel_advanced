<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EasterEggController extends Controller
{   
    // public function __construct(Request $request)       // erzeugt eine Instanz, auf die die Methode middleware() aufgerufen werden kann
    // {
    //     $this->middleware('easteregg');
    // }
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->easteregg) {
                $easter = Carbon::createFromDate(null, 7, 19);
                if ($easter->isToday()) {
                    return redirect()->away('https://images.unsplash.com/photo-1522184462610-d9493b82cdf2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=564&q=80');
                } else {
                    abort(403, 'Its not easter yet');
                }
            }
    
            return $next($request);
        });
    }
    public function checkEaster(Request $request)
    {
        // $request = $request->middleware('easteregg');        
        // das funktioniert nicht: BadMethodCallException, Method Illuminate\Http\Request::middleware does not exist.
        return 'Ja hamma denn schon Weihnachten!';
    }
}
