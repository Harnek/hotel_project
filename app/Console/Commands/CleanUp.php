<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs Automatically';

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
     * @return int
     */
    public function handle()
    {
        \App\Models\Booking::query()
        ->where('check_out','<', date('Y-m-d'))
        ->each(function ($oldRecord) {
          $newPost = $oldRecord->replicate();
          $newPost ->setTable('archives');
          $newPost ->save();
      
          $oldRecord->delete();
        });
    }
}
