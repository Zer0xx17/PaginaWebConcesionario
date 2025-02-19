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

        #contenedor-formulario {
            display: none; 
            position: absolute;
            top: 21%;
            right: 20px; 
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
            padding: 5px 10px;
        }
        #contenedor-formulario button:hover {
            background-color: #575757;
        }

        #formulario-edicion table {
            width: 100%;
            border-collapse: collapse;
        }
        #formulario-edicion td {
            padding: 10px;
            vertical-align: middle;
            font-size: 14px;
            color: #000;
            font-family: Arial, sans-serif;
        }
        #formulario-edicion td:first-child {
            width: 30%;
            font-weight: bold;
            text-align: right;
        }
        #formulario-edicion td:last-child {
            width: 70%;
            text-align: left;
        }
        #formulario-edicion input[type="text"],
        #formulario-edicion input[type="number"] {
            width: 95%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #333;
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

$nombreTabla = "usuarios";

$nombre = isset($_REQUEST['nombre']) ? trim($_REQUEST['nombre']) : '';
$dni = isset($_REQUEST['dni']) && !isset($_REQUEST['actualizar']) ? trim($_REQUEST['dni']) : '';

if (isset($_REQUEST['actualizar'])) {
    $id_usuario = (int)$_REQUEST['id_usuario'];

    $nuevoPassword = isset($_REQUEST['password']) ? trim($_REQUEST['password']) : '';
    $nuevoNombre = isset($_REQUEST['nombre']) ? trim($_REQUEST['nombre']) : '';
    $nuevosApellidos = isset($_REQUEST['apellidos']) ? trim($_REQUEST['apellidos']) : '';
    $nuevoDni = isset($_REQUEST['dni']) ? trim($_REQUEST['dni']) : '';
    $nuevoSaldo = isset($_REQUEST['saldo']) ? trim($_REQUEST['saldo']) : '';

    $camposActualizar = array();
    if (!empty($nuevoPassword)) {
        $camposActualizar[] = "password='" . mysqli_real_escape_string($conexion, $nuevoPassword) . "'";
    }
    if (!empty($nuevoNombre)) {
        $camposActualizar[] = "nombre='" . mysqli_real_escape_string($conexion, $nuevoNombre) . "'";
    }
    if (!empty($nuevosApellidos)) {
        $camposActualizar[] = "apellidos='" . mysqli_real_escape_string($conexion, $nuevosApellidos) . "'";
    }
    if (!empty($nuevoDni)) {
        $camposActualizar[] = "dni='" . mysqli_real_escape_string($conexion, $nuevoDni) . "'";
    }
    if (!empty($nuevoSaldo)) {
        $camposActualizar[] = "saldo='" . mysqli_real_escape_string($conexion, $nuevoSaldo) . "'";
    }

    if (!empty($camposActualizar)) {
        $updateQuery = "UPDATE $nombreTabla SET " . implode(", ", $camposActualizar) . " WHERE id_usuario = $id_usuario";
        mysqli_query($conexion, $updateQuery);
    }
}

$editar_id = isset($_REQUEST['editar_id']) ? (int)$_REQUEST['editar_id'] : 0;
$usuarioAEditar = null;
if ($editar_id > 0) {
    $queryEdicion = "SELECT * FROM $nombreTabla WHERE id_usuario=$editar_id";
    $resEdicion = mysqli_query($conexion, $queryEdicion);
    if ($resEdicion && mysqli_num_rows($resEdicion) > 0) {
        $usuarioAEditar = mysqli_fetch_assoc($resEdicion);
    }
}

$posTop = "270px";
$posLeft = "37%";

print ("<table style='position:absolute; top:$posTop; left:$posLeft; background-color:rgba(128, 128, 128, 0.7); border:2px solid black; border-radius:10px; width:500px; padding:20px;'>\n");
print ("<tr><td style='text-align:center; font-weight:bold; font-size:20px;'>Editar usuarios de la base de datos</td></tr>\n");
print("<tr><td style='vertical-align:top; padding-top:20px;'>\n");
print("<form method='post' action=''>");
print("<label for='nombre'>Nombre: </label>");
print("<input type='text' name='nombre' id='nombre' value='" . htmlspecialchars($nombre) . "' />");
print("<br><br>");
print("<label for='dni'>DNI: </label>");
print("<input type='text' name='dni' id='dni' value='" . htmlspecialchars($dni) . "' />");
print("<br><br>");
print("<input type='submit' name='mostrar' value='Mostrar' style='background-color:#333; color:white; border:none; padding:5px 10px; cursor:pointer;' />");
print("</form>");
print("</td></tr>\n");

print ("<tr><td style='vertical-align:top;'>\n");

if (isset($_REQUEST['mostrar']) || isset($_REQUEST['actualizar']) || $editar_id > 0) {
    $instruccion = "SELECT * FROM $nombreTabla WHERE 1=1 ";

    if (!empty($nombre)) {
        $instruccion .= "AND nombre LIKE '%" . mysqli_real_escape_string($conexion, $nombre) . "%' ";
    }
    if (!empty($dni)) {
        $instruccion .= "AND dni LIKE '%" . mysqli_real_escape_string($conexion, $dni) . "%' ";
    }

    $consulta = mysqli_query($conexion, $instruccion);

    if (!$consulta) {
        die("Fallo en la consulta: " . mysqli_error($conexion));
    }

    $nfilas = mysqli_num_rows($consulta);

    if ($nfilas > 0) {
        print ("<table style='background-color:#ccc; border-radius:10px; border-collapse: collapse; text-align:center; width:100%; margin-top:20px;'>\n");
        print ("<tr style='background-color: #dadff1;'>\n");
        print ("<th style='border:2px solid white; padding:5px;'>ID</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Password</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Nombre</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Apellidos</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>DNI</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Saldo</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Acciones</th>\n");
        print ("</tr>\n");

        while ($resultado = mysqli_fetch_array($consulta)) {
            $id = $resultado['id_usuario'];
            $res_password = $resultado['password'];
            $res_nombre = $resultado['nombre'];
            $res_apellidos = $resultado['apellidos'];
            $res_dni = $resultado['dni'];
            $res_saldo = $resultado['saldo'];

            print ("<tr>\n");
            print ("<td style='border:2px solid white; padding:5px;height:30px;'>$id</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_password</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_nombre</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_apellidos</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_dni</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_saldo</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'><a href='?editar_id=$id&nombre=".urlencode($nombre)."&dni=".urlencode($dni)."' style='background-color:#333; color:white; border:none; padding:5px 10px; text-decoration:none;'>Editar</a></td>\n");
            print ("</tr>\n");
        }
        print ("</table>\n");
        print("<br>");
    } else {
        print ("No hay usuarios disponibles con esos criterios.");
    }
}

print ("</td></tr>\n");
print ("</table>\n");

if ($usuarioAEditar) {
    ?>
    <div id="contenedor-formulario" style="display:block;">
        <form id="formulario-edicion" method="post" action="">
            <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $usuarioAEditar['id_usuario']; ?>">
            <table>
                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password" id="edit_password" value="<?php echo htmlspecialchars($usuarioAEditar['password']); ?>"></td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td><input type="text" name="nombre" id="edit_nombre" value="<?php echo htmlspecialchars($usuarioAEditar['nombre']); ?>"></td>
                </tr>
                <tr>
                    <td>Apellidos:</td>
                    <td><input type="text" name="apellidos" id="edit_apellidos" value="<?php echo htmlspecialchars($usuarioAEditar['apellidos']); ?>"></td>
                </tr>
                <tr>
                    <td>DNI:</td>
                    <td><input type="text" name="dni" id="edit_dni" value="<?php echo htmlspecialchars($usuarioAEditar['dni']); ?>"></td>
                </tr>
                <tr>
                    <td>Saldo:</td>
                    <td><input type="number" step="0.01" name="saldo" id="edit_saldo" value="<?php echo htmlspecialchars($usuarioAEditar['saldo']); ?>"></td>
                </tr>
            </table>
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="?" style="background-color:#333; color:white; padding:5px 10px; text-decoration:none;">Cerrar</a>
        </form>
    </div>
    <?php
}

mysqli_close($conexion);
?>

</body>
</html>
