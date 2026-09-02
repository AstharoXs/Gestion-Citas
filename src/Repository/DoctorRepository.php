<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;

final class DoctorRepository
{
    public function __construct(private PDO $pdo)
    {
    }
    
    public function search(string $term = ''): array
    {
        // Eliminar espacios al inicio y al final.
        // $term = trim($term);

        // Si no hay término de búsqueda,
        // listar hasta 100 médicos.
        if ($term === '') {
            return $this->pdo->query(
                'SELECT *
                FROM doctors
                ORDER BY last_name, first_name
                LIMIT 100'
            )->fetchAll();
        }

        // Cada signo ? representa un parámetro distinto.
        $statement = $this->pdo->prepare(
            'SELECT *
            FROM doctors
            WHERE license_number LIKE :license_term
                OR first_name LIKE :first_term
                OR last_name LIKE :last_term
                OR concat(first_name," ", last_name) LIKE :full_term
            ORDER BY last_name, first_name
            LIMIT 100'
        );

        $likeTerm = '%'.$term.'%';
        $statement->execute([
            'license_term' => $term,
            'first_term' => $term,
            'last_term' => $term,
            'full_term' => $term,
        ]);
        return $statement->fetchAll();
    }

    public function active(): array
    {
        return $this->pdo->query(
            'SELECT id, license_number, first_name, last_name, specialty
            FROM doctors
            WHERE active = 1
            ORDER BY first_name, last_name'
        )->fetchAll();
    }
    
    public function findActive(int $id): ?array
    {
        $statement = $this->pdo->prepare(
            'SELECT id, license_number, first_name, last_name, specialty
            FROM doctors WHERE id = :id AND active = 1 LIMIT 1'
        );
        $statement->execute(['id' => $id]);
        $doctor = $statement->fetch();
        return $doctor === false ? null : $doctor;
    }

    public function create(array $data): int
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO doctors
            (license_number, first_name, last_name, specialty, active)
            VALUES
            (:license_number, :first_name, :last_name, :specialty, :active)'
        );
        $statement->execute($data);
        return (int) $this->pdo->lastInsertId();
    }

    public function count(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM doctors')->fetchColumn();
    }
}