<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ProjectSharedNotification extends Notification
{
    use Queueable;

    protected $project;
    protected $sharedBy;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $sharedBy)
    {
        $this->project = $project;
        $this->sharedBy = $sharedBy; // User who shared the project (DG)
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

     public function toDatabase($notifiable)
     {
         return [
             'project_id' => $this->project->id,
             'project_title' => $this->project->title,
             'shared_by' => $this->sharedBy->name,
             'message' => 'A new project has been shared with you for review.',
         ];
     }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
