<?php

namespace App\Console\Commands;

use App\Models\Events;
use Illuminate\Console\Command;

class DeleteEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $events =new Events();
        $eventsToDelete = $events->whereColumn('start_time', '>', 'end_time')->get();
        $eventsToDelete->each->delete();
        $this->info('Events deleted successfully.');
    }
}
