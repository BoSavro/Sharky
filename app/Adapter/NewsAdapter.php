<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Http\DTO\Controller\Response\NewsResponse;
use App\Models\News;

class NewsAdapter
{
    public function __construct(
        private News $news
    ) { }

    public function createResponse(): NewsResponse
    {
        $result = new NewsResponse();
        $result
            ->setId($this->news->id)
            ->setTitle($this->news->title)
            ->setContent($this->news->content)
            ->setAuthorId($this->news->author_id)
            ->setComments($this->news->comments->toArray())

        ;

        return $result;
    }
}
