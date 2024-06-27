<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Provera da li je vreme između 15:00 i 20:00
    $chosen_datetime = $_POST['datetime'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $valid = false;

    $chosen_time = strtotime($chosen_datetime);
    $min_time = strtotime(date('Y-m-d') . ' 15:00');
    $max_time = strtotime(date('Y-m-d') . ' 20:00');

    if ($chosen_time >= $min_time && $chosen_time <= $max_time) {
        $valid = true;
    }

    if ($valid) {
        // Vaša email adresa na koju želite da stižu obaveštenja
        $to = "bojanakovacic1401@gmail.com";
        $subject = "Novi termin za zakazivanje";
        $message = "Korisnik je zakazao termin za:\n";
        $message .= "Datum i vreme: " . $chosen_datetime . "\n";
        $message .= "Broj telefona: " . $phone . "\n";
        $message .= "Email adresa: " . $email . "\n";

        $headers = "From: webmaster@vasadomena.com";

        // Slanje emaila
        if (mail($to, $subject, $message, $headers)) {
            echo "Uspešno ste zakazali termin. Bićete kontaktirani uskoro.";
        } else {
            echo "Došlo je do greške prilikom slanja vašeg zahteva.";
        }
    } else {
        echo "Nije moguće zakazati termin van radnog vremena (15:00 - 20:00). Molimo izaberite drugi termin.";
    }
}
?>
