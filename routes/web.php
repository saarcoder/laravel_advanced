<?php

use App\Http\Controllers\EasterEggController;
use App\Http\Controllers\OnionController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    var_dump(csrf_token());
    return view('welcome');
});

# get-Route welcome für die EasterEgg-Middleware erstellen
// Route::post('/welcome', function () {
//     return 'Ja hamma de\' scho\' Weihnachte\'?';
// })->middleware('easteregg');    
// // die Middleware easteregg ist jetzt registriert

// Route::post('/welcome', 'App\Http\Controllers\EasterEggController@checkEaster')->name('easteregg');
// Route::post('/welcome', [EasterEggController::class, 'checkEaster'])->name('easteregg');       // ohne angehängte Middleware-> Middleware greift noch nicht!
// Route::post('/welcome', [EasterEggController::class, 'checkEaster'])->name('easteregg')->middleware('easteregg');   
Route::post('/welcome', [EasterEggController::class, 'checkEaster'])->name('easteregg');   
Route::get('/onion', function(){})->middleware(['beforelayer', 'afterlayer']);  // die Reihenfolge des Aufrufs hier ist egal
Route::get('/logging', function(){
    # mit Voreinstellungen loggen

    # Zugriff via Facade: Ausgabe im logfile
    Log::info('Der Trainer ist eine Träne');        // local.INFO: Der Trainer ist eine Träne  
    Log::error('schwerer Fehler eingetreten');      // local.ERROR: schwerer Fehler eingetreten  

    # Zugriff via helper: Ausgabe im logfile
    logger('meine erste Logging-Methoden-Nachricht');   // local.DEBUG: meine erste Logging-Methoden-Nachricht  
    logger()->alert('Oh nein, was ist denn das?');  // local.ERROR: Oh nein, was ist denn das?

    ## die Level in der Browser-Konsole ausgeben mit eigenem Channel browserlog  
    logger()->channel('browserlog')->info('Wann ist endlich Schluss?');
    logger()->channel('browserlog')->debug('Wann ist endlich Schluss?');
    logger()->channel('browserlog')->notice('Wann ist endlich Schluss?');
    logger()->channel('browserlog')->warning('Wann ist endlich Schluss?');
    logger()->channel('browserlog')->error('Wann ist endlich Schluss?');
    logger()->channel('browserlog')->critical('Wann ist endlich Schluss?');
    logger()->channel('browserlog')->alert('Wann ist endlich Schluss?');
    logger()->channel('browserlog')->emergency('Wann ist endlich Schluss?');

    $myArray = [
        'firstname' => 'Oli',
        'lastname' => 'Vogt',
        'age' => '42'
    ];

    Log::channel('browserlog')->info(json_encode($myArray)); 
    // der info()-Methode darf kein Array übergeben werden, aber ein Stringable: also z.B. ein JSON-Objekt
    Log::channel('browserlog')->info(var_export($myArray, true));       // Alternativ mit var_export() -  Liefert den Inhalt einer Variablen als parsbaren PHP-Code
});
Route::get('/', function () {
    Log::channel('daily2')->info(request()->ip());  // IP auslesen
    #echo [];
    return view('welcome');
});

Route::middleware('throttle:30,1')->group(function() {
    // 30 Anfragen pro Minute erlaubt
    Route::get('/', function() {
        return view('welcome');
    });
});  