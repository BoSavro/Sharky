<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\DTO\Controller\Request\CreateNewsRequest;
use App\Http\Services\NewsServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(name="News")
 */
class NewsController extends Controller
{
    public function __construct(
        private NewsServiceInterface $newsService,
        private SerializerInterface $serializer
    ) { }

    /**
     * @OA\Get(
     *    tags={"News"},
     *    path="/api/v1/news",
     *    description="Get news",
     *    summary="Return news",
     *    @OA\Response(
     *        response=200,
     *        description="Array of news",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *               @OA\Property(
     *                   property="id",
     *                   nullable=false,
     *                   description="Id",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="title",
     *                   nullable=false,
     *                   description="Title",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="content",
     *                   nullable=false,
     *                   description="Content",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="createdAt",
     *                   nullable=false,
     *                   description="Created at",
     *                   type="integer"
     *                ),
     *                @OA\Property(
     *                   property="updatedAt",
     *                   nullable=false,
     *                   description="Updated At",
     *                   type="integer"
     *                ),
     *            )
     *        ),
     *    ),
     * )
     */
    public function index(): Response
    {
        $news = $this->newsService->getAll();
        $data = $this->serializer->serialize($news, JsonEncoder::FORMAT);

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     tags={"News"},
     *     path="/api/v1/news",
     *     description="Create news",
     *     summary="Create news",
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
     *                  property="createAt",
     *                  nullable=false,
     *                  description="Create at",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="updateAt",
     *                  nullable=false,
     *                  description="Update At",
     *                  type="integer"
     *            ),
     *        ),
     *     ),
     * )
     */
    public function create(Request $request): Response
    {
        $createNewsRequest = $this->serializer->deserialize(
            $request->getContent(),
            CreateNewsRequest::class,
            JsonEncoder::FORMAT
        );

        $news = $this->newsService->create($createNewsRequest);
        $data = $this->serializer->serialize($news, JsonEncoder::FORMAT);

        return new Response($data, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *    tags={"News"},
     *    path="/api/v1/news/{id}",
     *    description="Get news by id",
     *    summary="Return news by id",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        description="news id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="event",
     *        @OA\JsonContent(
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
     *                  property="createAt",
     *                  nullable=false,
     *                  description="Create at",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="updateAt",
     *                  nullable=false,
     *                  description="Update At",
     *                  type="integer"
     *            ),
     *        ),
     *    ),
     * )
     */
    public function getById(int $id): Response
    {
        $news = $this->newsService->getResponseById($id);
        $data = $this->serializer->serialize($news, JsonEncoder::FORMAT);

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     tags={"News"},
     *     path="/api/v1/news",
     *     description="Update news by id",
     *     summary="Update news by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="News id",
     *     ),
     *     @OA\RequestBody(
     *          description="Update news body",
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
     *        response=200,
     *        description="news",
     *        @OA\JsonContent(
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
     *                  property="createAt",
     *                  nullable=false,
     *                  description="Create at",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="updateAt",
     *                  nullable=false,
     *                  description="Update At",
     *                  type="integer"
     *            ),
     *        ),
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation exceptions",
     *
     *     ),
     * )
     */
    public function update(Request $request, int $id): Response
    {
        $updateNews = $this->serializer->deserialize(
            $request->getContent(),
            CreateNewsRequest::class,
            JsonEncoder::FORMAT
        );

        $news =  $this->newsService->update($id, $updateNews);
        $data = $this->serializer->serialize($news, JsonEncoder::FORMAT);
        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     tags={"News"},
     *     path="/api/v1/news/{id}",
     *     description="Delete news by id",
     *     summary="Delete news by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="news id",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted"
     *     ),
     * )
     */
    public function delete(int $id): Response
    {
        $this->newsService->deleteById($id);
        return new Response(null, Response::HTTP_OK);
    }
}
