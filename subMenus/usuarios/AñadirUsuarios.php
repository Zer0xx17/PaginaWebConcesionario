
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
.formulario-tabla input[type="password"],
.formulario-tabla select {
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
                        <li><a href="../../index.php">Inicio</a></li>
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
    $password    = isset($_REQUEST['password']) ? trim($_REQUEST['password']) : '';
    $nombre      = isset($_REQUEST['nombre']) ? trim($_REQUEST['nombre']) : '';
    $Apellidos   = isset($_REQUEST['Apellidos']) ? trim($_REQUEST['Apellidos']) : '';
    $dni         = isset($_REQUEST['dni']) ? trim($_REQUEST['dni']) : '';
    $saldo       = isset($_REQUEST['saldo']) ? trim($_REQUEST['saldo']) : '';

    if (!empty($password) && !empty($nombre) && !empty($Apellidos) && !empty($dni) && $saldo !== '') {
        // Encriptar la contraseña utilizando sha1
        $password = sha1($password);

        $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (password, nombre, Apellidos, dni, saldo) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssd", $password, $nombre, $Apellidos, $dni, $saldo);

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
                <td>Tipo usuario:</td>
                <td>
                    <select name="Apellidos" required>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Comprador">Comprador</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </td>
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
