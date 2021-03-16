<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\DTO\Controller\Request\CreateCommentRequest;
use App\Http\DTO\Controller\Response\CommentResponse;
use App\Models\Comment;

interface CommentServiceInterface
{
    /**
     * @return CommentResponse[]
     */
    public function create(CreateCommentRequest $createEventRequest): CommentResponse;
    public function deleteById(int $id): void;
}
