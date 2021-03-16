<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class NewsRepository
{
    /**
     * @return News[]
    */
    public function findAll(): Collection
    {
        return News::whereDate('created_at', Carbon::today())
            ->get();
    }

    public function findById(int $id): News|null
    {
        return News::find($id);
    }

    public function delete(int $id): void
    {
        News::where('id', $id)->delete();
    }
}
