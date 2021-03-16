<?php

declare(strict_types=1);

namespace App\Http\DTO\Controller\Response;

use DateTimeInterface;

final class CommentResponse
{
    private int $id;
    private string $nickname;
    private string $content;
    private int $authorId;
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
     * @return CommentResponse
     */
    public function setId(int $id): CommentResponse
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     * @return CommentResponse
     */
    public function setNickname(string $nickname): CommentResponse
    {
        $this->nickname = $nickname;
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
     * @return CommentResponse
     */
    public function setContent(string $content): CommentResponse
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
     * @return CommentResponse
     */
    public function setAuthorId(int $authorId): CommentResponse
    {
        $this->authorId = $authorId;
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
     * @return CommentResponse
     */
    public function setCreateAt(DateTimeInterface $createAt): CommentResponse
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
     * @return CommentResponse
     */
    public function setUpdateAt(DateTimeInterface $updateAt): CommentResponse
    {
        $this->updateAt = $updateAt;
        return $this;
    }
}
