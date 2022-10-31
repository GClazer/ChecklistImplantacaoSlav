<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'task_title',
        'task_status',
        'responsible_task',
        'task_description',
        'checklist_id',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
