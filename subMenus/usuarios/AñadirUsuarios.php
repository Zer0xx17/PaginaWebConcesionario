<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú con Submenús</title>
    <link rel="icon" href="../../img-Internas/favicon.ico" type="image/x-icon">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background: url('../../img-Internas/fondoPaginaVacio.png') no-repeat center/cover;
        }
        nav {
            display: flex;
            align-items: center;
            background-color: #333;
        }
        nav img {
            height: 100px;
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

        .contenedor-formulario {
            position: absolute;
            top: 270px; 
            left: 37%;  
            background-color: rgba(128, 128, 128, 0.7);
            border: 2px solid black;
            border-radius: 10px;
            width: 500px;
            padding: 20px;
        }

        .formulario-tabla {
            width: 100%;
            border-collapse: collapse;
        }

        .formulario-tabla td {
            padding: 10px;
            vertical-align: middle;
            font-size: 16px;
            color: #000;
            font-family: Arial, sans-serif;
        }

        .formulario-tabla td:first-child {
            width: 30%;
            font-weight: bold;
            text-align: right;
        }

        .formulario-tabla td:last-child {
            width: 70%;
            text-align: left;
        }

        .formulario-tabla input[type="text"],
        .formulario-tabla input[type="number"],
        .formulario-tabla input[type="password"] {
            width: 95%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #333;
        }

        .botones {
            text-align: center;
            margin-top: 10px;
        }

        .botones button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin: 0 5px;
        }

        .botones button:hover {
            background-color: #575757;
        }

        #mensaje-confirmacion {
            text-align: center;
            margin-top: 10px;
            color: green;
            font-weight: bold;
        }

        #mensaje-error {
            text-align: center;
            margin-top: 10px;
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav>
    <img src="../../img-Internas/logo.png" alt="Logo">
    <ul>
        <li>
            <a href="#">COCHES</a>
            <ul>
                <li><a href="../../index.php">Inicio</a></li>
                <li><a href="../coches/AñadirCoches.php">Añadir</a></li>
                <li><a href="../coches/ListarCoches.php">Listar</a></li>
                <li><a href="../coches/BuscarCoches.php">Buscar</a></li>
                <li><a href="../coches/ModificarCoches.php">Modificar</a></li>
                <li><a href="../coches/BorrarCoches.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">USUARIOS</a>
            <ul>
                <li><a href="../../index.php">Inicio</a></li>
                <li><a href="AñadirUsuarios.php">Añadir</a></li>
                <li><a href="ListarUsuarios.php">Listar</a></li>
                <li><a href="BuscarUsuarios.php">Buscar</a></li>
                <li><a href="ModificarUsuarios.php">Modificar</a></li>
                <li><a href="BorrarUsuarios.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">ALQUILERES</a>
            <ul>
                <li><a href="../../index.php">Inicio</a></li>
                <li><a href="../alquileres/ListarAlquiler.php">Listar</a></li>
                <li><a href="../alquileres/BorrarAlquiler.php">Borrar</a></li>
            </ul>
        </li>
    </ul>
</nav>

<?php
$conexion = mysqli_connect("localhost", "root", "rootroot");
if (!$conexion) {
    die("Error al conectar con el servidor: " . mysqli_connect_error());
}

if (!mysqli_select_db($conexion, "concesionario")) {
    die("No se puede seleccionar la base de datos: " . mysqli_error($conexion));
}

$mensajeConfirmacion = "";
$mensajeError = "";

if (isset($_REQUEST['anadir'])) {
    $password = isset($_REQUEST['password']) ? trim($_REQUEST['password']) : '';
    $nombre = isset($_REQUEST['nombre']) ? trim($_REQUEST['nombre']) : '';
    $apellidos = isset($_REQUEST['apellidos']) ? trim($_REQUEST['apellidos']) : '';
    $dni = isset($_REQUEST['dni']) ? trim($_REQUEST['dni']) : '';
    $saldo = isset($_REQUEST['saldo']) ? trim($_REQUEST['saldo']) : '';

    if (!empty($password) && !empty($nombre) && !empty($apellidos) && !empty($dni) && $saldo !== '') {
        $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (password, nombre, apellidos, dni, saldo) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssd", $password, $nombre, $apellidos, $dni, $saldo);

        if (mysqli_stmt_execute($stmt)) {
            $mensajeConfirmacion = "Usuario añadido exitosamente.";
        } else {
            $mensajeError = "Error al añadir el usuario: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        $mensajeError = "Por favor, rellena todos los campos.";
    }
}

mysqli_close($conexion);
?>

<div class="contenedor-formulario">
    <form method="post" action="">
        <table class="formulario-tabla">
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" name="nombre" required></td>
            </tr>
            <tr>
                <td>Apellidos:</td>
                <td><input type="text" name="apellidos" required></td>
            </tr>
            <tr>
                <td>DNI:</td>
                <td><input type="text" name="dni" maxlength="9" required></td>
            </tr>
            <tr>
                <td>Saldo:</td>
                <td><input type="number" step="0.01" name="saldo" required></td>
            </tr>
        </table>

        <div class="botones">
            <button type="submit" name="anadir">Añadir</button>
        </div>
    </form>

    <?php if(!empty($mensajeConfirmacion)) { ?>
        <div id="mensaje-confirmacion"><?php echo $mensajeConfirmacion; ?></div>
    <?php } ?>

    <?php if(!empty($mensajeError)) { ?>
        <div id="mensaje-error"><?php echo $mensajeError; ?></div>
    <?php } ?>
</div>

</body>
</html>
