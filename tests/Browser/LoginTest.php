<?php

use App\Models\User;

it('Logs in a user', function () {
    $user = User::factory()->create([
        "password" => "testpassword"
    ]);

    visit("/login")
        ->fill("email", $user->email)
        ->fill("password", "testpassword")
        ->click("@login-button")
        ->assertPathIs("/");

    $this->assertAuthenticated();
});

it('Logs out a user', function () {
    $user = User::factory()->create([
        "password" => "testpassword"
    ]);

    $this->actingAs($user);

    visit("/")->click("@logout-button");

    $this->assertGuest();
});



