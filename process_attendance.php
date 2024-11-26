<?php
session_start();
require 'config.php';

// Cek apakah data sudah dikirimkan dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $studentId = $_POST['studentId'];
    $time = $_POST['time'];

    // Masukkan data presensi ke database
    $sql = "INSERT INTO attendance (name, student_id, time) VALUES ('$name', '$studentId', '$time')";
    if ($conn->query($sql) === TRUE) {
        header("Location: main.php"); // Redirect ke halaman utama setelah data berhasil disimpan
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
