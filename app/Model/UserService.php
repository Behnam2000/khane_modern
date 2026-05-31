<?php

declare(strict_types=1);

namespace Model;

use Core\Database;
use Core\ValidationException;

class UserService
{
    public function __construct(private Database $db) {}

    public function findById(int $id): ?array
    {
        return $this->db->query(
            'SELECT id, first_name, last_name, phone, email, username, role, created_at
             FROM users WHERE id = :id',
            ['id' => $id]
        )->find() ?: null;
    }

    public function isAdmin(int $userId): bool
    {
        $user = $this->findById($userId);

        return ($user['role'] ?? '') === 'admin';
    }

    public function isEmailTaken(string $email, ?int $excludeId = null): void
    {
        $query = 'SELECT COUNT(*) FROM users WHERE email = :email';
        $params = ['email' => $email];

        if ($excludeId !== null) {
            $query .= ' AND id != :exclude_id';
            $params['exclude_id'] = $excludeId;
        }

        if ((int) $this->db->query($query, $params)->count() > 0) {
            throw new ValidationException(['email' => ['این ایمیل قبلاً ثبت شده است']]);
        }
    }

    public function isPhoneTaken(string $phone, ?int $excludeId = null): void
    {
        $query = 'SELECT COUNT(*) FROM users WHERE phone = :phone';
        $params = ['phone' => $phone];

        if ($excludeId !== null) {
            $query .= ' AND id != :exclude_id';
            $params['exclude_id'] = $excludeId;
        }

        if ((int) $this->db->query($query, $params)->count() > 0) {
            throw new ValidationException(['phone' => ['این شماره قبلاً ثبت شده است']]);
        }
    }

    public function create(array $userData): void
    {
        $this->isEmailTaken($userData['email']);
        $this->isPhoneTaken($userData['phone']);

        $passwordHash = password_hash($userData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            'INSERT INTO users (first_name, last_name, phone, email, password_hash)
             VALUES (:first_name, :last_name, :phone, :email, :password_hash)',
            [
                'first_name'    => $userData['first_name'],
                'last_name'     => $userData['last_name'],
                'email'         => $userData['email'],
                'phone'         => $userData['phone'],
                'password_hash' => $passwordHash,
            ]
        );

        session_regenerate_id();
        $_SESSION['user'] = (int) $this->db->id();
    }

    public function login(array $formData): void
    {
        $user = $this->db->query(
            'SELECT * FROM users WHERE phone = :phone',
            ['phone' => $formData['phone']]
        )->find();

        $passwordMatch = password_verify(
            $formData['password'],
            $user['password_hash'] ?? ''
        );

        if (!$user || !$passwordMatch) {
            throw new ValidationException(['password' => ['اطلاعات ورود نادرست است']]);
        }

        session_regenerate_id();
        $_SESSION['user'] = (int) $user['id'];
    }

    public function updateProfile(int $id, string $username, string $email): void
    {
        $this->db->query(
            'UPDATE users
             SET username = :username, email = :email, updated_at = CURRENT_TIMESTAMP
             WHERE id = :id',
            [
                'id'       => $id,
                'username' => $username,
                'email'    => $email,
            ]
        );
    }

    public function all(): array
    {
        return $this->db->query(
            'SELECT id, first_name, last_name, phone, email, username, role, created_at
             FROM users ORDER BY created_at DESC'
        )->findAll();
    }

    public function delete(int $id): void
    {
        $this->db->query('DELETE FROM users WHERE id = :id AND role != :role', [
            'id'   => $id,
            'role' => 'admin',
        ]);
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id();
    }
}
