<?php
    function getAll(PDO $pdo, string | null $search = null, string | null $sortby = null)
    {
        $query = 'SELECT * FROM users';
        if (null !== $search) {
            $query .= ' WHERE id LIKE :search OR username LIKE :search OR email LIKE :search';
        }

        if (null !== $sortby) {
            $query .= " ORDER BY $sortby";
        }
        $statement = $pdo->prepare($query);

        try {
            if (null !== $search) {
                $statement->bindValue(':search', "%$search%");
            }


            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    // function toggleEnabled (PDO $pdo, int $id): void
    // {
    //     $statement = $pdo->prepare("UPDATE users SET enabled = NOT enabled WHERE id = :id");
    //     $statement->bindParam(':id', $id, PDO::PARAM_INT);
    //     $statement->execute();
    // }

    function delete (PDO $pdo, int $id)
    {
        try {
            $statement = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        }
        catch (PDOException $e) {
            return $e ->getMessage();
        }
    }

    function toggleEnabled(PDO $pdo, int $id)
    {
        $query = ' UPDATE users SET enabled = NOT enabled WHERE id = :id';


        $res = $pdo->prepare($query);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $res->execute();
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

        return true;

    }