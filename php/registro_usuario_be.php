<?php
    // Importamos la conexión a la base de datos
    include 'conexion_be.php';

    // Variables que guardan los datos del formulario
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $numero_id = $_POST['numero_id'];
    $contrasenia = $_POST['contrasenia'];

    // Encripta la contraseña usando bcrypt
    $contrasenia_encriptada = password_hash($contrasenia, PASSWORD_BCRYPT);

    // Verifica que la variable encriptada se esté utilizando en la consulta
    $query = "INSERT INTO usuarios(nombre_completo, correo_electronico, documento, contrasenia) 
              VALUES('$nombre_completo','$correo','$numero_id','$contrasenia_encriptada')";

    // Verifica que el correo electrónico no se repita en la base de datos
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo_electronico = '$correo'");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("El correo electrónico ingresado ya se encuentra registrado, intenta con un correo diferente o comunícate con el soporte técnico.");
                window.location = "../index.php";
            </script>
        ';

        // Cierra la conexión
        mysqli_close($conexion);
        exit();
    }

    // Verifica que el número de identificación no se repita en la base de datos
    $verificar_numero_id = mysqli_query($conexion, "SELECT * FROM usuarios WHERE documento = '$numero_id'");

    if(mysqli_num_rows($verificar_numero_id) > 0){
        echo '
            <script>
                alert("El número de documento ingresado ya se encuentra registrado, intenta con un número de documento diferente o comunícate con el soporte técnico.");
                window.location = "../index.php";
            </script>
        ';

        // Cierra la conexión
        mysqli_close($conexion);
        exit();
    }
    
    // Ingresa un usuario en la base de datos
    $ejecutar = mysqli_query($conexion, $query);

    // Verifica si la inserción fue exitosa
    if($ejecutar){
        echo '
            <script>
                alert("Usuario Registrado Exitosamente");
                window.location = "../index.php";
            </script>
        ';
    } else{
        echo '
            <script>
                alert("Registro Fallido, Inténtalo Nuevamente");
                window.location = "../index.php";
            </script>
        ';
    }
    
    // Cierra la conexión
    mysqli_close($conexion);
?>
