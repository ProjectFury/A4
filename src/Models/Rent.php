<?php


namespace Rentit\Models;


use Rentit\Model;

final class Rent extends Model
{
    public function rents(): array
    {
        $sql = 'SELECT * FROM rents;';

        $this->query($sql);
        $this->execute();

        return $this->resultSet();
    }

    public function findById(string $id): ?array
    {
        $sql = 'SELECT * FROM rents WHERE id = :id';

        $this->query($sql);
        $this->bind(":id", $id);
        $this->execute();

        $result = $this->resultSet();

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    public function delete(string $id): void
    {
        $sql = 'DELETE FROM rents WHERE id = :id';

        $this->query($sql);
        $this->bind(":id", $id);
        $this->execute();
    }

    public function publish(string $name, string $description, float $price, string $user_id): void
    {
        $sql = 'INSERT INTO rents (name, description, price, user_id) VALUES (:name, :description, :price, :user_id)';

        $this->query($sql);
        $this->bind(":name", $name);
        $this->bind(":description", $description);
        $this->bind(":price", $price);
        $this->bind(":user_id", $user_id);
        $this->execute();
    }

    public function modify(string $id, string $name, string $description, float $price): void
    {
        $sql = 'UPDATE rents SET name = :name, description = :description, price = :price WHERE id = :id';

        $this->query($sql);
        $this->bind(":name", $name);
        $this->bind(":description", $description);
        $this->bind(":price", $price);
        $this->bind(":id", $id);
        $this->execute();
    }
}