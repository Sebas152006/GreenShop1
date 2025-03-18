<?php

$hash = '$2y$10$z40mSPVe8TqI8/0uq6/sjuxLxnPUba8W9QrY/fkOVyPL5AWfYLLUi';
$contrasenia = '123';

if (password_verify($contrasenia, $hash)) {
    echo "La contraseña es válida.";
} else {
    echo "La contraseña no coincide.";
}

?>