<?php include("config.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <title>p2B</title>
</head>

<body>

    <header>
        <h3>PHP Test</h3>
    </header>

    <nav>
        <a href="form/create-nilai.php">[+] Masukan Nilai Baru</a>
    </nav>
    <br>
    <table border="1">
        <thead>
            <h1><b>Nilai:</b></h1>
            <tr>
                <th>Nama Matakuliah</th>
                <th>SKS</th>
                <th>Nilai Akhir</th>
                <th>Huruf</th>
                <th>Bobot</th>

            </tr>
        </thead>


        <tbody>
            <?php
            $sql = "SELECT * FROM matakuliah";
            $query = mysqli_query($conn, $sql);
            $no = 1;

            // echo var_dump($query);
            while ($linilai = mysqli_fetch_array($query)) {

                echo "<tr>";
                echo "<td>" . $linilai['nama_matakuliah'] . "</td>";
                echo "<td>" . $linilai['sks'] . "</td>";
                echo "<td>" . $linilai['nilai_akhir'] . "</td>";
                echo "<td>" . $linilai['grade'] . "</td>";
                echo "<td>" . $linilai['bobot'] . "</td>";
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <p>Jumlah Matakuliah: <?php echo mysqli_num_rows($query) ?></p>
    
    <?php
    if (mysqli_num_rows($query) == 0) {
        echo "<p style='color:red;'> Belum Ada Nilai Yang Di Input </p>";


    } else {
        $sqls = "SELECT SUM(sks) as total_sks FROM matakuliah";
        $tsks = mysqli_query($conn, $sqls);
        $sks = mysqli_fetch_assoc($tsks);
        
        // var_dump($sks['total_sks']);
        $sqlb = "SELECT SUM(bobot) as total_bobot FROM matakuliah";
        $tbobot = mysqli_query($conn, $sqlb);
        $bobot = mysqli_fetch_assoc($tbobot);
        echo "<p> Jumlah SKS: " . $sks['total_sks'] . "</p>";
        echo "<p> Jumlah Bobot: " . $bobot['total_bobot'] . "</p>";
        echo "<h4> IPK Anda: " . round($bobot['total_bobot'] / $sks['total_sks'] , 2) . "</h4>";
        echo "<h4> Semoga Menang </h4>";
    }
    
    ?>
    
    <!-- <button onclick="goBack()">Kembali</button> -->

</body>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>