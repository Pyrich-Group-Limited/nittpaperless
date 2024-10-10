<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobberStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order',
        'created_by',
    ];

    public function applications($filter)
    {
        $application = JobberApplication::where('created_by', \Auth::user()->creatorId())->where('is_archive', 0)->where('stage', $this->id);
        $application->where('created_at', '>=', $filter['start_date']);
        $application->where('created_at', '<=', $filter['end_date']);

        if(!empty($filter['jobber']))
        {
            $application->where('jobber', $filter['jobber']);
        }

        $application = $application->orderBy('order')->get();

        return $application;
    }

}
