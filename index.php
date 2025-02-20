<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú con Submenús</title>
    <link rel="icon" href="img-Internas/favicon.ico" type="image/x-icon">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background: url('img-Internas/fondoPagina.png') no-repeat center/cover;
        }
        nav {
            display: flex;
            align-items: center;
            background-color: #333;
            padding: 10px;
            position: relative;
        }
        nav img {
            margin-right: 20px;
        }
        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        nav li {
            position: relative;
        }
        nav a {
            display: block;
            padding: 20px;
            text-decoration: none;
            font-size: 20px;
            color: #20add8;
            font-family: "Verdana", sans-serif;
        }
        nav a:hover, nav ul li ul a:hover {
            background-color: #575757;
        }
        nav ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            min-width: 200px;
            background-color: #444;
        }
        nav li:hover > ul {
            display: block;
        }
        nav ul li ul a {
            color: #fff;
        }
        #contenedor-formulario {
            display: none;
            position: fixed;
            top: 21%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(128, 128, 128, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
        }
        #contenedor-formulario form, #contenedor-formulario button {
            margin-bottom: 10px;
            font-size: 16px;
        }
        #contenedor-formulario button {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        #contenedor-formulario button:hover {
            background-color: #575757;
        }

        /* Estilo del menú desplegable hacia la izquierda */
        .submenu-izquierda {
            display: none;
            position: absolute;
            top: 50%;
            left: -150px;
            transform: translateY(-50%);
            background-color: #444;
            min-width: 150px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .submenu-izquierda a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
        }
        .submenu-izquierda a:hover {
            background-color: #575757;
        }

        /* Mostrar el menú cuando el cursor está sobre la imagen */
        .contenedor-imagen {
            position: relative;
            display: inline-block;
        }
        .contenedor-imagen:hover .submenu-izquierda {
            display: block;
        }

    </style>
</head>
<body>

<nav>
    <img src="img-Internas/logo.png" alt="Logo" height="100px">
    <ul>
        <li>
            <a href="#">COCHES</a>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="submenus/coches/AñadirCoches.php">Añadir</a></li>
                <li><a href="submenus/coches/ListarCoches.php">Listar</a></li>
                <li><a href="submenus/coches/BuscarCoches.php">Buscar</a></li>
                <li><a href="submenus/coches/ModificarCoches.php">Modificar</a></li>
                <li><a href="submenus/coches/BorrarCoches.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">USUARIOS</a>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="submenus/usuarios/AñadirUsuarios.php">Añadir</a></li>
                <li><a href="submenus/usuarios/ListarUsuarios.php">Listar</a></li>
                <li><a href="submenus/usuarios/BuscarUsuarios.php">Buscar</a></li>
                <li><a href="submenus/usuarios/ModificarUsuarios.php">Modificar</a></li>
                <li><a href="submenus/usuarios/BorrarUsuarios.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">ALQUILERES</a>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="?opcion=Listar">Listar</a></li>
                <li><a href="?opcion=Borrar">Borrar</a></li>
            </ul>
        </li>
    </ul>

    <!-- Imagen de inicio de sesión con menú desplegable a la izquierda -->
    <div class="contenedor-imagen" style="margin-left: auto;">
        <a href="subMenus/LoginRegister/Login.php">
            <img src="img-Internas/InicioSesion.png" alt="Inicio Sesión" height="60px">
        </a>
        <div class="submenu-izquierda">
        <a href="subMenus/LoginRegister/Login.php?dato=InicioSesion">Iniciar Sesión</a>
            <a href="subMenus/LoginRegister/Login.php?dato=Registro">Registrarse</a>
        </div>
    </div>
</nav>

<div id="contenedor-formulario">
    <form id="formulario-dinamico"></form>
    <button onclick="ocultarFormulario()">Cerrar</button>
</div>

<script>
    function mostrarFormulario(opcion) {
        document.getElementById('contenedor-formulario').style.display = 'block';
    }
    function ocultarFormulario() {
        document.getElementById('contenedor-formulario').style.display = 'none';
    }
</script>

</body>
</html>
