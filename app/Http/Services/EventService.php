<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Adapter\EventAdapter;
use App\Http\DTO\Controller\Request\CreateEventRequest;
use App\Http\DTO\Controller\Response\EventResponse;
use App\Http\Filters\EventFilters;
use App\Http\Repositories\EventRepository;
use App\Models\Event;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use DateTimeImmutable;

class EventService implements EventServiceInterface
{
    public function __construct(
        private EventRepository $eventRepository
    ) { }

    public function getById(int $id): Event
    {
        $event = $this->eventRepository->findById($id);

        if ($event === null) {
            throw new EntityNotFoundException('Event', $id);
        }

        return $event;
    }

    /**
     * @inheritDoc
     */
    public function getAll(EventFilters $filters): array
    {
        $events = $this->eventRepository->findAll($filters);

        $result = [];
        foreach ($events as $event) {
            $response = new EventAdapter($event);
            $result[] = $response->createResponse();
        }

        return $result;
    }

    public function getResponseById(int $id): EventResponse
    {
        $event    = $this->getById($id);
        $response = new EventAdapter($event);
        return $response->createResponse();
    }

    public function create(CreateEventRequest $createEventRequest): EventResponse
    {
        $event = Event::create([
            'title'      => $createEventRequest->getTitle(),
            'content'    => $createEventRequest->getContent(),
            'valid_from' => $createEventRequest->getValidFrom(),
            'valid_to'   => $createEventRequest->getValidTo(),
            'gps_lat'    => $createEventRequest->getGpsLat(),
            'gps_lng'    => $createEventRequest->getGpsLng(),
            'created_at' => new DateTimeImmutable(),
            'updated_at' => new DateTimeImmutable(),
        ]);

        $response = new EventAdapter($event);
        return $response->createResponse();
    }

    public function update(int $id, CreateEventRequest $createEventRequest): EventResponse
    {
        $event = Event::where('id', $id)->update([
            'title'      => $createEventRequest->getTitle(),
            'content'    => $createEventRequest->getContent(),
            'valid_from' => $createEventRequest->getValidFrom(),
            'valid_to'   => $createEventRequest->getValidTo(),
            'gps_lat'    => $createEventRequest->getGpsLat(),
            'gps_lng'    => $createEventRequest->getGpsLng(),
            'updated_at' => new DateTimeImmutable(),
        ]);

        $response = new EventAdapter($event);
        return $response->createResponse();
    }

    public function deleteById(int $id): void
    {
        $event = Event::find($id);
        $event->delete();
    }

    public function findByDate(int $date): array
    {
        return $this->eventRepository->findByDate($date);
    }
}
