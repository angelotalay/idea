<?php

it("registers a user", function () {
    visit("/register")
        ->type("name", "John Doe")
        ->type("email", "john@example.com")
        ->type("password", "passwordtest1")
        ->click("Create Account")
        ->assertPathIs("/");
});
