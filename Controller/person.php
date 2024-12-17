<?php
/**
 * @var PDO $pdo
 */

    require "Model/person.php";
    // if (isset($_POST['edit_button']))
    // {
    //     $last_name = !empty($_POST['last-name']) ? $_POST['last-name'] : null;
    //     $first_name = !empty($_POST['first-name']) ? $_POST['first-name'] : null;
    //     $city = !empty($_POST['city']) ? $_POST['city'] : null;
    //     $address = !empty($_POST['address']) ? $_POST['address'] : null;
    //     $phone = !empty($_POST['phone']) ? true : false;
    //     $zipcode = !empty($_POST['zipcode']) ? true : false;
    //     $type = !empty($_POST['type']) ? true : false;
    //     $id = $_GET['id'];

    //     if (!is_numeric($id)){
    //         $errors[] = "id au mauvais format";
    //     }

    //     if (
    //         !empty($last_name) &&
    //         !empty($first_name) &&
    //         !empty($city) &&
    //         !empty($address) &&
    //         !empty($phone) &&
    //         !empty($zipcode) &&
    //         !empty($type)
    //     ){
    //         $first_name = cleanString($first_name);
    //         $last_name = cleanString($last_name);
    //         $city = cleanString($city);
    //         $address = cleanString($address);
    //         $phone = cleanString($phone);
    //         $zipcode = cleanString($zipcode);
            
    //         if (empty($errors)){
    //             $res = updatePerson($pdo, $id, $first_name, $last_name, $address, $zipcode, $city, $phone, $type);
    //             if (!empty($res)){
    //                 $errors[] = $res;
    //             }
    //         }
    //     }
    // }

    // if (isset($_POST['valid_button'])) {
    //     $last_name = !empty($_POST['last-name']) ? $_POST['last-name'] : null;
    //     $first_name = !empty($_POST['first-name']) ? $_POST['first-name'] : null;
    //     $city = !empty($_POST['city']) ? $_POST['city'] : null;
    //     $address = !empty($_POST['address']) ? $_POST['address'] : null;
    //     $phone = !empty($_POST['phone']) ? $_POST['phone'] : null;
    //     $zipcode = !empty($_POST['zipcode']) ? $_POST['zipcode'] : null;
    //     $type = !empty($_POST['type']) ? $_POST['type'] : null;

    //     if (
    //         !empty($last_name) &&
    //         !empty($first_name) &&
    //         !empty($city) &&
    //         !empty($address) &&
    //         !empty($phone) &&
    //         !empty($zipcode) &&
    //         !empty($type)
    //     ) {
    //         $first_name = cleanString($first_name);
    //         $last_name = cleanString($last_name);
    //         $city = cleanString($city);
    //         $address = cleanString($address);
    //         $phone = cleanString($phone);
    //         $zipcode = cleanString($zipcode);

    //         if (empty($errors)) {

    //             $res = person_create($pdo, $last_name, $first_name, $address, $zipcode, $city, $phone, $type);
    
    //             if(!empty($res))
    //             {
    //                 $errors[] = $res;
    //             }
    //         }
    //         } else {
    //             $errors[] = 'Tous les champs sont obligatoires';
    //         }

    // }


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (!is_numeric($id)) {
            $errors[] = 'id au mauvais format';
        } else {
            $person = person($pdo, $id);
            if(!is_array($person)) {
                $errors[] = $person;
            }
        }
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        (
            $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
        )
    {
        $actionName = $_GET['action'] ?? null;
        switch ($actionName){
            case 'create':
                $last_name = !empty($_POST['last-name']) ? cleanString($_POST['last-name']) : null;
                $first_name = !empty($_POST['first-name']) ? cleanString($_POST['first-name']) : null;
                $city = !empty($_POST['city']) ? cleanString($_POST['city']) : null;
                $address = !empty($_POST['address']) ? cleanString($_POST['address']) : null;
                $phone = !empty($_POST['phone']) ? cleanString($_POST['phone']) : null;
                $zipcode = !empty($_POST['zipcode']) ? cleanString($_POST['zipcode']) : null;
                $type = !empty($_POST['type']) ? cleanString($_POST['type']) : null;


                if (
                    empty($last_name) ||
                    empty($first_name) ||
                    empty($city) ||
                    empty($address) ||
                    empty($phone) ||
                    empty($zipcode) ||
                    empty($type)
                ) {
                    header('X-Requested-With: XMLHttpRequest');
                    echo json_encode(['error' => 'Tous les champs sont obligatoires']);
                }

                $person = person_create($pdo, $last_name, $first_name, $address, $zipcode, $city, $phone, $type);

                if (!empty($person)) {
                    header('X-Requested-With: XMLHttpRequest');
                    echo json_encode(['error' => $person]);
                }
                else {
                    header('X-Requested-With: XMLHttpRequest');
                    echo json_encode(['success' => 'true']);
                }
                exit();
                break;
            
            case 'edit':
                if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

                    $last_name = !empty($_POST['last-name']) ? cleanString($_POST['last-name']) : null;
                    $first_name = !empty($_POST['first-name']) ? cleanString($_POST['first-name']) : null;
                    $city = !empty($_POST['city']) ? cleanString($_POST['city']) : null;
                    $address = !empty($_POST['address']) ? cleanString($_POST['address']) : null;
                    $phone = !empty($_POST['phone']) ? cleanString($_POST['phone']) : null;
                    $zipcode = !empty($_POST['zipcode']) ? cleanString($_POST['zipcode']) : null;
                    $type = !empty($_POST['type']) ? cleanString($_POST['type']) : null;

                    if (
                        empty($last_name) ||
                        empty($first_name) ||
                        empty($city) ||
                        empty($address) ||
                        empty($phone) ||
                        empty($zipcode) ||
                        empty($type)
                    ) {
                        header('X-Requested-With: XMLHttpRequest');
                        echo json_encode(['error' => 'Tous les champs sont obligatoires']);
                    }
                    
                    $personId = $_GET['id'];
                    
                    if (updatePerson($pdo, $personId, $first_name, $last_name, $address, $zipcode, $city, $phone, $type) !== null) {
                        header('X-Requested-With: XMLHttpRequest');
                    echo json_encode(['error' => $person]);
                    }
                    else {
                        header('X-Requested-With: XMLHttpRequest');
                        echo json_encode(['success' => 'true']);
                    }
                    
                    exit();

                } else {
                    header('X-Requested-With: XMLHttpRequest');
                    echo json_encode(['error' => 'id invalide']);
                    exit();
                }

            // case 'delete':
            //     $person = deletePerson($pdo, $id);
            //     break;
            
        }
        header('X-Requested-With: XMLHttpRequest');
        echo json_encode(['results' => $person]);
        exit();
    }


    require "View/person.php";