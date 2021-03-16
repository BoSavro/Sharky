<?php

declare(strict_types=1);

namespace App\Http\DTO\Controller\Request;

final class CreateEventRequest
{
    private string $title;
    private string $content;
    private string $gpsLat;
    private string $gpsLng;
    private string $validFrom;
    private string $validTo;


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): CreateEventRequest
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): CreateEventRequest
    {
        $this->content = $content;
        return $this;
    }

    public function getGpsLat(): string
    {
        return $this->gpsLat;
    }

    public function setGpsLat(string $gpsLat): CreateEventRequest
    {
        $this->gpsLat = $gpsLat;
        return $this;
    }

    public function getGpsLng(): string
    {
        return $this->gpsLng;
    }

    public function setGpsLng(string $gpsLng): CreateEventRequest
    {
        $this->gpsLng = $gpsLng;
        return $this;
    }

    public function getValidFrom(): string
    {
        return $this->validFrom;
    }

    public function setValidFrom(string $validFrom): CreateEventRequest
    {
        $this->validFrom = $validFrom;
        return $this;
    }

    public function getValidTo(): string
    {
        return $this->validTo;
    }

    public function setValidTo(string $validTo): CreateEventRequest
    {
        $this->validTo = $validTo;
        return $this;
    }
}
