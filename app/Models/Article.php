<?php

namespace App\Models;

class Article extends Model
{

    protected $table = "articles";

    public function addArticle(string $title, string $slug, string $intro, string $content): bool
    {
        $sql = 'INSERT INTO articles SET title = :title, slug = :slug, introduction = :intro, content = :content, created_at = NOW(), updated_at = NOW()';
        
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('title', 'slug', 'intro', 'content'));

        if ($query->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateArticle(int $id, object $inputs): bool
    {
        $sql = 'UPDATE articles SET title = ?, slug = ?, introduction = ?, content = ?, updated_at = NOW() WHERE id = ?';

        $query = $this->pdo->prepare($sql);
        $query->execute([
            $inputs->title,
            $inputs->slug,
            $inputs->introduction,
            $inputs->content,
            $id
        ]);

        if ($query->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
}