<?php
    /**
 * @var PDO $pdo
 */

    require "Model/users.php";


    if (
        isset($_GET['action']) &&
        isset($_GET['id']) &&
        is_numeric($_GET['id'])
        ) {
        $id = cleanString($_GET['id']);
        switch ($_GET['action']) {
            case 'delete':

                $delete = delete($pdo, $id);

                if (!empty($delete))
                {
                    $delete = "Impossible de supprimer l'utilisateur car celui-ci est encore lié !";
                    $errors[] = $delete;
                } else {
                    header("Location: index.php?component=users");
                }

                break;
            default:
                break;
        }



    }

    // MA VERSION
    // 
    // if (
    //     !empty($_SERVER['CONTENT_TYPE']) &&
    //     (
    //         $_SERVER['CONTENT_TYPE'] === 'application/json' ||
    //         str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded')
    //     )
    // ){
    //     if (
    //         isset($_GET['action']) &&
    //         isset($_GET['id']) &&
    //         is_numeric($_GET['id'])
    //     ) {
    //         $id = cleanString($_GET['id']);
    //         if ($_GET['action'] === 'toggle-active') {
    //             $toggleRequest = toggleEnabled($pdo, $id);
    //             header('Content-Type: application/json');
    //             echo json_encode(['success' => true]);
    //             exit();
    //         }
            
    //     }
    //     }
    
    // FIN DE MA VERSION

    if (
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') )
{
    if (isset($_SESSION['auth']))
    {
        if (isset($_GET['component'])) {
            switch ($actionName) {
                case 'toggle-active':
                    $id = cleanString($_GET['id']);
                    $res = toggleEnabled($pdo, $id);

                    header('X-Requested-With: XMLHttpRequest');
                    if (is_bool($res))
                    {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'message' => $res]);
                    }
                    exit();
                    break;
            }
        }
    } else {
        require "Controller/login.php";
    }
     exit();
}

    $search = isset($_POST['search']) ? $_POST['search'] : null;
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
    $users = getAll($pdo, $search, $sortby);

    if (!is_array($users))
    {
        $errors[] = $users;
    }
    require "View/users.php";