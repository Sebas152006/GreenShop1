<?php
session_start();
include 'conexion_be.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$query = "SELECT id FROM usuarios WHERE correo_electronico = '$usuario'";
$result = mysqli_query($conexion, $query);
$datos = mysqli_fetch_assoc($result);
$id_usuario = $datos['id'];

$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$departamento = $_POST['departamento'];
$pais = $_POST['pais'];
$codigo_postal = $_POST['codigo_postal'];
$telefono_contacto = $_POST['telefono_contacto'];

$insertar = "INSERT INTO direcciones (usuario_id, direccion, ciudad, departamento, pais, codigo_postal, telefono_contacto)
VALUES ('$id_usuario', '$direccion', '$ciudad', '$departamento', '$pais', '$codigo_postal', '$telefono_contacto')";

mysqli_query($conexion, $insertar);

header("Location: ../perfil.php");
exit;
?>
