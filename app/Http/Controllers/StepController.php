<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Display a form for creating a new Step resource.
     *
     * Presents the UI for entering data required to create a new Step.
     */
    public function create(): void
    {
        //
    }

    /**
     * Persist a newly created Step resource using data from the provided request.
     *
     * @param Request $request The incoming HTTP request containing attributes for the new Step.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified Step resource.
     *
     * @param \App\Models\Step $step The Step model instance to display.
     */
    public function show(Step $step): void
    {
        //
    }

    /**
     * Display the form for editing the given Step.
     *
     * @param Step $step The Step model instance to edit.
     */
    public function edit(Step $step): void
    {
        //
    }

    /**
         * Update the given Step using data from the HTTP request.
         *
         * @param Request $request The HTTP request containing updated attributes for the step.
         * @param Step $step The Step instance to be updated.
         */
    public function update(Request $request, Step $step): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Step $step): void
    {
        //
    }
}
