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

// uzol 3
@$remote_conn3 = new mysqli($localhost3, $user3, $password3, $db3);

// Kontrola pripojenia k vzdialenej databáze
if ($remote_conn3->connect_error) {
    die("Nepodarilo sa pripojiť (Uzol 3): " . $remote_conn3->connect_error);
}

// Načítanie príkazov zo súboru
@$filename3 = 'failed3.txt';
if (file_exists($filename3) && is_readable($filename3)) {
    // Kontrola, či je súbor prázdny
    if (filesize($filename3) > 0) {
        $queries3 = file($filename3, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($queries3) {
            foreach ($queries3 as $query3) {
                // Odstráni koncový bodkočiarku pre konzistenciu
                $query3 = rtrim($query3, ";");
                // Vykonanie príkazu
                if ($remote_conn3->query($query3) === TRUE) {
                    echo "Úspech (Uzol 3): " . $query3 . "<br>";
                } else {
                    echo "Error (Uzol 3): " . $remote_conn3->error . "<br>";
                }
            }
            // Vymazanie obsahu súboru po úspešnej synchronizácii
            file_put_contents($filename3, '');
        }
    } else {
        echo "Súbor je prázdny (Uzol 3).\n" . "<br>";
    }
} else {
    echo "Súbor sa nepodarilo prečítať (Uzol 3).\n" . "<br>";
}

// Zatvorenie pripojenia
$remote_conn3->close();
?>
