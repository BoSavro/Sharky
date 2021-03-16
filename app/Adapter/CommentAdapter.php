<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Http\DTO\Controller\Response\CommentResponse;
use App\Models\Comment;

class CommentAdapter
{
    public function __construct(
        private Comment $comment
    ) { }

    public function createResponse(): CommentResponse
    {
        $result = new CommentResponse();

        $result
            ->setId($this->comment->id)
            ->setNickname($this->comment->nickname)
            ->setContent($this->comment->content)
            ->setAuthorId($this->comment->author_id)

        ;

        return $result;
    }
}
