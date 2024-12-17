<?php

    function person(PDO $pdo, int $id)
    {
        try {
            $state = $pdo->prepare("SELECT * FROM persons WHERE id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }

    }

    function updatePerson(PDO $pdo, string $person, string $last_name, string $first_name, string $address, string $zip_code, string $city, string $phone, int $type)
    {
        try {
            $state = $pdo->prepare("UPDATE `persons` SET first_name = :first_name, last_name = :last_name, address = :address, zip_code = :zip_code, city = :city type = :type WHERE id = :id");
            $state->bindParam(':first_name', $first_name);
            $state->bindParam(':last_name', $last_name);
            $state->bindParam(':address', $address);
            $state->bindParam(':zip_code', $zip_code);
            $state->bindParam(':city', $city);
            $state->bindParam(':phone', $phone);
            $state->bindParam(':type', $type, PDO::PARAM_INT);
            $state->bindParam(':id', $person, PDO::PARAM_INT);
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
        } catch (Exception $e) {
            return "Erreur à la création de la personne {$e->getMessage()}";
        }
    }