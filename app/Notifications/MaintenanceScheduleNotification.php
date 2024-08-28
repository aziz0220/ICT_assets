<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceScheduleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $asset;
    protected $maintenanceDate;

    public function __construct($asset, $maintenanceDate)
    {
        $this->asset = $asset;
        $this->maintenanceDate = $maintenanceDate;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Overdue Maintenance Reminder')
            ->line('This is a reminder for an overdue maintenance task.')
            ->line('Asset: ' . $this->asset->name)
            ->line('Maintenance Requested On: ' . $this->maintenanceDate->format('Y-m-d H:i'))
            ->action('View Asset Details', url('/assets/' . $this->asset->id))
            ->line('Please take action on this maintenance task as soon as possible.');
    }

    public function toArray($notifiable): array
    {
        return [
            'asset_id' => $this->asset->id,
            'asset_name' => $this->asset->name,
            'maintenance_date' => $this->maintenanceDate->toDateTimeString(),
        ];
    }
}
