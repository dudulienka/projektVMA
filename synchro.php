<?php
include("config.php");
include("config2.php"); 
include("config3.php"); 


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
