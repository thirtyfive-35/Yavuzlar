
<?php

function Login($username, $passwd, $is_admin)
{

    include "db.php";

    $query = "SELECT *,COUNT(*) as count FROM user WHERE username = :username AND passwd = :passwd AND is_admin = :is_admin";

    $statement = $pdo->prepare($query);

    $statement->execute(['username' => $username, 'passwd' => $passwd, 'is_admin' => $is_admin]);

    $result = $statement->fetch();

    return $result;
}


?>
