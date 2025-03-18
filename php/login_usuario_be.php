<?php
    session_start();

    include 'conexion_be.php';

    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];

    // Consultamos el usuario en la base de datos
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo_electronico = '$correo'");

    if(mysqli_num_rows($validar_login) > 0){
        $usuario = mysqli_fetch_assoc($validar_login);

        // Verificamos la contraseña encriptada
        if(password_verify($contrasenia, $usuario['contrasenia'])){
            // Inicia Sesión
            $_SESSION['id_rol'] = $usuario['id_rol'];
            $_SESSION['usuario'] = $correo;

            if($_SESSION['id_rol'] == 1){
                header("location: ../tienda.php");
            } elseif($_SESSION['id_rol'] == 2){
                header("location: ../crud/admin.php");
            }    
            exit();
        } else {
            echo '
                <script>
                    alert("Correo Electrónico O Contraseña Incorrectos, Intente De Nuevo");
                    window.location = "../index.php";
                </script>
            ';
            exit();
        }
    } else {
        echo '
        <script>
            alert("Correo Electrónico O Contraseña Incorrectos, Intente De Nuevo");
            window.location = "../index.php";
        </script>
        ';
        exit();
    }

?>