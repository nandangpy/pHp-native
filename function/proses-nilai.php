<?php
include '../config.php';
$csrf_token = $_POST['csrf_token'];

if ($_GET['act'] == 'insert') {

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $csrf_token) {
        die("CSRF token validation failed.");
    }

    $nama_matakuliah = $_POST['nama'];
    $sks = $_POST['sks'];
    $nilai_akhir = $_POST['nilai_akhir'];
    

    function calculateHuruf($nilai_akhir) {
        if ($nilai_akhir >= 80) {
            return 'A';
        } elseif ($nilai_akhir >= 75) {
            return 'B+';
        } elseif ($nilai_akhir >= 65) {
            return 'B';
        } elseif ($nilai_akhir >= 60) {
            return 'C+';
        } elseif ($nilai_akhir >= 55) {
            return 'C';
        } elseif ($nilai_akhir >= 40) {
            return 'D';
        } else {
            return 'E';
        }
    }

    function calculateBobot($huruf) {
        if ($huruf == 'A') {
            return '12';
        } elseif ($huruf == 'B+') {
            return '10.5';
        } elseif ($huruf == 'B') {
            return '9';
        } elseif ($huruf == 'C+') {
            return '7.5';
        } elseif ($huruf == 'C') {
            return '6';
        } elseif ($huruf == 'D') {
            return '3';
        } else {
            return '0';
        }
    }
    
    $huruf = calculateHuruf($nilai_akhir);
    $bobot = calculateBobot($huruf);

    $sql = "INSERT INTO matakuliah (nama_matakuliah, sks, nilai_akhir, grade, bobot) VALUES ('$nama_matakuliah', $sks, $nilai_akhir, '$huruf', '$bobot')";

    unset($_SESSION['csrf_token']);
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully.\n";
        header("location:../../");
    } else {
        echo "Error: " . $sql . "\n" . mysqli_error($conn);
    }

} 