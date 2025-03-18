<?php
    // Inicia sesion o reanuda una sesion iniciada
    session_start();
    include '../php/verificar_rol.php';

    // Si no hay ninguna sesion iniciada, redirige al usuario al menu inicio de sesion
    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
            alert("Por Favor, Debes Iniciar Sesión");
            window.location = "index.php";
            </script>
        ';
        session_destroy();
        die();
    }

    // Verifica si el rol es de un administrador
    verificarRol(2);

    include '../php/conexion_be.php'; // Conexión a la base de datos

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        // Procesar la imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen']['tmp_name'];

            // Leer y comprimir la imagen
            $origen = imagecreatefromstring(file_get_contents($imagen));
            ob_start();
            imagejpeg($origen, null, 75); // Comprime la imagen al 75% de calidad
            $imagenComprimida = ob_get_clean();

            // Codifica la imagen en Base64 para almacenarla
            $imagenBase64 = base64_encode($imagenComprimida);

            // Guardar los datos en la base de datos
            $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_bind_param($stmt, "ssds", $nombre, $descripcion, $precio, $imagenBase64);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Producto agregado con éxito'); window.location='agregar_Productos.php';</script>";
            } else {
                echo "<script>alert('Error al guardar el producto');</script>";
            }
        } else {
            echo "<script>alert('Error al cargar la imagen');</script>";
        }
    }
?>
