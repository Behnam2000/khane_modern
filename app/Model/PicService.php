<?php

declare(strict_types=1);

namespace Model;

use Core\Database;

class PicService
{
    public function __construct(private Database $db) {}

    public function active(): array
    {
        return $this->db->query(
            'SELECT id, filename, title, description, sort_order
             FROM portfolio_pics
             WHERE is_active = 1
             ORDER BY sort_order ASC, id ASC'
        )->findAll();
    }

    public function all(): array
    {
        return $this->db->query(
            'SELECT p.*, u.first_name AS uploader_first_name, u.last_name AS uploader_last_name
             FROM portfolio_pics p
             LEFT JOIN users u ON u.id = p.uploaded_by
             ORDER BY p.sort_order ASC, p.id ASC'
        )->findAll();
    }

    public function findById(int $id): ?array
    {
        return $this->db->query(
            'SELECT * FROM portfolio_pics WHERE id = :id',
            ['id' => $id]
        )->find() ?: null;
    }

    public function create(
        string $filename,
        string $title,
        ?string $description,
        int $uploadedBy,
        int $sortOrder = 0
    ): int {
        $this->db->query(
            'INSERT INTO portfolio_pics (filename, title, description, sort_order, uploaded_by)
             VALUES (:filename, :title, :description, :sort_order, :uploaded_by)',
            [
                'filename'    => $filename,
                'title'       => $title,
                'description' => $description,
                'sort_order'  => $sortOrder,
                'uploaded_by' => $uploadedBy,
            ]
        );

        return (int) $this->db->id();
    }

    public function update(
        int $id,
        string $title,
        ?string $description,
        int $sortOrder,
        bool $isActive
    ): void {
        $this->db->query(
            'UPDATE portfolio_pics
             SET title = :title,
                 description = :description,
                 sort_order = :sort_order,
                 is_active = :is_active
             WHERE id = :id',
            [
                'id'          => $id,
                'title'       => $title,
                'description' => $description,
                'sort_order'  => $sortOrder,
                'is_active'   => $isActive ? 1 : 0,
            ]
        );
    }

    public function delete(int $id): void
    {
        $this->db->query('DELETE FROM portfolio_pics WHERE id = :id', ['id' => $id]);
    }
}
