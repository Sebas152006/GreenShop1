<?php
    // Inicia sesion o reanuda una sesion iniciada
    session_start();
    include 'php/verificar_rol.php';

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
    
    // Verifica si el rol es de un cliente
    verificarRol(1)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style4.css">
    <!--Importamos la fuente Lato-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>GreenShop</title>
    <link rel="icon" href="images/1.png">
</head>
<header>
    <!-- Imagen del logo en la esquina superior izquierda -->
    <a href="tienda.html" class="logo">
        <img src="images/Logo.png" alt="GreenShop Logo">
    </a>

    <a href="php/cerrar_sesion.php">Cerrar Sesión</a>

    <!--Imagen delc arrito de compras-->
    <a href="index.html" class="carrito">
        <img src="images/Carrito.png" alt="Carrito de Compras">
        <span id="contador-carrito" class="carrito-unidades">0</span>
    </a>
</header>

<body>
    <section class="container">
        <!--Primer producto-->
        <article>
            <div>
                <div class="imagen">
                    <img src="images/inventary/Bicicleta.png" class="Bicicleta" alt="Bicicleta GW">
                </div>
                <div class="precio">
                    <p>COP 1'200.000</p>
                </div>
            </div>
        
            <div class="contenido">
                <h2>Bicicleta GW</h2>
                <div class="recuadro">
                    <h3>Descripción</h3>
                    <p>
                        Descubre la bicicleta de doble suspensión marca GW, diseñada para los amantes 
                        de la adrenalina. Con su resistente cuadro y suspensiones suaves, conquista 
                        cualquier terreno con estilo y comodidad.
                    </p>

                    <!--Botones de los productos-->
                    <div class="botones">
                        
                        <!--Botones para cambiar cantidad de productos-->
                        <button onclick="disminuir(this)" class="cantidad-control">-</button>

                        <input class="unidades" type="number" value="1" min="1">

                        <button onclick="incrementar(this)" class="cantidad-control">+</button>
                        
                        <!--Boton que se encarga de añadir los productos al carrito-->
                        <button class="agregar">AGREGAR AL CARRITO</button>
                    </div>
                </div>
            </div>
        </article>

        <!--Segundo Producto-->
        <article>
            <div>
                <div class="imagen">
                    <img src="images/inventary/Iphone.png" class="Iphone" alt="Iphone 15 Pro Max">
                </div>
                <div class="precio">
                    <p>COP 5'300.000</p>
                </div>
            </div>
        
            <div class="contenido">
                <h2>Iphone 15 Pro Max</h2>
                <div class="recuadro">
                    <h3>Descripción</h3>
                    <p>
                        iPhone 15 Pro Max Se pasa de Pro. Una manera mágica de interactuar con tu iPhone. 
                        <br><br> Consíguelo Próximamente sin intereses.
                    </p>

                    <!--Botones de los productos-->
                    <div class="botones">
                        
                        <!--Botones para cambiar cantidad de productos-->
                        <button onclick="disminuir(this)" class="cantidad-control">-</button>

                        <input class="unidades" type="number" value="1" min="1">

                        <button onclick="incrementar(this)" class="cantidad-control">+</button>
                        
                        <!--Boton que se encarga de añadir los productos al carrito-->
                        <button class="agregar">AGREGAR AL CARRITO</button>
                    </div>
                </div>
            </div>
        </article>

        <!--Tercer producto-->
        <article>
            <div>
                <div class="imagen">
                    <img src="images/inventary/Audifonos.png" class="Audifonos" alt="JBL Tune 770NC">
                </div>
                <div class="precio">
                    <p>COP 460.000</p>
                </div>
            </div>
        
            <div class="contenido">
                <h2>JBL Tune 770NC</h2>
                <div class="recuadro">
                    <h3>Descripción</h3>
                    <p>
                        Cuando tu música está encendida, nada más importa. 
                        Los auriculares inalámbricos JBL Tune 770NC con cancelación de ruido adaptativa 
                        cumplen esa promesa durante todo el día y más, al tiempo que te evitan los ruidos no deseados.
                    </p>

                   <!--Botones de los productos-->
                   <div class="botones">
                        
                    <!--Botones para cambiar cantidad de productos-->
                    <button onclick="disminuir(this)" class="cantidad-control">-</button>

                    <input class="unidades" type="number" value="1" min="1">

                    <button onclick="incrementar(this)" class="cantidad-control">+</button>
                    
                    <!--Boton que se encarga de añadir los productos al carrito-->
                    <button class="agregar">AGREGAR AL CARRITO</button>
                </div>
                </div>
            </div>
        </article>
    </section>

    <a href="https://web.whatsapp.com/" class="logo-Whatsapp">
        <img src="images/WhatsApp.png" alt="Servicio al Cliente">
    </a>

    <script src="js/script3.js"></script>
</body>

<footer>
    <!--Formulario para notificaciones de ofertas-->
    <div class="formulario">
        <p>Suscríbete para obtener información de nuestros descuentos</p>
        <form>
            <input type="email" placeholder="Escribe tu correo electrónico" required>
        </form>
    </div>
</footer>
</html>