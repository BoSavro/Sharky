<?php

declare(strict_types=1);

namespace App\Http\DTO\Controller\Response;

use DateTimeInterface;

final class EventResponse
{
    private int $id;
    private string $title;
    private string $content;
    private string $gpsLat;
    private string $gpsLng;
    private array $comments;
    private DateTimeInterface $validFrom;
    private DateTimeInterface $validTo;
    private DateTimeInterface $createAt;
    private DateTimeInterface $updateAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return EventResponse
     */
    public function setId(int $id): EventResponse
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return EventResponse
     */
    public function setTitle(string $title): EventResponse
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return EventResponse
     */
    public function setContent(string $content): EventResponse
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getGpsLat(): string
    {
        return $this->gpsLat;
    }

    /**
     * @param string $gpsLat
     * @return EventResponse
     */
    public function setGpsLat(string $gpsLat): EventResponse
    {
        $this->gpsLat = $gpsLat;
        return $this;
    }

    /**
     * @return string
     */
    public function getGpsLng(): string
    {
        return $this->gpsLng;
    }

    /**
     * @param string $gpsLng
     * @return EventResponse
     */
    public function setGpsLng(string $gpsLng): EventResponse
    {
        $this->gpsLng = $gpsLng;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getValidFrom(): DateTimeInterface
    {
        return $this->validFrom;
    }

    /**
     * @param DateTimeInterface $validFrom
     * @return EventResponse
     */
    public function setValidFrom(DateTimeInterface $validFrom): EventResponse
    {
        $this->validFrom = $validFrom;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getValidTo(): DateTimeInterface
    {
        return $this->validTo;
    }

    /**
     * @param DateTimeInterface $validTo
     * @return EventResponse
     */
    public function setValidTo(DateTimeInterface $validTo): EventResponse
    {
        $this->validTo = $validTo;
        return $this;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     * @return EventResponse
     */
    public function setComments(array $comments): EventResponse
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreateAt(): DateTimeInterface
    {
        return $this->createAt;
    }

    /**
     * @param DateTimeInterface $createAt
     * @return EventResponse
     */
    public function setCreateAt(DateTimeInterface $createAt): EventResponse
    {
        $this->createAt = $createAt;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdateAt(): DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * @param DateTimeInterface $updateAt
     * @return EventResponse
     */
    public function setUpdateAt(DateTimeInterface $updateAt): EventResponse
    {
        $this->updateAt = $updateAt;
        return $this;
    }
}
