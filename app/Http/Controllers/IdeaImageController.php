<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class IdeaImageController extends Controller
{
    public function destroy(Idea $idea)
    {
        Gate::authorize('work-with', $idea);

        $imagePath = $idea->image;

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        $idea->update(['image' => null]);

        return back();
    }
}
