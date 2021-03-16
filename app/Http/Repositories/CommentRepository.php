<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\Comment;

class CommentRepository
{
    /**
     * @return Comment[]
     */
    public function findAll(): array
    {
        return Comment::all();
    }

    public function findById(int $id): Comment
    {
        return Comment::find($id);
    }

    public function delete(int $id): void
    {
        Comment::where('id', $id)->delete();
    }
}
