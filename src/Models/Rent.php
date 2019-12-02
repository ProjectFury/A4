<?php


namespace Rentit\Models;


use Rentit\Model;

final class Rent extends Model
{
    /**
     * Return all rents in database in an array
     * @return array
     */
    public function rents(): array
    {
        $sql = 'SELECT * FROM rents;';

        $this->query($sql);
        $this->execute();

        return $this->resultSet();
    }

    /**
     * Search in database using ID as comparison
     * @param string $id
     * @return array|null
     */
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

    /**
     * Delete a rent from the database
     * @param string $id
     */
    public function delete(string $id): void
    {
        $sql = 'DELETE FROM rents WHERE id = :id';

        $this->query($sql);
        $this->bind(":id", $id);
        $this->execute();
    }

    /**
     * Create a rent in the database
     * @param string $name
     * @param string $description
     * @param float $price
     * @param string $user_id
     */
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

    /**
     * Modify a rent in the database
     * @param string $id
     * @param string $name
     * @param string $description
     * @param float $price
     */
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