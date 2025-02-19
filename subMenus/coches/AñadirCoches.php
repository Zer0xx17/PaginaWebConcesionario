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
        .formulario-tabla input[type="number"] {
            width: 95%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #333;
        }

        .formulario-tabla input[type="file"] {
            border: none;
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
                <li><a href="AñadirCoches.php">Añadir</a></li>
                <li><a href="ListarCoches.php">Listar</a></li>
                <li><a href="BuscarCoches.php">Buscar</a></li>
                <li><a href="ModificarCoches.php">Modificar</a></li>
                <li><a href="BorrarCoches.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">USUARIOS</a>
            <ul>
                <li><a href="../../index.php">Inicio</a></li>
                <li><a href="../usuarios/AñadirUsuarios.php">Añadir</a></li>
                <li><a href="../usuarios/ListarUsuarios.php">Listar</a></li>
                <li><a href="../usuarios/BuscarUsuarios.php">Buscar</a></li>
                <li><a href="../usuarios/ModificarUsuarios.php">Modificar</a></li>
                <li><a href="../usuarios/BorrarUsuarios.php">Borrar</a></li>
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
    $modelo = isset($_REQUEST['modelo']) ? trim($_REQUEST['modelo']) : '';
    $marca = isset($_REQUEST['marca']) ? trim($_REQUEST['marca']) : '';
    $color = isset($_REQUEST['color']) ? trim($_REQUEST['color']) : '';
    $precio = isset($_REQUEST['precio']) ? trim($_REQUEST['precio']) : '';
    $alquilado = isset($_REQUEST['alquilado']) ? 1 : 0;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $dir_fotos = 'fotos';
        if (!is_dir($dir_fotos)) {
            mkdir($dir_fotos, 777, true);
        }

        $nombreFoto = basename($_FILES['foto']['name']);
        $rutaDestino = $dir_fotos . '/' . $nombreFoto;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            $foto = $rutaDestino;
        } else {
            $foto = "";
        }
    } else {
        $foto = "";
    }

    if (!empty($modelo) && !empty($marca) && !empty($color) && !empty($precio) && !empty($foto)) {
        $stmt = mysqli_prepare($conexion, "INSERT INTO coches (modelo, marca, color, precio, alquilado, foto) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssdis", $modelo, $marca, $color, $precio, $alquilado, $foto);

        if (mysqli_stmt_execute($stmt)) {
            $mensajeConfirmacion = "Coche añadido exitosamente.";
        } else {
            $mensajeError = "Error al añadir el coche: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        $mensajeError = "Por favor, rellena todos los campos requeridos y selecciona una foto.";
    }
}

mysqli_close($conexion);
?>

<div class="contenedor-formulario">
    <form method="post" action="" enctype="multipart/form-data">
        <table class="formulario-tabla">
            <tr>
                <td>Modelo:</td>
                <td><input type="text" name="modelo" required></td>
            </tr>
            <tr>
                <td>Marca:</td>
                <td><input type="text" name="marca" required></td>
            </tr>
            <tr>
                <td>Color:</td>
                <td><input type="text" name="color" required></td>
            </tr>
            <tr>
                <td>Precio:</td>
                <td><input type="number" step="0.01" name="precio" required></td>
            </tr>
            <tr>
                <td>Alquilado:</td>
                <td><input type="checkbox" name="alquilado" value="1"></td>
            </tr>
            <tr>
                <td>Foto:</td>
                <td><input type="file" name="foto" accept="image/*" required></td>
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
