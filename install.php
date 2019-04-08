
<?php 

    /**
     * open a connection via pdo to create a
     * new database and tables
     */

require "config.php";

try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    $sql = file_get_contents("data/init.sql");
    $connection->exec($sql);
    echo "Database and tables created successfully.\n";
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    $sql = file_get_contents("data/Members.sql");
    $connection->exec($sql);
    echo "Tables filled successfully.";
} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>