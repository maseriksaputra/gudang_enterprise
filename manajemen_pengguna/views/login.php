<?php
require 'config/db.php'; // koneksi DB
require 'lib/functions.php'; // fungsi hash/verify (jika kamu simpan di sini)

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT u.*, r.name AS role FROM users u JOIN roles r ON u.role_id = r.id WHERE u.username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            if ($user['role'] === 'admin') {
                // ✅ Jika admin: redirect ke UI utama (ubah URL sesuai alamat frontend Mahasiswa 1)
                header("Location: http://192.168.1.1/ui/index.html");
                exit;
            } else {
                $message = "Hanya admin yang dapat login.";
            }
        } else {
            $message = "Password salah.";
        }
    } else {
        $message = "User tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin - SIMDB</title>
    <style>
        body {
            font-family: Arial;
            background-color: #eafaf1;
            padding: 50px;
        }
        .container {
            background-color: #d4edda;
            padding: 20px;
            width: 350px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #a3d4af;
        }
        input {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
        }
        button {
            background-color: #218838;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            cursor: pointer;
            width: 100%;
        }
        .message {
            margin-top: 10px;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Admin</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
