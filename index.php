<?php
session_start();
require 'config.php';

// Cek jika sudah login
if (isset($_SESSION['user'])) {
    header("Location: main.php");
    exit();
}

// Logika untuk registrasi dan login
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Proses Registrasi
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['user'] = $email;
            header("Location: main.php");
            exit();
        } else {
            $error = "Gagal mendaftarkan pengguna: " . $conn->error;
        }
    } elseif (isset($_POST['login'])) {
        // Proses Login
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $email;
                header("Location: main.php");
                exit();
            } else {
                $error = "Password salah";
            }
        } else {
            $error = "Email tidak ditemukan";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website with Login & Register</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="css/all.min.css" />
</head>
<body>
    <header>
        <h2 class="logo">
            <img src="gambar.png" alt="Image Description" class="logo-img" />
        </h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
            <button class="popup-login">Login</button>
        </nav>
    </header>

    <div class="wrapper">
        <span class="close"><i class="fa-solid fa-xmark"></i></span>

        <!-- Login Form -->
        <div class="form-box login">
            <h2>Login</h2>
            <form action="index.php" method="post">
                <div class="form-input">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" required />
                    <label>Email</label>
                </div>
                <div class="form-input">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required />
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember" /> Remember me</label>
                    <a href="#">Forgot Password</a>
                </div>
                <button type="submit" class="btn" name="login">Login</button>
                <div class="login-register">
                    <p>
                        Don't have an account?
                        <a href="#" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div class="form-box register">
            <h2>Register</h2>
            <form action="index.php" method="post">
                <div class="form-input">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" required />
                    <label>Email</label>
                </div>
                <div class="form-input">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" required />
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" required /> I agree to the terms & conditions</label>
                </div>
                <button type="submit" class="btn" name="register">Register</button>
                <div class="login-register">
                    <p>
                        Already have an account?
                        <a href="#" class="login-link">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Error Notification -->
    <?php if ($error): ?>
        <div style="color: red; text-align: center; margin-top: 20px;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <script type="text/javascript">
        const wrapper = document.querySelector('.wrapper');
        const loginLink = document.querySelector('.login-link');
        const registerLink = document.querySelector('.register-link');
        const btnPopup = document.querySelector('.popup-login');
        const iconClose = document.querySelector('.close');

        registerLink.addEventListener('click', () => {
            wrapper.classList.add('active');
        });
        loginLink.addEventListener('click', () => {
            wrapper.classList.remove('active');
        });
        btnPopup.addEventListener('click', () => {
            wrapper.classList.add('active-popup');
        });
        iconClose.addEventListener('click', () => {
            wrapper.classList.remove('active-popup');
        });
    </script>
</body>
</html>
