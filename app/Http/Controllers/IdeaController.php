<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
use App\Service\StoreIdea;
use App\Service\UpdateIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Throwable;

class IdeaController extends Controller
{
    /**
     * Render the ideas index view for the authenticated user, optionally filtered by status.
     *
     * @param  Request  $request  Incoming HTTP request; accepts an optional `status` value to filter the user's ideas.
     * @return View The `idea.index` view with `ideas`, `statuses`, and `statusCounts` provided.
     */
    public function index(Request $request)
    {

        // Get ideas based on the status filter
        $ideas = Auth::user()->ideas()->when(in_array($request->status, IdeaStatus::values()),
            fn ($query) => $query->where('status', $request->status))
            ->latest('created_at')->get();

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
     * Store a newly created resource in storage.
     *
     * @throws Throwable
     */
    public function store(IdeaRequest $request, StoreIdea $action)
    {
        // Laravel handles instantiation here
        $action->handle($request->safe()->all());

        return to_route('idea.index')->with('success', 'Idea created successfully!');
    }

    /**
     * Display the given idea resource.
     *
     * @param  Idea  $idea  The idea instance to display.
     */
    public function show(Idea $idea)
    {
        Gate::authorize('work-with', $idea);

        return view('idea.show', [
            'idea' => $idea,
            'ideaStatus' => IdeaStatus::cases(),
        ]);
    }

    /**
     * Update the given Idea resource with data from the request.
     *
     * @param  Request  $request  HTTP request carrying the update attributes.
     * @param  Idea  $idea  The Idea model instance to be updated.
     *
     * @throws Throwable
     */
    public function update(IdeaRequest $request, Idea $idea, UpdateIdea $action)
    {
        Gate::authorize('work-with', $idea);
        // Laravel handles instantiation here
        $action->handle($request->safe()->all(), $idea);

        return to_route('idea.show', [
            'idea' => $idea,
            'ideaStatus' => IdeaStatus::cases(),
        ])->with('success', 'Idea updated successfully!');

    }

    /**
     * Delete the given idea.
     *
     * @param  Idea  $idea  The idea to delete.
     */
    public function destroy(Idea $idea)
    {
        // Authorise first!
        Gate::authorize('work-with', $idea);

        $idea->delete();

        return to_route('idea.index');
    }
}
