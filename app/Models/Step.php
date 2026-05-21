<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StepFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    /** @use HasFactory<StepFactory> */
    use HasFactory;

    protected $attributes = [
        'completed' => false,
    ];

    /**
     * Retrieve the Idea that this Step belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The relationship instance linking this Step to its Idea.
     */
    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
