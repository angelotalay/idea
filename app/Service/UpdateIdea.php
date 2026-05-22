<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateIdea
{
    public function __construct(#[CurrentUser()] protected User $user) {}

    /**
     * @throws Throwable
     */
    public function handle(array $attributes, Idea $idea): void
    {
        $data = collect($attributes)->only(['title', 'description', 'status', 'links'])->toArray();
        $data['links'] = $attributes['links'] ?? [];

        if ($attributes['image'] ?? false) {
            $data['image'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $idea, $attributes) {
            $idea->update($data);

            // Easiest way to to delete the steps and add them again
            $idea->steps()->delete();

            $steps = collect($attributes['steps'] ?? [])
                ->filter()
                ->map(fn (string $step) => [
                    'description' => $step,
                ])
                ->values()
                ->all();

            $idea->steps()->createMany($steps);
        });
    }
}
