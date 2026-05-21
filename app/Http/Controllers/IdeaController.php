<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Render the ideas index view for the authenticated user, optionally filtered by status.
     *
     * @param \Illuminate\Http\Request $request Incoming HTTP request; accepts an optional `status` value to filter the user's ideas.
     * @return \Illuminate\View\View The `idea.index` view with `ideas`, `statuses`, and `statusCounts` provided.
     */
    public function index(Request $request)
    {
        // Get ideas based on the status filter
        $ideas = Auth::user()->ideas()->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->get();

        return view(
            'idea.index',
            [
                'ideas' => $ideas,
                'statuses' => IdeaStatus::cases(),
                'statusCounts' => Idea::getStatusCounts(Auth::user()),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the given idea resource.
     *
     * @param \App\Models\Idea $idea The idea instance to display.
     */
    public function show(Idea $idea): void
    {
        //
    }

    /**
     * Display the form to edit the given idea.
     *
     * @param \App\Models\Idea $idea The idea to edit.
     */
    public function edit(Idea $idea): void
    {
        //
    }

    /**
     * Update the given Idea resource with data from the request.
     *
     * @param \Illuminate\Http\Request $request HTTP request carrying the update attributes.
     * @param \App\Models\Idea $idea The Idea model instance to be updated.
     */
    public function update(Request $request, Idea $idea): void
    {
        //
    }

    /**
     * Delete the given idea.
     *
     * @param \App\Models\Idea $idea The idea to delete.
     */
    public function destroy(Idea $idea): void
    {
        //
    }
}
