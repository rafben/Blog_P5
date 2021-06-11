<?php

namespace App\Models;

use Framework\Database;

abstract class Model
{

    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }


    public function find(string $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();

        return $item;
    }

    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    /**
     * Retourne la liste des articles classés par ordre de création//
     * @return array
    */
    public function findAll(?string $order =""): array
    {
        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }

        $resultats = $this->pdo->query($sql);
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function add(string $title, string $slug, string $intro, string $content): void
    {
        $query = $this->pdo->prepare('INSERT INTO articles SET title = :title, slug = :slug, introduction = :intro, content = :content, created_at = NOW()');
        $query->execute(compact('title', 'slug', 'intro', 'content'));
    }
}
