<?php
/**
 * @var PDO $pdo
 */
    const LIST_ITEMS_PER_PAGE = 10;
    require "Model/persons.php";
    if (
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        (
            $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
        )
    {
    
    $page = cleanString($_GET['page'] ?? 1);

    $search = isset($_GET['search']) ? $_GET['search'] : null;
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
    // $persons = getAllPersons($pdo, $search, $sortby, $page);
    [$persons, $count] = getAllPersons($pdo, $search, $sortby, $page);


    if (!is_array($persons)){
        $errors[] = $persons;
    }

    header('X-Requested-With: XMLHttpRequest');
    echo json_encode(['results' => $persons, 'count' => $count]);
    exit();
}
    require "View/persons.php";
