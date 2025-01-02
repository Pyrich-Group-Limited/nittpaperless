<?php
use App\Models\InternalNotification;

/**
 * Create a notification for a user.
 *
 * @param int $userId The ID of the user to notify.
 * @param string $title The title of the notification.
 * @param string $body The body/message of the notification.
 * @param string|null $link Optional link for the notification.
 * @return void
 */
function createNotification($userId, $title, $body, $link = null)
{
    InternalNotification::create([
        'user_id' => $userId,
        'title' => $title,
        'body' => $body,
        'link' => $link,
    ]);
}

function markAsRead($notificationId)
{
    $notification = InternalNotification::where('id', $notificationId)
        ->where('user_id', auth()->id())
        ->first();

    if ($notification) {
        $notification->update(['is_read' => true]);
        return true;
    }

    return false;
}

function markAllAsRead()
{
    return InternalNotification::where('user_id', auth()->id())
        ->where('is_read', false)
        ->update(['is_read' => true]);
}
