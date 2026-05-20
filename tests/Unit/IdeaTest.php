<?php

use App\Models\Idea;
use App\Models\User;

test('It belongs to a user', function () {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(User::class);
});

test('It has many steps', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toBeEmpty();

    $idea->steps()->create(['description' => 'Step 1']);
    expect($idea->steps()->count())->toBe(1);

});
