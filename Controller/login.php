<?php

/**
 * @var PDO $pdo
 */

require "Model/login.php";
if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    (
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    )
) {
    $errors = [];
    $username = !empty($_POST["username"]) ? $_POST['username'] : null;
    $password = !empty($_POST["password"]) ? $_POST["password"] : null;

    if (
        !empty($username) &&
        !empty($password)
    ) {
        $username = cleanString($username);
        $password = cleanString($password);

        $user = getUser($pdo, $username);

        if (is_array($user)) {
            $isMatchPassword = is_array($user) && password_verify($password, $user['password']);

            if ($isMatchPassword && $user['enabled']) {
                $_SESSION["auth"] = true;
                $_SESSION["user_id"] = $user['id'];
                $_SESSION["user_username"] = $user['username'];
                header('X-Requested-With: XMLHttpRequest');
                echo json_encode(['authentication' => true]);
                exit();
            } elseif (!$user['enabled'] && $isMatchPassword) {
                $errors[] = "L'utilisateur n'est pas actif";
                header('X-Requested-With: XMLHttpRequest');
                echo json_encode(['errors' => $errors]);
                exit();
            } else {
                $errors[] = "L'identification a échoué";
                header('X-Requested-With: XMLHttpRequest');
                echo json_encode(['errors' => $errors]);
                exit();
            }
        } else {
            $errors[] = "L'identification a échoué";
            header('X-Requested-With: XMLHttpRequest');
            echo json_encode(['errors' => $errors]);
            exit();
        }


    }
}

require "View/login.php";
