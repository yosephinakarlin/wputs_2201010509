<!DOCTYPE html>
<html>
<head>
     
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.mm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Aplikasi Pengelolaan Data Mahasiswa</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Aplikasi Pengelolaan Data Mahasiswa</h1>
    <form method="POST" action="">
        <div class="form-floating mb-3">
        <input type="text" name="nama"  class="form-control" id="FloatingInput" placeholder="Nama Lengkap">
        <label for="floatingInput">Nama Lengkap</label>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="nim" class="form-control" id="FloatingInput" placeholder="Nama Lengkap">
        <label for="floatingInput">Nim</label>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="jurusan" class="form-control" id="FloatingInput" placeholder="Nama Lengkap">
        <label for="floatingInput">Jurusan</label>
        </div>
        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
    </form>

    <?php
   
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'dbms_project';

    $conn = mysqli_connect($host, $username, $password, $database);

  
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    
    $query = "CREATE TABLE IF NOT EXISTS data (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(50),
        nim VARCHAR(20),
        jurusan VARCHAR(100)
    )";
    mysqli_query($conn, $query);


    function insertData($nama, $nim, $jurusan) {
        global $conn;
        $query = "INSERT INTO data (nama, nim, jurusan) VALUES ('$nama', '$nim', '$jurusan')";
        mysqli_query($conn, $query);
    }

    
    function viewData() {
        global $conn;
        $query = "SELECT * FROM data";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Data yang tersimpan:</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nama</th><th>Nim</th><th>Jurusan</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['nim'] . "</td>";
                echo "<td>" . $row['jurusan'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Tidak ada data yang tersimpan.</p>";
        }
    }

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];

        insertData($nama, $nim, $jurusan);

        header("Location: index.php");
    }


    viewData();

    mysqli_close($conn);
    ?>
</body>
</html>
