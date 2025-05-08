<?php

namespace App\Listeners;

use App\Events\MemoSigned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RegenerateMemoPdf
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    

    /**
     * Handle the event.
     *
     * @param  \App\Events\MemoSigned  $event
     * @return void
     */
    
    public function handle(MemoSigned $event)
    {
        $memo = $event->memo->fresh(['signedUsers.signature']);

        $pdf = Pdf::loadView('memos.template', [
            'memo' => $memo,
            'title' => $memo->title,
            'date' => now()->format('F j, Y'),
            'content' => $memo->file_content,
        ]);

        // Save the updated PDF
        Storage::put("memos/{$memo->id}.pdf", $pdf->output());
    }
}
