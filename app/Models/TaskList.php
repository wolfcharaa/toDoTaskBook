<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Schema\Blueprint;

/**
 * @property int id
 * @property int user_id
 * @property Collection $tasks
 *
 */
class TaskList extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class); //TODO перечитать взаимосвязи
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); //TODO перечитать взаимосвязи
    }

}
