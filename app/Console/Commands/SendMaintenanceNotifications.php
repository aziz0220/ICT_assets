<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AssetMaintenance;
use App\Models\User;
use App\Notifications\MaintenanceScheduleNotification;
use Carbon\Carbon;

class SendMaintenanceNotifications extends Command
{
    protected $signature = 'notifications:send-maintenance';
    protected $description = 'Send maintenance schedule notifications';

    public function handle()
    {
        try {
            $pendingMaintenances = AssetMaintenance::where('status', 'pending')
                ->where('is_approved', true)
                ->whereDate('created_at', '<=', Carbon::now()->subDays(7))
                ->get();

            foreach ($pendingMaintenances as $maintenance) {
                $asset = $maintenance->asset;
                $users = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Asset Manager');
                })->get();

                foreach ($users as $user) {
                    $user->notify(new MaintenanceScheduleNotification($asset, $maintenance->created_at));
                }
            }

            $this->info('Maintenance notifications sent successfully.');
            \Log::info('Maintenance notifications sent successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while sending maintenance notifications: ' . $e->getMessage());
            \Log::error('Error sending maintenance notifications: ' . $e->getMessage());
        }
    }
}
