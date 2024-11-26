<?php
session_start();

// Cek apakah sudah login
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

require 'config.php'; // Pastikan ini terhubung dengan file config.php untuk koneksi database
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style2.css" />
    <title>Presensi Keterlambatan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <header>
      <h1>Presensi Keterlambatan Masuk Perkuliahan</h1>
      <button id="themeToggle">Toggle Tema</button>
      <nav>
        <a href="logout.php">Logout</a>
      </nav>
    </header>

    <main>
      <!-- Form Presensi -->
      <section>
        <h2>Form Presensi</h2>
        <form id="attendanceForm" method="POST" action="process_attendance.php">
          <label for="name">Nama Dosen:</label>
          <input type="text" id="name" name="name" required />
          <label for="studentId">ID Mahasiswa:</label>
          <input type="text" id="studentId" name="studentId" required />
          <label for="time">Waktu Masuk:</label>
          <input type="time" id="time" name="time" required />
          <button type="submit">Kirim Presensi</button>
        </form>
        <input
          type="text"
          id="searchInput"
          placeholder="Cari berdasarkan ID Mahasiswa..."
          onkeyup="searchAttendance()"
        />
      </section>

      <!-- Daftar Keterlambatan -->
      <section>
        <h2>Daftar Keterlambatan</h2>
        <table id="attendanceTable">
          <thead>
            <tr>
              <th>Nama Dosen</th>
              <th>ID Mahasiswa</th>
              <th>Waktu Masuk</th>
            </tr>
          </thead>
          <tbody>
            <!-- Data keterlambatan akan ditambahkan di sini -->
            <?php
            // Menarik data presensi dari database
            $sql = "SELECT * FROM attendance";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Menampilkan data presensi dalam tabel
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data presensi</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </section>

      <!-- Grafik Keterlambatan -->
      <section>
        <h2>Grafik Keterlambatan</h2>
        <canvas id="attendanceChart" width="400" height="200"></canvas>
      </section>
    </main>

    <script src="script2.js"></script>
  </body>
</html>
