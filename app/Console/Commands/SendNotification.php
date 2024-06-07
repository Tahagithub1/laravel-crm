<?php

namespace App\Console\Commands;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'email send to default list 2';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Notification::make()
            ->title('email send to default 2')
            ->sendToDatabase(User::all());
           $this->info('A notification created');
    }
}
