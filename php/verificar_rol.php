<?php
function verificarRol($rol_requerido) {
    // Verifica si el rol es el indicado para cada apartado
    if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != $rol_requerido) {
        echo '
            <script>
                window.location = "index.php";
            </script>
        ';
        exit();
    }
}
?>
