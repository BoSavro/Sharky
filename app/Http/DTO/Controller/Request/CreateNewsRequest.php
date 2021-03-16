<?php

declare(strict_types=1);

namespace App\Http\DTO\Controller\Request;

use OpenApi\Annotations as OA;

final class CreateNewsRequest
{
    private string $title;
    private string $content;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): CreateNewsRequest
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): CreateNewsRequest
    {
        $this->content = $content;

        return $this;
    }
}
