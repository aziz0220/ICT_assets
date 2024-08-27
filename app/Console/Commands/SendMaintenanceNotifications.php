<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\User;
use App\Notifications\MaintenanceScheduleNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendMaintenanceNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send-maintenance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send maintenance schedule notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assets = Asset::whereDate('next_maintenance', '=', Carbon::now()->addDays(7))->get();

        foreach ($assets as $asset) {
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'Asset Manager');
            })->get();

            foreach ($users as $user) {
                $user->notify(new MaintenanceScheduleNotification($asset, $asset->next_maintenance));
            }
        }

        $this->info('Maintenance notifications sent successfully.');
    }
}
