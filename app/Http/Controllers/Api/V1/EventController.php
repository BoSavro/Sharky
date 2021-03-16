<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\DTO\Controller\Request\CreateEventRequest;
use App\Http\Filters\EventFilters;
use App\Http\Services\EventServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @OA\Tag(name="Events")
 */
class EventController extends Controller
{
    public function __construct(
        private EventServiceInterface $eventService,
        private SerializerInterface $serializer
    ) { }

    /**
     * @OA\Get(
     *    tags={"Events"},
     *    path="/api/v1/events",
     *    description="Get events",
     *    summary="Return events",
     *    @OA\RequestBody(
     *      description="Filtering",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(
     *              property="filteringDate",
     *              nullable=true,
     *              description="Date",
     *              type="string"
     *          ),
     *      ),
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Array of events",
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
     *                   property="validFrom",
     *                   nullable=false,
     *                   description="Valid from",
     *                   type="integer"
     *                ),
     *                @OA\Property(
     *                   property="validTo",
     *                   nullable=false,
     *                   description="Valid To",
     *                   type="integer"
     *                ),
     *               @OA\Property(
     *                   property="gpsLat",
     *                   nullable=false,
     *                   description="GPS Latitude",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="gpsLng",
     *                   nullable=false,
     *                   description="GPS Longitude",
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
    public function index(EventFilters $filters, Request $request): Response
    {
        $events = $this->eventService->getAll($filters);
        $data   = $this->serializer->serialize($events, JsonEncoder::FORMAT);

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     tags={"Events"},
     *     path="/api/v1/events",
     *     description="Create event",
     *     summary="Create event",
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
     *              @OA\Property(
     *                  property="validFrom",
     *                  nullable=false,
     *                  description="Valid from",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="validTo",
     *                  nullable=false,
     *                  description="Valid To",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="gpsLat",
     *                  nullable=false,
     *                  description="GPS Latitude",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="gpsLng",
     *                  nullable=false,
     *                  description="GPS Longitude",
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
     *                  property="validFrom",
     *                  nullable=false,
     *                  description="Valid from",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="validTo",
     *                  nullable=false,
     *                  description="Valid To",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="gpsLat",
     *                  nullable=false,
     *                  description="GPS Latitude",
     *                  type="string"
     *            ),
     *            @OA\Property(
     *                  property="gpsLng",
     *                  nullable=false,
     *                  description="GPS Longitude",
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
        $createEventRequest = $this->serializer->deserialize(
            $request->getContent(),
            CreateEventRequest::class,
            JsonEncoder::FORMAT
        );

        $event = $this->eventService->create($createEventRequest);
        $data  = $this->serializer->serialize($event, JsonEncoder::FORMAT);

        return new Response($data, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *    tags={"Events"},
     *    path="/api/v1/events/{id}",
     *    description="Get event by id",
     *    summary="Return event by id",
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
     *                  property="validFrom",
     *                  nullable=false,
     *                  description="Valid from",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="validTo",
     *                  nullable=false,
     *                  description="Valid To",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="gpsLat",
     *                  nullable=false,
     *                  description="GPS Latitude",
     *                  type="string"
     *            ),
     *            @OA\Property(
     *                  property="gpsLng",
     *                  nullable=false,
     *                  description="GPS Longitude",
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
     *    ),
     * )
     */
    public function getById(int $id): Response
    {
        $event = $this->eventService->getResponseById($id);
        $data  = $this->serializer->serialize($event, JsonEncoder::FORMAT);

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     tags={"Events"},
     *     path="/api/v1/events",
     *     description="Update event by id",
     *     summary="Update event by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Event id",
     *     ),
     *     @OA\RequestBody(
     *          description="Update event body",
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
     *              @OA\Property(
     *                  property="validFrom",
     *                  nullable=false,
     *                  description="Valid from",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="validTo",
     *                  nullable=false,
     *                  description="Valid To",
     *                  type="integer"
     *              ),
     *              @OA\Property(
     *                  property="gpsLat",
     *                  nullable=false,
     *                  description="GPS Latitude",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="gpsLng",
     *                  nullable=false,
     *                  description="GPS Longitude",
     *                  type="string"
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
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
     *                  property="validFrom",
     *                  nullable=false,
     *                  description="Valid from",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="validTo",
     *                  nullable=false,
     *                  description="Valid To",
     *                  type="integer"
     *            ),
     *            @OA\Property(
     *                  property="gpsLat",
     *                  nullable=false,
     *                  description="GPS Latitude",
     *                  type="string"
     *            ),
     *            @OA\Property(
     *                  property="gpsLng",
     *                  nullable=false,
     *                  description="GPS Longitude",
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
     *     @OA\Response(
     *          response="400",
     *          description="Validation exceptions",
     *
     *     ),
     * )
     */
    public function update(Request $request, int $id): Response
    {
        $updateEvent = $this->serializer->deserialize(
            $request->getContent(),
            CreateEventRequest::class,
            JsonEncoder::FORMAT
        );

        $event = $this->eventService->update($id, $updateEvent);
        $data  = $this->serializer->serialize($event, JsonEncoder::FORMAT);

        return new Response($data, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     tags={"Events"},
     *     path="/api/v1/events/{id}",
     *     description="Delete event by id",
     *     summary="Delete event by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="event id",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted"
     *     ),
     * )
     */
    public function delete(int $id): Response
    {
        $this->eventService->deleteById($id);
        return new Response(null, Response::HTTP_OK);
    }
}
