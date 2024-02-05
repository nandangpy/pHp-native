<?php
include("../config.php");

session_start();
function generateCSRFToken() {
    return bin2hex(random_bytes(32));
}
$_SESSION['csrf_token'] = generateCSRFToken();
$csrf_token = $_SESSION['csrf_token'];

// var_dump($csrf_token);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Input Nilai Baru</title>
</head>

<body>
    <header>
        <h3>Form Penilaian</h3>
    </header>

    <form action="../function/proses-nilai.php?act=insert" method="POST">
        <fieldset>
            <p>
                <label for="nama">Nama Matakuliah: </label>
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <input type="text" name="nama" placeholder="nama matakuliah" autocomplete="off"/>
            </p>

            <p>
                <label for="sks">SKS: </label>
                <input type="number" min="1" name="sks" placeholder="contoh: 3" autocomplete="off" />
            </p>

            <p>
                <label for="nilai_akhir">Nilai Akhir: </label>
                <input type="number" min="1" name="nilai_akhir" placeholder="contoh: 98" autocomplete="off" />
            </p>
            <p>
                <button onclick="goBack()">Kembali</button>
                <input type="submit" value="Simpan" name="simpan" />
            </p>

        </fieldset>

    </form>

</body>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>