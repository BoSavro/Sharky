<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Http\Filters\EventFilters;
use App\Models\Comment;
use App\Models\Event;

class EventRepository
{
    /**
     * @param EventFilters $filters
     * @return Event[]
     */
    public function findAll(EventFilters $filters): array
    {
        return Event::with(Comment::class)
            ->filter($filters)
            ->get();
    }

    public function findById(int $id): Event
    {
        return Event::with(Comment::class)
            ->where('id', $id)
            ->get();
    }
}
