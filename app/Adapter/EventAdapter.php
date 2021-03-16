<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Http\DTO\Controller\Response\EventResponse;
use App\Models\Event;

class EventAdapter
{
    public function __construct(
        private Event $event
    ) { }

    public function createResponse(): EventResponse
    {
        $result = new EventResponse();
        $result
            ->setId($this->event->id)
            ->setTitle($this->event->title)
            ->setContent($this->event->content)
            ->setValidFrom($this->event->validFrom)
            ->setValidTo($this->event->validTo)
            ->setGpsLat($this->event->gpsLat)
            ->setGpsLng($this->event->gpsLng)
            ->setComments($this->event->comments->toArray())

        ;

        return $result;
    }
}
