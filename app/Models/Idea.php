<?php

declare(strict_types=1);

namespace App\Models;

use App\IdeaStatus;
use Database\Factories\IdeaFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;

    protected $casts = [
        'links' => AsArrayObject::class,
        'status' => IdeaStatus::class,
    ];

    protected $attributes = [
        'status' => IdeaStatus::PENDING,
    ];

    /**
     * Defines the inverse relationship indicating this Idea belongs to a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The owning User relationship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the one-to-many relationship between an Idea and its Step models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The relationship instance for the idea's steps.
     */
    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    /**
     * Compute counts of the given user's ideas grouped by status and include a total.
     *
     * @param User $user The user whose ideas will be counted.
     * @return Collection<string,int> A collection mapping each `IdeaStatus` value to its count (missing statuses map to `0`), with an additional `'all'` key containing the total idea count.
     */
    public static function getStatusCounts(User $user): Collection
    {
        // Use a raw SQL query to obtain the counts for each status
        $statusQuery = $user
            ->ideas()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Convert the raw SQL query results to a collection
        return collect(IdeaStatus::cases())->mapWithKeys(fn ($status) => [
            $status->value => $statusQuery->get($status->value, 0),
        ])->put('all', $user->ideas()->count());
    }
}
