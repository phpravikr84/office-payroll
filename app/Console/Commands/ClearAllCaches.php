<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
     // The name and signature of the console command
     protected $signature = 'clear:all';

     // The console command description
     protected $description = 'Clear cache, route, config, and view files';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
     // Execute the console command
     public function handle()
     {
         $this->call('cache:clear');
         $this->info('Application cache cleared');
 
         $this->call('route:clear');
         $this->info('Route cache cleared');
 
         $this->call('config:clear');
         $this->info('Configuration cache cleared');
 
         $this->call('view:clear');
         $this->info('Compiled views cleared');
 
         $this->info('All caches cleared successfully');
     }
}
