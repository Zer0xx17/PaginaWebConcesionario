
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../../index.php");
    exit();
}

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

function esTipo($usuario, $tipo) {
    return isset($usuario['tipoUsuario']) && strcasecmp($usuario['tipoUsuario'], $tipo) === 0;
}
?>
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
background: url('../../img-Internas/fondoPaginaVacio.png') no-repeat center/cover;
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
        .submenu-izquierda a,
        .submenu-izquierda span,
        .submenu-izquierda button {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            font-family: "Verdana", sans-serif;
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
        }
        .submenu-izquierda a:hover,
        .submenu-izquierda button:hover {
            background-color: #575757;
        }
        .contenedor-imagen {
            position: relative;
            display: inline-block;
        }
        .contenedor-imagen:hover .submenu-izquierda {
            display: block;
        }
        .contenedor-imagen a:hover {
            background-color: transparent !important;
            box-shadow: none !important;
            outline: none !important;
        }
    </style>
</head>
<body>
    <nav>
        <img src="../../img-Internas/logo.png" alt="Logo" height="100px">
        <ul>
            <!-- Menú COCHES -->
            <li>
                <a href="#">COCHES</a>
                <ul>
    <?php if ($usuario && esTipo($usuario, 'administrador')): ?>
        <li><a href="../../submenus/coches/AñadirCoches.php">Añadir alquileres</a></li>
        <li><a href="../../submenus/coches/ListarCoches.php">Listar</a></li>
        <li><a href="../../submenus/coches/BuscarCoches.php">Buscar</a></li>
        <li><a href="../../submenus/coches/ModificarCoches.php">Modificar</a></li>
        <li><a href="../../submenus/coches/BorrarCoches.php">Borrar</a></li>
    <?php elseif ($usuario && esTipo($usuario, 'vendedor')): ?>
        <li><a href="../../submenus/coches/AñadirCoches.php">Añadir alquileres</a></li>
        <li><a href="../../submenus/coches/ListarCoches.php">Listar</a></li>
        <li><a href="../../submenus/coches/BuscarCoches.php">Buscar</a></li>
        <li><a href="../../submenus/coches/ModificarCoches.php">Modificar</a></li>
    <?php elseif ($usuario && esTipo($usuario, 'comprador')): ?>
        <li><a href="../../submenus/coches/ListarCoches.php">Listar</a></li>
        <li><a href="../../submenus/coches/BuscarCoches.php">Buscar</a></li>
    <?php else: ?>
        <!-- Opciones para usuarios no autenticados -->
        <li><a href="../../submenus/coches/ListarCoches.php">Listar</a></li>
        <li><a href="../../submenus/coches/BuscarCoches.php">Buscar</a></li>
    <?php endif; ?>
                </ul>   
            </li>
            <!-- Menú USUARIOS -->
            <li>
                <a href="#">USUARIOS</a>
                <ul>       
                    <?php if ($usuario && esTipo($usuario, 'administrador')): ?>
                        <li><a href=" ../../index.php">Inicio</a></li>
                        <li><a href="../../submenus/usuarios/AñadirUsuarios.php">Añadir</a></li>
                        <li><a href="../../submenus/usuarios/ListarUsuarios.php">Listar</a></li>
                        <li><a href="../../submenus/usuarios/BuscarUsuarios.php">Buscar</a></li>
                        <li><a href="../../submenus/usuarios/ModificarUsuarios.php">Modificar</a></li>
                        <li><a href="../../submenus/usuarios/BorrarUsuarios.php">Borrar</a></li>
                    <?php else: ?>
                        <li><span>No dispones de los permisos suficientes</span></li>
                    <?php endif; ?>
                </ul>
            </li>
            <!-- Menú ALQUILERES -->
            <li>
                <a href="#">ALQUILERES</a>
                <ul>
                    <li><a href="../../index.php">Inicio</a></li>
                        
                    <?php if ($usuario && esTipo($usuario, 'administrador')): ?>
                        <li><a href="../alquileres/ListarAlquiler.php">Listar</a></li>
                        <li><a href="../alquileres/BorrarAlquiler.php">Borrar</a></li>
                        <li><a href="../alquileres/DevolverAlquiler.php">Devolver Alquiler</a></li>
                            <?php elseif ($usuario && esTipo($usuario, 'vendedor')): ?>
                        <li><a href="../alquileres/ListarAlquiler.php">Listar</a></li>
                        <li><a href="../alquileres/BorrarAlquiler.php">Borrar</a></li>
                            <?php elseif ($usuario && esTipo($usuario, 'comprador')): ?>
                        <li><a href="../alquileres/ListarAlquiler.php">Listar</a></li>
                        <li><a href="../alquileres/DevolverAlquiler.php">Devolver Alquiler</a></li>
                            <?php else: ?>
                                <li><span>Inicia sesión para acceder a este apartado</span></li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
        
        <!-- Zona de inicio de sesión / usuario -->
        <?php if ($usuario): ?>
            <div class="contenedor-imagen" style="margin-left: auto;">
                <a href="#">
                    <img src="../../img-Internas/InicioS.png" alt="Inicio Sesión" height="60px">
                </a>
                <div class="submenu-izquierda" style="display:block; left: -130px;">
                    <span>Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?>!</span>
                    <form method="POST" style="margin:0;">
                        <button type="submit" name="logout">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="contenedor-imagen" style="margin-left: auto;">
                <a href="../../subMenus/LoginRegister/Login.php">
                    <img src="../../img-Internas/InicioS.png" alt="Inicio Sesión" height="60px">
                </a>
                <div class="submenu-izquierda">
                    <a href="../../subMenus/LoginRegister/Login.php?dato=InicioSesion">Iniciar Sesión</a>
                    <a href="../../subMenus/LoginRegister/Login.php?dato=Registro">Registrarse</a>
                </div>
            </div>
        <?php endif; ?>
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

$nombreTabla = "usuarios";

$nombre = isset($_REQUEST['nombre']) ? trim($_REQUEST['nombre']) : '';
$apellidos = isset($_REQUEST['apellidos']) ? trim($_REQUEST['apellidos']) : '';

if (isset($_REQUEST['borrar']) && isset($_REQUEST['delete_ids']) && is_array($_REQUEST['delete_ids'])) {
    foreach ($_REQUEST['delete_ids'] as $id) {
        $id = (int)$id; 
        $deleteQuery = "DELETE FROM $nombreTabla WHERE id_usuario = $id";
        mysqli_query($conexion, $deleteQuery);
    }
}

$posTop = "270px";
$posLeft = "37%";

print ("<table style='position:absolute; top:$posTop; left:$posLeft; background-color:rgba(128, 128, 128, 0.7); border:2px solid black; border-radius:10px; width:500px; padding:20px;'>\n");
print ("<tr><td style='text-align:center; font-weight:bold; font-size:20px;'>Eliminar usuarios de la base de datos</td></tr>\n");
print("<tr><td style='vertical-align:top; padding-top:20px;'>\n");
print("<form method='post' action=''>");
print("<label for='nombre'>Nombre: </label>");
print("<input type='text' name='nombre' id='nombre' value='" . htmlspecialchars($nombre) . "' />");
print("<br><br>");
print("<label for='apellidos'>Apellidos: </label>");
print("<input type='text' name='apellidos' id='apellidos' value='" . htmlspecialchars($apellidos) . "' />");
print("<br><br>");
print("<input type='submit' name='mostrar' value='Mostrar' style='background-color:#333; color:white; border:none; padding:5px 10px; cursor:pointer;' />");
print("</form>");
print("</td></tr>\n");

print ("<tr><td style='vertical-align:top;'>\n");

if (isset($_REQUEST['mostrar']) || isset($_REQUEST['borrar'])) {
    $instruccion = "SELECT * FROM $nombreTabla WHERE 1=1 ";
    
    if (!empty($nombre)) {
        $instruccion .= "AND nombre LIKE '%" . mysqli_real_escape_string($conexion, $nombre) . "%' ";
    }
    if (!empty($apellidos)) {
        $instruccion .= "AND apellidos LIKE '%" . mysqli_real_escape_string($conexion, $apellidos) . "%' ";
    }

    $consulta = mysqli_query($conexion, $instruccion);

    if (!$consulta) {
        die("Fallo en la consulta: " . mysqli_error($conexion));
    }

    $nfilas = mysqli_num_rows($consulta);

    
    if ($nfilas > 0) {
        print("<form method='post' action=''>");
        print("<input type='hidden' name='nombre' value='".htmlspecialchars($nombre)."' />");
        print("<input type='hidden' name='apellidos' value='".htmlspecialchars($apellidos)."' />");
        
        print ("<table style='background-color:#ccc; border-radius:10px; border-collapse: collapse; text-align:center; width:100%; margin-top:20px;'>\n");
        print ("<tr style='background-color: #dadff1;'>\n");
        print ("<th style='border:2px solid white; padding:5px;'>Sel.</th>\n");
        print ("<th style='border:2px solid white; padding:5px;'>ID Usuario</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Password</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Nombre</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Apellidos</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>DNI</th>\n");
        print ("<th style='border:2px solid white; padding:10px;'>Saldo</th>\n");
        print ("</tr>\n");

        for ($i = 0; $i < $nfilas; $i++) {
            $resultado = mysqli_fetch_array($consulta);
            print ("<tr>\n");
            print ("<td style='border:2px solid white; padding:5px;'><input type='checkbox' name='delete_ids[]' value='".$resultado['id_usuario']."'></td>\n");
            print ("<td style='border:2px solid white; padding:5px;height:30px;'>" . $resultado['id_usuario'] . "</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>" . htmlspecialchars($resultado['password']) . "</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>" . htmlspecialchars($resultado['nombre']) . "</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>" . htmlspecialchars($resultado['apellidos']) . "</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>" . htmlspecialchars($resultado['dni']) . "</td>\n");
            print ("<td style='border:2px solid white; padding:5px;'>" . htmlspecialchars($resultado['saldo']) . "</td>\n");
            print ("</tr>\n");
        }
        print ("</table>\n");
        print("<br>");

        print("<input type='submit' name='borrar' value='Borrar' style='margin-left:10px; background-color:#333; color:white; border:none; padding:5px 10px; cursor:pointer;' />");
        print("</form>");
    } else {
        print ("No hay usuarios disponibles con esos criterios.");
    }
} else {

}

print ("</td></tr>\n");
print ("</table>\n");

mysqli_close($conexion);
?>

</body>
</html>
