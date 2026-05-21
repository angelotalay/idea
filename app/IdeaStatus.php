<?php

declare(strict_types=1);

namespace App;

enum IdeaStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    /**
     * Get the human-readable label for the enum case.
     *
     * @return string The label corresponding to the current status: "Pending", "In Progress", or "Completed".
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }
}
