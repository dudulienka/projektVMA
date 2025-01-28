<?php
include("config.php");
include("config2.php"); 
include("config3.php"); 

// Vytvorenie pripojenia k vzdialenej databáze
@$remote_conn = new mysqli($localhost, $user, $password, $db);

// Kontrola pripojenia k vzdialenej databáze
if ($remote_conn->connect_error) {
    die("Nepodarilo sa pripojiť (Uzol 1): " . $remote_conn->connect_error);
}

// Načítanie príkazov zo súboru
@$filename = 'failed.txt';
if (file_exists($filename) && is_readable($filename)) {
    // Kontrola, či je súbor prázdny
    if (filesize($filename) > 0) {
        $queries = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($queries) {
            foreach ($queries as $query) {
                // Odstráni koncový bodkočiarku pre konzistenciu
                $query = rtrim($query, ";");
                // Vykonanie príkazu
                if ($remote_conn->query($query) === TRUE) {
                    echo "Úspech (Uzol 1): " . $query . "<br>";
                } else {
                    echo "Error (Uzol 1): " . $remote_conn->error . "<br>";
                }
            }
            // Vymazanie obsahu súboru po úspešnej synchronizácii
            file_put_contents($filename, '');
        }
    } else {
        echo "Súbor je prázdny (Uzol 1).\n" . "<br>";
    }
} else {
    echo "Súbor sa nepodarilo prečítať (Uzol 1)\n" . "<br>";
}

// Zatvorenie pripojenia
$remote_conn->close();

// uzol 2
@$remote_conn2 = new mysqli($localhost2, $user2, $password2, $db2);

// Kontrola pripojenia k vzdialenej databáze
if ($remote_conn2->connect_error) {
    die("Nepodarilo sa pripojiť (Uzol 3): " . $remote_conn2->connect_error);
}

// Načítanie príkazov zo súboru
@$filename2 = 'failed2.txt';
if (file_exists($filename2) && is_readable($filename2)) {
    // Kontrola, či je súbor prázdny
    if (filesize($filename2) > 0) {
        $queries2 = file($filename2, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($queries2) {
            foreach ($queries2 as $query2) {
                // Odstráni koncový bodkočiarku pre konzistenciu
                $query2 = rtrim($query2, ";");
                // Vykonanie príkazu
                if ($remote_conn2->query($query2) === TRUE) {
                    echo "Úspech (Uzol 2): " . $query2 . "<br>";
                } else {
                    echo "Error (Uzol 2): " . $remote_conn2->error . "<br>";
                }
            }
            // Vymazanie obsahu súboru po úspešnej synchronizácii
            file_put_contents($filename2, '');
        }
    } else {
        echo "Súbor je prázdny (Uzol 2).\n" . "<br>";
    }
} else {
    echo "Súbor sa nepodarilo prečítať (Uzol 2).\n" . "<br>";
}

// Zatvorenie pripojenia
$remote_conn2->close();
?>
