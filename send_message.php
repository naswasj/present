<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Menentukan penerima email
    $to = "support@example.com";  // Ganti dengan email tujuan Anda
    $subject = "Pesan dari Contact Form";
    $body = "Nama: $name\nEmail: $email\nPesan: $message";

    // Mengirim email
    if (mail($to, $subject, $body)) {
        echo "Pesan Anda telah dikirim!";
    } else {
        echo "Terjadi kesalahan saat mengirim pesan.";
    }
}
?>
