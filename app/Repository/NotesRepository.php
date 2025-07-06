<?php

declare(strict_types=1);

namespace App\Repository;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

final class NoteRepository
{
    public function __construct(
        private Explorer $db,
    ) {
    }

    public function get(int $id)
    {
        return $this->db->table('notes')->get($id);
    }

    public function findAll(): array
    {
        return $this->db->table('notes')
            ->order('id DESC')
            ->fetchAll();
    }

    public function insert(array $data): ?ActiveRow
    {
        return $this->db->table('notes')->insert($data);
    }

    public function delete(int $id): int
    {
        return $this->db->table('notes')->wherePrimary($id)->delete();
    }
}
