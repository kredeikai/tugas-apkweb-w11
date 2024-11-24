<?php

/**
 * Model mahasiswa berfungsi untuk menjalankan query
 * Sebelum menggunakan query, load dulu library database
 */

namespace Models;
use Libraries\Database;

class Model_mhs
{
    public function __construct()
    {
        $db = new Database();
        $this->dbh = $db->getInstance();
    }

    function simpanData($nim, $nama)
    {
    // Cek apakah NIM sudah ada
    $cek = $this->dbh->prepare("SELECT COUNT(*) FROM mhs WHERE nim = ?");
    $cek->execute([$nim]);
    if ($cek->fetchColumn() > 0) {
        throw new Exception("NIM sudah ada dalam database.");
    }

    // Lanjutkan jika tidak ada duplikat
    $rs = $this->dbh->prepare("INSERT INTO mhs (nim, nama) VALUES (?, ?)");
    $rs->execute([$nim, $nama]);
    }


    function lihatData()
    {

        $rs = $this->dbh->query("SELECT * FROM mhs");
        return $rs;
    }

    function lihatDataDetail($id)
    {

        $rs = $this->dbh->prepare("SELECT * FROM mhs WHERE id=?");
        $rs->execute([$id]);
        return $rs->fetch();// kalau hasil query hanya satu, gunakan method fetch() bawaan PDO
    }
}