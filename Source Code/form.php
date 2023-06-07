<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

include_once("model/Template.class.php");
include_once("model/DB.class.php");
include_once("model/Pasien.class.php");
include_once("model/TabelPasien.class.php");
include_once("view/FormPasien.php");


$tp = new FormPasienView();

if (isset($_POST['add'])) {
    $tp->addPasien($_POST);
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $tp->tampilUpdate($id); // nampilin form update
} else if (isset($_POST['update'])) {
    $tp->updatePasien($_POST);
} else {
    $data = $tp->tampil();
}