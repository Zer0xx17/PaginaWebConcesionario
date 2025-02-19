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

$nombreTabla = "coches";

$marca = isset($_REQUEST['marca']) ? trim($_REQUEST['marca']) : '';
$modelo = isset($_REQUEST['modelo']) && !isset($_REQUEST['actualizar']) ? trim($_REQUEST['modelo']) : '';

if (isset($_REQUEST['actualizar'])) {
    $id_coche = (int)$_REQUEST['id_coche'];

    $nuevoModelo = isset($_REQUEST['modelo']) ? trim($_REQUEST['modelo']) : '';
    $nuevaMarca = isset($_REQUEST['marca']) ? trim($_REQUEST['marca']) : '';
    $nuevoColor = isset($_REQUEST['color']) ? trim($_REQUEST['color']) : '';
    $nuevoPrecio = isset($_REQUEST['precio']) ? trim($_REQUEST['precio']) : '';
    $nuevoAlquilado = isset($_REQUEST['alquilado']) ? 1 : 0;

    $camposActualizar = array();
    if (!empty($nuevoModelo)) {
        $camposActualizar[] = "modelo='" . mysqli_real_escape_string($conexion, $nuevoModelo) . "'";
    }
    if (!empty($nuevaMarca)) {
        $camposActualizar[] = "marca='" . mysqli_real_escape_string($conexion, $nuevaMarca) . "'";
    }
    if (!empty($nuevoColor)) {
        $camposActualizar[] = "color='" . mysqli_real_escape_string($conexion, $nuevoColor) . "'";
    }
    if (!empty($nuevoPrecio)) {
        $camposActualizar[] = "precio='" . mysqli_real_escape_string($conexion, $nuevoPrecio) . "'";
    }
    $camposActualizar[] = "alquilado=" . ($nuevoAlquilado);

    if (!empty($camposActualizar)) {
        $updateQuery = "UPDATE $nombreTabla SET " . implode(", ", $camposActualizar) . " WHERE id_coche = $id_coche";
        mysqli_query($conexion, $updateQuery);
    }
}

$editar_id = isset($_REQUEST['editar_id']) ? (int)$_REQUEST['editar_id'] : 0;
$cocheAEditar = null;
if ($editar_id > 0) {
    $queryEdicion = "SELECT * FROM $nombreTabla WHERE id_coche=$editar_id";
    $resEdicion = mysqli_query($conexion, $queryEdicion);
    if ($resEdicion && mysqli_num_rows($resEdicion) > 0) {
        $cocheAEditar = mysqli_fetch_assoc($resEdicion);
    }
}

$posTop = "270px";
$posLeft = "37%";

print ("<table style='position:absolute; top:$posTop; left:$posLeft; background-color:rgba(128, 128, 128, 0.7); border:2px solid black; border-radius:10px; width:500px; padding:20px;'>\n");
print ("<tr><td style='text-align:center; font-weight:bold; font-size:20px;'>Editar coches de la base de datos</td></tr>\n");
print("<tr><td style='vertical-align:top; padding-top:20px;'>\n");
print("<form method='post' action=''>");
print("<label for='marca'>Marca: </label>");
print("<input type='text' name='marca' id='marca' value='" . htmlspecialchars($marca) . "' />");
print("<br><br>");
print("<label for='modelo'>Modelo: </label>");
print("<input type='text' name='modelo' id='modelo' value='" . htmlspecialchars($modelo) . "' />");
print("<br><br>");
print("<input type='submit' name='mostrar' value='Mostrar' style='background-color:#333; color:white; border:none; padding:5px 10px; cursor:pointer;' />");
print("</form>");
print("</td></tr>\n");

print ("<tr><td style='vertical-align:top;'>\n");

if (isset($_REQUEST['mostrar']) || isset($_REQUEST['actualizar']) || $editar_id > 0) {
    $instruccion = "SELECT * FROM $nombreTabla WHERE 1=1 ";

    if (!empty($marca)) {
        $instruccion .= "AND marca LIKE '%" . mysqli_real_escape_string($conexion, $marca) . "%' ";
    }
    if (!empty($modelo)) {
        $instruccion .= "AND modelo LIKE '%" . mysqli_real_escape_string($conexion, $modelo) . "%' ";
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
        print ("<th style='border:2px solid white; padding:10px;'>Modelo</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Marca</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Color</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Precio</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Alquilado</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Foto</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Acciones</th>\n");
        print ("</tr>\n");

        while ($resultado = mysqli_fetch_array($consulta)) {
            $id = $resultado['id_coche'];
            $res_modelo = $resultado['modelo'];
            $res_marca = $resultado['marca'];
            $res_color = $resultado['color'];
            $res_precio = $resultado['precio'];
            $res_alquilado = $resultado['alquilado'];
            $res_foto = $resultado['foto'];

            print ("<tr>\n");
            print ("<td style='border:2px solid white; padding:5px;height:30px;'>$id</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_modelo</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_marca</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_color</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_precio</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>$res_alquilado</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'><img src='$res_foto' alt='Foto de coche' width='100'></td>\n");
            print ("<td style='border:2px solid white; padding:5px;'><a href='?editar_id=$id&marca=".urlencode($marca)."&modelo=".urlencode($modelo)."' style='background-color:#333; color:white; border:none; padding:5px 10px; text-decoration:none;'>Editar</a></td>\n");
            print ("</tr>\n");
        }
        print ("</table>\n");
        print("<br>");
    } else {
        print ("No hay coches disponibles con esos criterios.");
    }
}

print ("</td></tr>\n");
print ("</table>\n");

if ($cocheAEditar) {
    ?>
    <div id="contenedor-formulario" style="display:block;">
        <form id="formulario-edicion" method="post" action="">
            <input type="hidden" name="id_coche" id="id_coche" value="<?php echo $cocheAEditar['id_coche']; ?>">
            <table>
                <tr>
                    <td>Modelo:</td>
                    <td><input type="text" name="modelo" id="edit_modelo" value="<?php echo htmlspecialchars($cocheAEditar['modelo']); ?>"></td>
                </tr>
                <tr>
                    <td>Marca:</td>
                    <td><input type="text" name="marca" id="edit_marca" value="<?php echo htmlspecialchars($cocheAEditar['marca']); ?>"></td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td><input type="text" name="color" id="edit_color" value="<?php echo htmlspecialchars($cocheAEditar['color']); ?>"></td>
                </tr>
                <tr>
                    <td>Precio:</td>
                    <td><input type="number" step="0.01" name="precio" id="edit_precio" value="<?php echo htmlspecialchars($cocheAEditar['precio']); ?>"></td>
                </tr>
                <tr>
                    <td>Alquilado:</td>
                    <td><input type="checkbox" name="alquilado" id="edit_alquilado" value="1" <?php echo ($cocheAEditar['alquilado'] == 1) ? 'checked' : ''; ?>></td>
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
