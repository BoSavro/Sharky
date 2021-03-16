<?php

declare(strict_types=1);

namespace App\Http\DTO\Controller\Request;

final class CreateCommentRequest
{
    private string $nickname;
    private string $content;
    private string $commentableType;
    private string $commentableId;

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     * @return CreateCommentRequest
     */
    public function setNickname(string $nickname): CreateCommentRequest
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): CreateCommentRequest
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getCommentableType(): string
    {
        return $this->commentableType;
    }

    /**
     * @param string $commentableType
     * @return CreateCommentRequest
     */
    public function setCommentableType(string $commentableType): CreateCommentRequest
    {
        $this->commentableType = $commentableType;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommentableId(): string
    {
        return $this->commentableId;
    }

    /**
     * @param string $commentableId
     * @return CreateCommentRequest
     */
    public function setCommentableId(string $commentableId): CreateCommentRequest
    {
        $this->commentableId = $commentableId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommentId(): string
    {
        return $this->commentId;
    }

    /**
     * @param string $commentId
     * @return CreateCommentRequest
     */
    public function setCommentId(string $commentId): CreateCommentRequest
    {
        $this->commentId = $commentId;
        return $this;
    }
}
