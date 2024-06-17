<?php

    $hostname = "localhost";
    $userDataBase = "root";
    $passwordUser = "";
    $dataBaseName = "pwb";

    $koneksi = mysqli_connect($hostname,$userDataBase,$passwordUser,$dataBaseName) or die (mysqli_error());

    // if($koneksi){
    //     echo "berhasil koneksi";
    // } else echo "gagal koneksi";

?>