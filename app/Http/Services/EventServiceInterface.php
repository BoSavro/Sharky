<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\DTO\Controller\Request\CreateEventRequest;
use App\Http\DTO\Controller\Response\EventResponse;
use App\Http\Filters\EventFilters;
use App\Models\Event;

interface EventServiceInterface
{
    /**
     * @return EventResponse[]
     */
    public function getAll(EventFilters $filters): array;
    public function getById(int $id): Event;
    public function getResponseById(int $id): EventResponse;
    public function create(CreateEventRequest $createEventRequest): EventResponse;
    public function update(int $id, CreateEventRequest $createEventRequest): EventResponse;
    public function deleteById(int $id): void;
}
