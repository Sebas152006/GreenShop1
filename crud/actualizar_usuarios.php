<?php
if (isset($_POST['btnGuardar'])) {
    $id = $_POST['btnGuardar'];
    $id_rol = $_POST['id_rol'];
    $nombre_completo = $_POST['nombre_completo'];
    $correo_electronico = $_POST['correo_electronico'];
    $documento = $_POST['documento'];
    $contrasenia = $_POST['contrasenia']; // Lo que viene del formulario

    // Revisa si la contraseña se dejó vacía
    if (!empty($contrasenia)) {
        // Si el usuario ingresó algo nuevo, encripta la contraseña
        $contrasenia_encriptada = password_hash($contrasenia, PASSWORD_BCRYPT);
    } else {
        // Si el usuario no tocó la contraseña, toma la existente de la base de datos
        $query = "SELECT contrasenia FROM usuarios WHERE id = '$id'";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);
        $contrasenia_encriptada = $row['contrasenia'];
    }

    // Actualiza los demás datos del usuario
    $sql = "UPDATE usuarios SET 
                id_rol = '$id_rol', 
                nombre_completo = '$nombre_completo', 
                correo_electronico = '$correo_electronico', 
                documento = '$documento', 
                contrasenia = '$contrasenia_encriptada' 
            WHERE id = '$id'";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Usuario actualizado con éxito');</script>";
        header("Location: control_Usuarios.php");
        exit();
    } else {
        echo "<script>alert('Error al actualizar el usuario: " . mysqli_error($conexion) . "');</script>";
    }
}

?>