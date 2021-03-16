<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\EventRepository;
use App\Http\Repositories\NewsRepository;
use App\Http\Services\CommentService;
use App\Http\Services\CommentServiceInterface;
use App\Http\Services\EventService;
use App\Http\Services\EventServiceInterface;
use App\Http\Services\MessagingService;
use App\Http\Services\MessagingServiceInterface;
use App\Http\Services\NewsServiceInterface;
use App\Http\Services\NewsService;
use Illuminate\Support\ServiceProvider;
use L5Swagger\L5SwaggerServiceProvider;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(L5SwaggerServiceProvider::class);

        $this->app->bind(NewsServiceInterface::class, function () {
            return new NewsService(
                $this->app->get(NewsRepository::class)
            );
        });

        $this->app->bind(EventServiceInterface::class, function () {
            return new EventService(
                $this->app->get(EventRepository::class)
            );
        });

        $this->app->bind(CommentServiceInterface::class, function () {
            return new CommentService(
                $this->app->get(CommentRepository::class)
            );
        });

        $this->app->bind(SerializerInterface::class, function () {
            return new Serializer([new ObjectNormalizer()], [$this->app->get(JsonEncoder::class)]);
        });

        $this->app->bind(MessagingServiceInterface::class, function () {
            return new MessagingService();
        });
    }
}
