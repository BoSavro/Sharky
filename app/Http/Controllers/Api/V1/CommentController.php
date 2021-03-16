<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\DTO\Controller\Request\CreateCommentRequest;
use App\Http\Services\CommentServiceInterface;
use App\Http\Services\MessagingServiceInterface;
use App\Http\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @OA\Tag(name="Comments")
 */
class CommentController extends Controller
{
    public function __construct(
        private CommentServiceInterface $commentService,
        private SerializerInterface $serializer,
        private MessagingServiceInterface $messagingService,
        private UserServiceInterface $userService,
    ) { }

    /**
     * @OA\Post(
     *     tags={"Comments"},
     *     path="/api/v1/comments",
     *     description="Create comment",
     *     summary="Create comments",
     *     @OA\RequestBody(
     *          description="New body",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="title",
     *                  nullable=false,
     *                  description="Tile",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="content",
     *                  nullable=false,
     *                  description="Content",
     *                  type="string"
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation exceptions",
     *          @OA\JsonContent(
     *            type="object",
     *            @OA\Property(
     *                  property="id",
     *                  nullable=false,
     *                  description="Id",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="title",
     *                  nullable=false,
     *                  description="Title",
     *                  type="string"
     *            ),
     *            @OA\Property(
     *                  property="content",
     *                  nullable=false,
     *                  description="Content",
     *                  type="string"
     *            ),
     *            @OA\Property(
     *                  property="createdAt",
     *                  nullable=false,
     *                  description="Created at",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="updatedAt",
     *                  nullable=false,
     *                  description="Updated At",
     *                  type="integer"
     *            ),
     *        ),
     *     ),
     * )
     */
    public function create(Request $request): Response
    {
        $createCommentRequest = $this->serializer->deserialize(
            $request->getContent(),
            CreateCommentRequest::class,
            JsonEncoder::FORMAT
        );

        $comment = $this->commentService->create($createCommentRequest);
        $data    = $this->serializer->serialize($comment, JsonEncoder::FORMAT);

        $user = $this->userService->getById($comment->getAuthorId());
        $this->messagingService->send(
            $user->email,
            [
                'name' => $user->name,
            ]
        );

        return new Response($data, Response::HTTP_CREATED);
    }

    /**
     * @OA\Delete(
     *     tags={"Comments"},
     *     path="/api/v1/comments/{id}",
     *     description="Delete comments by id",
     *     summary="Delete comments by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="comment id",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted"
     *     ),
     * )
     */
    public function delete(int $id): Response
    {
        $this->commentService->deleteById($id);
        return new Response(null, Response::HTTP_OK);
    }
}
