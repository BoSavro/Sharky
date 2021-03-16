<?php

declare(strict_types=1);

namespace App\Http\DTO\Controller\Response;

use DateTimeInterface;

final class NewsResponse
{
    private int $id;
    private string $title;
    private string $content;
    private int $authorId;
    private array $comments;
    private DateTimeInterface $createAt;
    private DateTimeInterface $updateAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): NewsResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): NewsResponse
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): NewsResponse
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @param int $authorId
     * @return NewsResponse
     */
    public function setAuthorId(int $authorId): NewsResponse
    {
        $this->authorId = $authorId;
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
     * @return NewsResponse
     */
    public function setComments(array $comments): NewsResponse
    {
        $this->comments = $comments;
        return $this;
    }

    public function getCreateAt(): DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTimeInterface $createAt): NewsResponse
    {
        $this->createAt = $createAt;
        return $this;
    }

    public function getUpdateAt(): DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeInterface $updateAt): NewsResponse
    {
        $this->updateAt = $updateAt;
        return $this;
    }
}
