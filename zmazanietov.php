<?php
include("config.php");
include("config2.php");
include("config3.php");

$k =$_GET["k"]; 

echo "Data Identifier: $k";

$var = mysqli_connect($localhost, $user, $password, $db) or die("connect error");

$local_conn = new mysqli($localhost, $user, $password, $db);

if ($local_conn->connect_error) {
    die("Connection failed to local DB: " . $local_conn->connect_error);
}


$local_sql = "Delete FROM tovar WHERE data_identifier = '$k'";
$local_stmt = $local_conn->prepare($local_sql);


if ($local_stmt === false) {
    die("Local prepare failed: " . $local_conn->error);
}


if (!$local_stmt->execute()) {
    echo "Local execute failed: " . $local_stmt->error;
}


$local_stmt->close();
$local_conn->close();

//uzol 2
$remote_sql2 = "Delete FROM tovar WHERE data_identifier = '$k'";

try {
    // Pokus o pripojenie k vzdialenej databáze
    $remote_conn2 = new mysqli($localhost2, $user2, $password2, $db2);

    // Kontrola pripojenia k vzdialenej databáze
    if ($remote_conn2->connect_error) {
        throw new Exception("Connection failed to remote DB: " . $remote_conn2->connect_error);
    }

    // Pripravenie SQL príkazu pre vzdialenú databázu
    $remote_stmt2 = $remote_conn2->prepare($remote_sql2);

    // Kontrola, či je statement správne pripravený
    if ($remote_stmt2 === false) {
        throw new Exception("Remote prepare failed: " . $remote_conn2->error);
    }

    // Vykonanie príkazu vzdialenej databáze
    if (!$remote_stmt2->execute()) {
        throw new Exception("Remote execute failed: " . $remote_stmt2->error);
    }

    // Zatvorenie príkazu a pripojenia k vzdialenej databáze
    $remote_stmt2->close();
    $remote_conn2->close();


} catch (Exception $e) {
  // Tu zapíšeme len SQL dotaz, ktorý sa nepodarilo vykonať
    $failed_sql = "Delete FROM tovar WHERE data_identifier = '$k'" . PHP_EOL;
    file_put_contents('failed2.txt', $failed_sql, FILE_APPEND);
    echo "An error occurred: " . $e->getMessage();
}


// uzol 3

$remote_sql3 = "Delete FROM tovar WHERE data_identifier = '$k'";

try {
    // Pokus o pripojenie k vzdialenej databáze
    $remote_conn3 = new mysqli($localhost3, $user3, $password3, $db3);

    // Kontrola pripojenia k vzdialenej databáze
    if ($remote_conn3->connect_error) {
        throw new Exception("Connection failed to remote DB: " . $remote_conn3->connect_error);
    }

    // Pripravenie SQL príkazu pre vzdialenú databázu
    $remote_stmt3 = $remote_conn3->prepare($remote_sql3);

    // Kontrola, či je statement správne pripravený
    if ($remote_stmt3 === false) {
        throw new Exception("Remote prepare failed: " . $remote_conn3->error);
    }

    // Vykonanie príkazu vzdialenej databáze
    if (!$remote_stmt3->execute()) {
        throw new Exception("Remote execute failed: " . $remote_stmt3->error);
    }

    // Zatvorenie príkazu a pripojenia k vzdialenej databáze
    $remote_stmt3->close();
    $remote_conn3->close();

   
} catch (Exception $e) {
  // Tu zapíšeme len SQL dotaz, ktorý sa nepodarilo vykonať
    $failed_sql = "Delete FROM tovar WHERE data_identifier = '$k'" . PHP_EOL;
    file_put_contents('failed3.txt', $failed_sql, FILE_APPEND);
    echo "An error occurred: " . $e->getMessage();
}



echo "<font color=\"black\"><br><strong>Údaje úspešne vymazané! </strong>";
echo "";
header('Refresh: 3; url=index.php?menu=8');
?>