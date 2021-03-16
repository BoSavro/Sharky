<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\DTO\Controller\Request\CreateNewsRequest;
use App\Http\DTO\Controller\Response\NewsResponse;
use App\Models\News;

interface NewsServiceInterface
{
    /**
     * @return NewsResponse[]
    */
    public function getAll(): array;
    public function getById(int $id): News;
    public function getResponseById(int $id): NewsResponse;
    public function create(CreateNewsRequest $createNewsRequest): NewsResponse;
    public function update(int $id, CreateNewsRequest $updateNewsRequest): NewsResponse;
    public function deleteById(int $id): void;
}
