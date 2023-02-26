<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string title
 * @property string description
 * @property string status
 */
class Task extends Model
{
    use HasFactory;

    const STATUS_YES = 'yes';
    const STATUS_NO = 'no';

    protected $fillable =
        [
            'id',
            'title',
            'created_at',
            'updated_at',
            'description',
            'status',
            'task_list_id',
        ];

    public function taskList(): BelongsTo
    {
        return $this->belongsTo(TaskList::class);
    }
}
