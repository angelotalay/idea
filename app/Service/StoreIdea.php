<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;
use Throwable;

class StoreIdea
{
    //    In order to instantiate this class we need to pass the user
    //     Here we pass the current user to be injected into the constructor
    public function __construct(#[CurrentUser()] protected User $user) {}

    /**
     * @throws Throwable
     */
    public function handle(array $attributes): void
    {

        $data = collect($attributes)->only(['title', 'description', 'status', 'links'])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $attributes) {
            $idea = $this->user->ideas()->create($data);

            $idea->steps()->createMany(collect($attributes['steps'] ?? [])->map(fn ($step) => ['description' => $step]));
        });

    }
}
