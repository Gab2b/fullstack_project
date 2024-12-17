<?php 

/*
* @var PDO $pdo
*/

require './vendor/autoload.php';
require './Includes/database.php';

$faker = Faker\Factory::create('fr_FR');    

for ($i=0; $i <= 100; $i++) {
    $state = $pdo->prepare('INSERT INTO persons (`first_name`, `last_name`, `address`, `zip_code`, `city`, `phone`, `type`) VALUES (:first_name, :last_name, :address, :zip_code, :city, :phone, :type)');
    $state->bindValue(':first_name', $faker->firstName());
    $state->bindValue(':last_name', $faker->lastName());
    $state->bindValue(':address', $faker->streetAddress());
    $state->bindValue(':zip_code', $faker->postcode());
    $state->bindValue(':city', $faker->city());
    $state->bindValue(':phone', $faker->phoneNumber());
    $state->bindValue(':type', $faker->numberBetween(1,2), PDO::PARAM_INT);

    try {
        $state->execute();
    }

    catch (PDOException $e) {
        return "Erreur à la création de la personne {$e->getMessage()}";
    }

    $state->closeCursor();
}