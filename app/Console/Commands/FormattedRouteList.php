<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FormattedRouteList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:browse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run "route:list --except-vendor" and show the output formatted in default browser';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('route:list --json --except-vendor');
        $string = Artisan::output();

        file_put_contents('C:\xampp\htdocs\route_list\route_list.json', $string);
        exec('C:\xampp\htdocs\route_list\browse.cmd');

        return Command::SUCCESS;
    }
}
