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
<div id="contenedor-formulario">
    <form id="formulario-dinamico"></form>
    <button onclick="ocultarFormulario()">Cerrar</button>
</div>
<script>
    function mostrarFormulario(opcion) {
        const formulario = document.getElementById('formulario-dinamico');
        document.getElementById('contenedor-formulario').style.display = 'block';
    }
    function ocultarFormulario() {
        document.getElementById('contenedor-formulario').style.display = 'none';
    }
</script>

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
$modelo = isset($_REQUEST['modelo']) ? trim($_REQUEST['modelo']) : '';

$posTop = "270px";
$posLeft = "37%";

print ("<table style='position:absolute; top:$posTop; left:$posLeft; background-color:rgba(128, 128, 128, 0.7); border:2px solid black; border-radius:10px; width:500px; padding:20px;'>\n");
print ("<tr><td style='text-align:center; font-weight:bold; font-size:20px;'>Listado de coches</td></tr>\n");

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

if (isset($_REQUEST['mostrar'])) {
    if (empty($marca) && empty($modelo)) {
        print("Introduce un campo");
    } else {
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
            print ("</tr>\n");

            for ($i = 0; $i < $nfilas; $i++) {
                $resultado = mysqli_fetch_array($consulta);
                print ("<tr>\n");
                print ("<td style='border:2px solid white; padding:5px;height: 30px;'>" . $resultado['id_coche'] . "</td>\n");
                print ("<td style='border:2px solid white; padding:5px;'>" . $resultado['modelo'] . "</td>\n");
                print ("<td style='border:2px solid white; padding:5px;'>" . $resultado['marca'] . "</td>\n");
                print ("<td style='border:2px solid white; padding:5px;'>" . $resultado['color'] . "</td>\n");
                print ("<td style='border:2px solid white; padding:5px;'>" . $resultado['precio'] . "</td>\n");
                print ("<td style='border:2px solid white; padding:5px;'>" . $resultado['alquilado'] . "</td>\n");
                print ("<td style='border:2px solid white; padding:5px;'><img src='" . $resultado['foto'] . "' alt='Foto de coche' width='100'></td>\n");
                print ("</tr>\n");
            }
            print ("</table>\n");
        } else {
            print ("No hay coches disponibles con esos criterios.");
        }
    }
} else {
}

print ("</td></tr>\n");
print ("</table>\n");

mysqli_close($conexion);
?>

</body>
</html>
