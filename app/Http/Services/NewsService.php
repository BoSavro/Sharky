<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Adapter\NewsAdapter;
use App\Http\DTO\Controller\Request\CreateNewsRequest;
use App\Http\DTO\Controller\Response\NewsResponse;
use App\Http\Repositories\NewsRepository;
use App\Models\News;
use DateTimeImmutable;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsService implements NewsServiceInterface
{
    public function __construct(
        private NewsRepository $newsRepository
    ) { }

    public function getById(int $id): News
    {
        $news = $this->newsRepository->findById($id);

        if ($news === null) {
            throw new EntityNotFoundException('News', $id);
        }

        return $news;
    }

    /**
     * @inheritDoc
    */
    public function getAll(): array
    {
        $news = $this->newsRepository->findAll();

        $result = [];
        foreach ($news as $item) {
            $response = new NewsAdapter($item);
            $result[] = $response->createResponse();
        }

        return $result;
    }

    public function getResponseById(int $id): NewsResponse
    {
        $news     = $this->getById($id);
        $response = new NewsAdapter($news);
        return $response->createResponse();
    }

    public function create(CreateNewsRequest $createNewsRequest): NewsResponse
    {
        $news = News::create([
            'title'      => $createNewsRequest->getTitle(),
            'content'    => $createNewsRequest->getContent(),
            'author_id'  => auth('api')->user()->getAuthIdentifier(),
            'created_at' => new DateTimeImmutable(),
            'updated_at' => new DateTimeImmutable(),
        ]);

        $response = new NewsAdapter($news);
        return $response->createResponse();
    }

    public function update(int $id, CreateNewsRequest $createNewsRequest): NewsResponse
    {
        $news = $this->newsRepository->findById($id);

        if ($news->author_id !== Auth::user()->getAuthIdentifier()) {
            throw new NotFoundHttpException();
        }

        $updated = $news->update([
            'title'      => $createNewsRequest->getTitle(),
            'content'    => $createNewsRequest->getContent(),
            'updated_at' => new DateTimeImmutable(),
        ]);

        $response = new NewsAdapter($news->fresh());
        return $response->createResponse();
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deleteById(int $id): void
    {
        $news = $this->newsRepository->findById($id);

        if ($news->author_id !== Auth::user()->getAuthIdentifier()) {
            throw new NotFoundHttpException();
        }

        $news->delete();
    }
}
