document
  .getElementById("attendanceForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const name = document.getElementById("name").value;
    const studentId = document.getElementById("studentId").value;
    const time = document.getElementById("time").value;

    if (name === "" || studentId === "" || time === "") {
      alert("Semua field harus diisi!");
      return;
    }

    addAttendanceToTable(name, studentId, time);
    this.reset(); // Reset form setelah submit
  });

function addAttendanceToTable(name, studentId, time) {
  const tableBody = document.querySelector("#attendanceTable tbody");
  const newRow = document.createElement("tr");
  newRow.innerHTML = `<td>${name}</td><td>${studentId}</td><td>${time}</td>`;
  tableBody.appendChild(newRow);
  updateChart(); // Update grafik setelah menambahkan data
}

function searchAttendance() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const rows = document.querySelectorAll("#attendanceTable tbody tr");

  rows.forEach((row) => {
    const studentId = row.cells[1].textContent.toLowerCase();
    if (studentId.includes(input)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

document.getElementById("themeToggle").addEventListener("click", function () {
  document.body.classList.toggle("dark-theme");
});

// Inisialisasi grafik
const ctx = document.getElementById("attendanceChart").getContext("2d");
const attendanceChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Keterlambatan 1", "Keterlambatan 2", "Keterlambatan 3"], // Ganti dengan data yang sesuai
    datasets: [
      {
        label: "Jumlah Keterlambatan",
        data: [0, 0, 0], // Ganti dengan data yang sesuai
        backgroundColor: "rgba(75, 192, 192, 0.2)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

// Fungsi untuk memperbarui grafik
function updateChart() {
  // Logika untuk memperbarui data grafik berdasarkan entri yang ada di tabel
  // Ini bisa disesuaikan dengan cara Anda ingin menghitung keterlambatan
  // Misalnya, menghitung jumlah keterlambatan berdasarkan ID mahasiswa
  // Anda bisa memperbarui data di sini
}
