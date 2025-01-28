<?php
include ("config2.php");
include ("config3.php");
include ("config.php");
$nazov = $_POST["nazov"];
$vyrobca = $_POST["vyrobca"];
$popis = $_POST["popis"];
$farba = $_POST["farba"];
$cena = $_POST["cena"];
$kod = $_POST["kod"];

// Function to generate the computer identifier
function generateComputerIdentifier()
{
    // Replace this logic with your own to get the computer identifier
    return "B";
}

// Generate computer identifier
$computerIdentifier = generateComputerIdentifier();

// Generate timestamp identifier
$timestampIdentifier = date("ymdHis");

// Combine computer and timestamp identifiers
$dataIdentifier = $computerIdentifier . "-" . $timestampIdentifier;

$var = mysqli_connect($localhost2, $user2, $password2, $db2) or die("connect error");

$local_conn = new mysqli($localhost2, $user2, $password2, $db2);

if ($local_conn->connect_error) {
    die("Connection failed to local DB: " . $local_conn->connect_error);
}


$local_sql = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`) VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')";
$local_stmt = $local_conn->prepare($local_sql);


if ($local_stmt === false) {
    die("Local prepare failed: " . $local_conn->error);
}


if (!$local_stmt->execute()) {
    echo "Local execute failed: " . $local_stmt->error;
}


$local_stmt->close();
$local_conn->close();

//$var2 = mysqli_connect("$localhost2", "$user2", "$password2", "$db2") or die("connect error");
//$sql2 = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`)
//         VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')";
//$res2 = mysqli_query($var2, $sql2) or die("registration error");
echo "<font color=\"black\"><br><strong>Pridanie prebehlo úspešne </strong><br>";
echo "";

// uzol 1
$remote_sql = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`) VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')";

try {
    // Pokus o pripojenie k vzdialenej databáze
    $remote_conn = new mysqli($localhost, $user, $password, $db);

    // Kontrola pripojenia k vzdialenej databáze
    if ($remote_conn->connect_error) {
        throw new Exception("Connection failed to remote DB: " . $remote_conn->connect_error);
    }

    // Pripravenie SQL príkazu pre vzdialenú databázu
    $remote_stmt = $remote_conn->prepare($remote_sql);

    // Kontrola, či je statement správne pripravený
    if ($remote_stmt === false) {
        throw new Exception("Remote prepare failed: " . $remote_conn->error);
    }

    // Vykonanie príkazu vzdialenej databáze
    if (!$remote_stmt->execute()) {
        throw new Exception("Remote execute failed: " . $remote_stmt->error);
    }

    // Zatvorenie príkazu a pripojenia k vzdialenej databáze
    $remote_stmt->close();
    $remote_conn->close();

    echo "<font color=\"black\"><br><strong>Pridanie prebehlo úspešne </strong><br>";
    echo "";

} catch (Exception $e) {
  // Tu zapíšeme len SQL dotaz, ktorý sa nepodarilo vykonať
    $failed_sql = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`) VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')" . PHP_EOL;
    file_put_contents('failed1.txt', $failed_sql, FILE_APPEND);
    echo "An error occurred: " . $e->getMessage() . "<br>";
}
//$var3 = mysqli_connect("$localhost3", "$user3", "$password3", "$db3") or die("connect error");
//$sql3 = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`)
//         VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')";
//$res3 = mysqli_query($var3, $sql3) or die("registration error");

// uzol 3

$remote_sql3 = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`) VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')";

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
    
    echo "<font color=\"black\"><br><strong>Pridanie prebehlo úspešne </strong><br>";
    echo "";

} catch (Exception $e) {
  // Tu zapíšeme len SQL dotaz, ktorý sa nepodarilo vykonať
    $failed_sql = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`) VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')" . PHP_EOL;
    file_put_contents('failed3.txt', $failed_sql, FILE_APPEND);
    echo "An error occurred: " . $e->getMessage() . "<br>";
}
//$var = mysqli_connect("$localhost", "$user", "$password", "$db") or die("connect error");
//$sql = "INSERT INTO `tovar` (`nazov`, `vyrobca`, `popis`, `farba`, `cena`, `kod`, `data_identifier`)
//        VALUES ('$nazov', '$vyrobca', '$popis', '$farba', '$cena', '$kod', '$dataIdentifier')";
//$res = mysqli_query($var, $sql) or die("registration error");


header('Refresh: 3; url=index.php?menu=7');
?>