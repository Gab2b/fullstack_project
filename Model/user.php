<?php

    function verifyUsername( PDO $pdo, string $username, int $id)
    {
        try {
            $state = $pdo->prepare("SELECT COUNT(*) AS user_number FROM users WHERE username = :username AND id <> :id");
            $state->bindParam(':username', $username, PDO::PARAM_STR);
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de verification du username {$e->getMessage()}";
        }
    }


    function user(PDO $pdo, int $id)
    {
        try {
            $state = $pdo->prepare("SELECT * FROM users WHERE id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }

    }

    function updateUser(PDO $pdo, int $id, string $username, string $email, bool $enabled)
    {
        try {
            $state = $pdo->prepare("UPDATE `users` SET username = :username, email = :email, enabled = :enabled WHERE id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->bindParam(':username', $username);
            $state->bindParam(':email', $email);
            $state->bindParam(':enabled', $enabled, PDO::PARAM_BOOL);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }
    }


    function updatePassword(PDO $pdo, int $id, string $password)
    {
        try {
            $state = $pdo->prepare("UPDATE `users` SET password = :password WHERE id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->bindParam(':password', $password);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }
    }

    function verify_user (PDO $pdo, string $username)
    {
        try {
            $state = $pdo->prepare("SELECT COUNT(*) AS user_number FROM users WHERE username = :username");
            $state->bindParam(':username', $username, PDO::PARAM_STR);
            $state->execute();
            $res = $state->fetch();
        } catch (Exception $e) {
            return "Erreur de verification du username {$e->getMessage()}";
        }
    }

    function user_create (PDO $pdo, string $username, string $password, string $email, bool $enabled)
    {
        try {
            $state = $pdo->prepare('INSERT INTO users (`username`, `email`, `password`, `enabled`) VALUES (:username, :email, :password, :enabled)');
            $state->bindParam(':username', $username);
            $state->bindParam(':email', $email);
            $state->bindParam(':password', $password);
            $state->bindParam(':enabled', $enabled, PDO::PARAM_BOOL);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur à la création du user {$e->getMessage()}";
        }
    }