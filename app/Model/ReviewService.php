<?php

declare(strict_types=1);

namespace Model;

use Core\Database;

class ReviewService
{
    public function __construct(private Database $db) {}

    public function create(int $userId, string $body, ?int $rating = null): int
    {
        $this->db->query(
            'INSERT INTO reviews (user_id, body, rating) VALUES (:user_id, :body, :rating)',
            [
                'user_id' => $userId,
                'body'    => $body,
                'rating'  => $rating,
            ]
        );

        return (int) $this->db->id();
    }

    public function approved(): array
    {
        return $this->db->query(
            'SELECT r.id, r.body, r.rating, r.admin_response, r.created_at,
                    u.first_name, u.last_name
             FROM reviews r
             INNER JOIN users u ON u.id = r.user_id
             WHERE r.status = :status
             ORDER BY r.created_at DESC',
            ['status' => 'approved']
        )->findAll();
    }

    public function all(?string $status = null): array
    {
        $query = 'SELECT r.*, u.first_name, u.last_name, u.email,
                         a.first_name AS admin_first_name, a.last_name AS admin_last_name
                  FROM reviews r
                  INNER JOIN users u ON u.id = r.user_id
                  LEFT JOIN users a ON a.id = r.responded_by';

        $params = [];

        if ($status !== null) {
            $query .= ' WHERE r.status = :status';
            $params['status'] = $status;
        }

        $query .= ' ORDER BY r.created_at DESC';

        return $this->db->query($query, $params)->findAll();
    }

    public function findById(int $id): ?array
    {
        return $this->db->query(
            'SELECT r.*, u.first_name, u.last_name, u.email
             FROM reviews r
             INNER JOIN users u ON u.id = r.user_id
             WHERE r.id = :id',
            ['id' => $id]
        )->find() ?: null;
    }

    public function updateStatus(int $id, string $status): void
    {
        $this->db->query(
            'UPDATE reviews SET status = :status WHERE id = :id',
            ['id' => $id, 'status' => $status]
        );
    }

    public function respond(int $reviewId, int $adminId, string $response): void
    {
        $this->db->query(
            'UPDATE reviews
             SET admin_response = :response,
                 responded_by = :admin_id,
                 responded_at = CURRENT_TIMESTAMP,
                 status = :status
             WHERE id = :id',
            [
                'id'       => $reviewId,
                'response' => $response,
                'admin_id' => $adminId,
                'status'   => 'approved',
            ]
        );
    }

    public function delete(int $id): void
    {
        $this->db->query('DELETE FROM reviews WHERE id = :id', ['id' => $id]);
    }
}
