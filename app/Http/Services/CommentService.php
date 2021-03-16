<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Adapter\CommentAdapter;
use App\Http\DTO\Controller\Request\CreateCommentRequest;
use App\Http\DTO\Controller\Response\CommentResponse;
use App\Http\Repositories\CommentRepository;
use App\Models\Comment;
use App\Models\News;
use DateTimeImmutable;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentService implements CommentServiceInterface
{
    public function __construct(
        private CommentRepository $commentRepository
    ) { }

    /**
     * @param CreateCommentRequest $createCommentRequest
     * @return CommentResponse
     */
    public function create(CreateCommentRequest $createCommentRequest): CommentResponse
    {
        $commentableType = $createCommentRequest->getCommentableType();

        $comment = Comment::create([
            'nickname'         => $createCommentRequest->getNickname(),
            'content'          => $createCommentRequest->getContent(),
            'commentable_type' => "App\Models\\".ucfirst($commentableType),
            'commentable_id'   => $createCommentRequest->getCommentableId(),
            'author_id'        => auth('api')->user()->getAuthIdentifier(),
            'created_at'       => new DateTimeImmutable(),
            'updated_at'       => new DateTimeImmutable(),
        ]);

        $response = new CommentAdapter($comment);
        return $response->createResponse();
    }

    /**
     * @param int $id
     */
    public function deleteById(int $id): void
    {
        $comment = $this->commentRepository->findById($id);

        if ($comment->author_id !== Auth::user()->getAuthIdentifier()) {
            throw new NotFoundHttpException();
        }

        $comment->delete();
    }
}
