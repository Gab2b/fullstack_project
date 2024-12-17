<?php
    function getAllPersons(PDO $pdo, string | null $search = null, string | null $sortby = null, int $currentPage = 1)
    {
    // VERSION 1 AVEC LIMIT & OFFSET
    //
    //     $query = 'SELECT * FROM persons LIMIT :limit_page OFFSET :offset_page';
    //    if (null !== $search) {
    //        $query .= ' WHERE id LIKE :search OR last_name LIKE :search OR first_name LIKE :search OR address LIKE :search OR type LIKE :search';
    //    }

    //    if (null !== $sortby) {
    //        $query .= " ORDER BY $sortby";
    //    }
    
    //    $statement = $pdo->prepare($query);

    //     try {
    //        if (null !== $search) {
    //            $statement->bindValue(':search', "%$search%");
    //        }
    //            $statement->bindValue(':limit_page', LIST_ITEMS_PER_PAGE, PDO::PARAM_INT);
    //            $statement->bindValue(':offset_page', ($currentPage - 1) * LIST_ITEMS_PER_PAGE, PDO::PARAM_INT);

    //         $statement->execute();
    //         return $statement->fetchAll(PDO::FETCH_ASSOC);
    //     }
    //     catch (PDOException $e) {
    //         var_dump($e->getMessage());
    //         return $e->getMessage();
    //     }


    // VERSION 3 AVEC LIMIT & OFFSET (2 REQUETES)
    $res = [];
    $offset = ($currentPage - 1) * LIST_ITEMS_PER_PAGE;
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT id, last_name, first_name, address, type FROM persons ORDER BY id LIMIT 10 OFFSET $offset";
    $prep = $pdo->prepare($query);
    try {
        $prep->execute();
    } catch (PDOException $e) {
        return "erreur : ".$e->getCode . ':</b> ' . $e->getMessage();
    }
    
    $persons = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();
    
    $query = "SELECT COUNT(*) as count FROM persons";
    $prep = $pdo->prepare($query);
    try {
        $prep->execute();
    }
    catch (PDOException $e) {
        return "erreur : ".$e->getCode . ':</b> ' . $e->getMessage();
    }
    
    $count = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();
    
    return [$persons, $count];
}
