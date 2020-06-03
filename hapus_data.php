<?php 
    session_start();
    include 'koneksi.php';

    $id = $_POST['id'];

    $query = "DELETE FROM tbl_siswa WHERE id=?";
    $prepare1 = $db1->prepare($query);
    $prepare1->bind_param("i", $id);
    $prepare1->execute();

    echo json_encode(['success' => "Sukses"]);
    $db->close();
?>