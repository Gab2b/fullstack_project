<?php

    function person(PDO $pdo, int $id)
    {
        try {
            $state = $pdo->prepare("SELECT p.*, up.user_id FROM `persons` AS p LEFT JOIN user_person as up ON up.person_id = p.id WHERE p.id =:id;");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }

    }

    function updatePerson(PDO $pdo, int $personId, string $last_name, string $first_name, string $address, string $zip_code, string $city, string $phone, int $type)
    {
        try {
            $state = $pdo->prepare("UPDATE `persons` SET first_name = :first_name, last_name = :last_name, address = :address, zip_code = :zip_code, phone = :phone, city = :city, type = :type WHERE id = :id");
            $state->bindParam(':first_name', $first_name);
            $state->bindParam(':last_name', $last_name);
            $state->bindParam(':address', $address);
            $state->bindParam(':zip_code', $zip_code);
            $state->bindParam(':city', $city);
            $state->bindParam(':phone', $phone);
            $state->bindParam(':type', $type, PDO::PARAM_INT);
            $state->bindParam(':id', $personId, PDO::PARAM_INT);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }
    }

    function person_create (PDO $pdo, string $last_name, string $first_name, string $address, string $zip_code, string $city, string $phone, int $type)
    {


        try {
            $state = $pdo->prepare('INSERT INTO persons (`first_name`, `last_name`, `address`, `zip_code`, `city`, `phone`, `type`) VALUES (:first_name, :last_name, :address, :zip_code, :city, :phone, :type)');
            $state->bindParam(':first_name', $first_name);
            $state->bindParam(':last_name', $last_name);
            $state->bindParam(':address', $address);
            $state->bindParam(':zip_code', $zip_code);
            $state->bindParam(':city', $city);
            $state->bindParam(':phone', $phone);
            $state->bindParam(':type', $type, PDO::PARAM_INT);

            $state->execute();
            $id = (int)$pdo->lastInsertId();

        } catch (Exception $e) {
            return "Erreur à la création de la personne {$e->getMessage()}";
        }

        return $id;
    }

    function linkUserToPerson(PDO $pdo, int $userId, int $personId){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO user_person (user_id, person_id) VALUES (:user_id, :person_id)";
        $prep = $pdo->prepare($query);
        $prep->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $prep->bindParam(':person_id', $personId, PDO::PARAM_INT);

        try {
            $prep->execute();
        } catch (PDOException $e) {
            return " erreur ".$e->getCode() . ':</b>'. $e->getMessage();
        }

    
        $prep->closeCursor();

        return true ;
    }