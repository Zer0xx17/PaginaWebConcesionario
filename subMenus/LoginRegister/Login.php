<?php
if (isset($_GET['dato'])) {
    $dato = $_GET['dato'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro & Login</title>
  <link rel="icon" href="img-Internas/favicon.ico" type="image/x-icon">
  <style>
    /* -------------------- Estilos de la Barra Superior -------------------- */
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
    /* Menú desplegable hacia la izquierda */
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
    .contenedor-imagen {
      position: relative;
      display: inline-block;
    }
    .contenedor-imagen:hover .submenu-izquierda {
      display: block;
    }
    
    /* -------------------- Estilos para Login & Registro -------------------- */
    html, body {
      height: 100%;
      margin: 0;
      background: url('../../img-Internas/fondoPaginaVacio.png') no-repeat center/cover;
    }
    body {
      background-color: #f7f7f7;
    }
    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 50px;
    }
    .wrapper {
      --input-focus: #2d8cf0;
      --font-color: #323232;
      --font-color-sub: #666;
      --bg-color: #fff;
      --bg-color-alt: #666;
      --main-color: #323232;
    }
    /* Card Switch */
    .switch {
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 30px;
      width: 50px;
      height: 20px;
    }
    .card-side::before {
      position: absolute;
      content: 'Log in';
      left: -70px;
      top: 0;
      width: 100px;
      text-decoration: underline;
      color: var(--font-color);
      font-weight: 600;
    }
    .card-side::after {
      position: absolute;
      content: 'Registrate';
      left: 70px;
      top: 0;
      width: 100px;
      text-decoration: none;
      color: var(--font-color);
      font-weight: 600;
    }
    .toggle {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .slider {
      box-sizing: border-box;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      box-shadow: 4px 4px var(--main-color);
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: var(--bg-color);
      transition: 0.3s;
    }
    .slider:before {
      box-sizing: border-box;
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      border: 2px solid var(--main-color);
      border-radius: 5px;
      left: -2px;
      bottom: 2px;
      background-color: var(--bg-color);
      box-shadow: 0 3px 0 var(--main-color);
      transition: 0.3s;
    }
    .toggle:checked + .slider {
      background-color: var(--input-focus);
    }
    .toggle:checked + .slider:before {
      transform: translateX(30px);
    }
    .toggle:checked ~ .card-side:before {
      text-decoration: none;
    }
    .toggle:checked ~ .card-side:after {
      text-decoration: underline;
    }
    /* Flip Card */
    .flip-card__inner {
      width: 300px;
      height: 350px;
      position: relative;
      background-color: transparent;
      perspective: 1000px;
      text-align: center;
      transition: transform 0.8s;
      transform-style: preserve-3d;
    }
    .toggle:checked ~ .flip-card__inner {
      transform: rotateY(180deg);
    }
    .toggle:checked ~ .flip-card__front {
      box-shadow: none;
    }
    .flip-card__front, .flip-card__back {
      padding: 20px;
      position: absolute;
      display: flex;
      flex-direction: column;
      justify-content: center;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      background: rgba(211, 211, 211, 0.5);
      gap: 20px;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      box-shadow: 4px 4px var(--main-color);
    }
    .flip-card__back {
      width: 100%;
      transform: rotateY(180deg);
    }
    .flip-card__form {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }
    .title {
      margin: 20px 0;
      font-size: 25px;
      font-weight: 900;
      text-align: center;
      color: var(--main-color);
    }
    .flip-card__input {
      width: 250px;
      height: 40px;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      background-color: var(--bg-color);
      box-shadow: 4px 4px var(--main-color);
      font-size: 15px;
      font-weight: 600;
      color: var(--font-color);
      padding: 5px 10px;
      outline: none;
    }
    .flip-card__input::placeholder {
      color: var(--font-color-sub);
      opacity: 0.8;
    }
    .flip-card__input:focus {
      border: 2px solid var(--input-focus);
    }
    .flip-card__btn:active, .button-confirm:active {
      box-shadow: 0px 0px var(--main-color);
      transform: translate(3px, 3px);
    }
    .flip-card__btn {
      margin: 20px 0;
      width: 120px;
      height: 40px;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      background-color: var(--bg-color);
      box-shadow: 4px 4px var(--main-color);
      font-size: 17px;
      font-weight: 600;
      color: var(--font-color);
      cursor: pointer;
    }
  </style>
</head>
<body>
  <!-- =================== Barra Superior =================== -->
  <nav>
    <img src="../../img-Internas/logo.png" alt="Logo" height="100px">
    <ul>
      <li>
        <a href="#">COCHES</a>
        <ul>
          <li><a href="../../index.php">Inicio</a></li>
          <li><a href="../../submenus/coches/AñadirCoches.php">Añadir</a></li>
          <li><a href="../../submenus/coches/ListarCoches.php">Listar</a></li>
          <li><a href="../../submenus/coches/BuscarCoches.php">Buscar</a></li>
          <li><a href="../../submenus/coches/ModificarCoches.php">Modificar</a></li>
          <li><a href="../../submenus/coches/BorrarCoches.php">Borrar</a></li>
        </ul>
      </li>
      <li>
        <a href="#">USUARIOS</a>
        <ul>
          <li><a href="../../index.php">Inicio</a></li>
          <li><a href="../../submenus/usuarios/AñadirUsuarios.php">Añadir</a></li>
          <li><a href="../../submenus/usuarios/ListarUsuarios.php">Listar</a></li>
          <li><a href="../../submenus/usuarios/BuscarUsuarios.php">Buscar</a></li>
          <li><a href="../../submenus/usuarios/ModificarUsuarios.php">Modificar</a></li>
          <li><a href="../../submenus/usuarios/BorrarUsuarios.php">Borrar</a></li>
        </ul>
      </li>
      <li>
        <a href="#">ALQUILERES</a>
        <ul>
          <li><a href="../../index.php">Inicio</a></li>
          <li><a href="../../alquileres/ListarAlquiler.php">Listar</a></li>
          <li><a href="../../alquileres/BorrarAlquiler.php">Borrar</a></li>
        </ul>
      </li>
    </ul>
    <div class="contenedor-imagen" style="margin-left: auto;">
      <a href="../../subMenus/LoginRegister/Login.php">
        <img src="img-Internas/InicioSesion.png" alt="Inicio Sesión" height="60px">
      </a>
      </div>
    </div>
  </nav>
  
  <!-- =================== Contenido de Login & Registro =================== -->
  <div class="container">
    <div class="wrapper">
      <div class="card-switch">
        <label class="switch">
          <input type="checkbox" class="toggle" <?php echo (isset($dato) && $dato === 'Registro' ? 'checked' : ''); ?>> 
          <span class="slider"></span>
          <span class="card-side"></span>
          <div class="flip-card__inner">
            <div class="flip-card__front">
              <div class="title">Log in</div>
              <form class="flip-card__form" action="">
                <input class="flip-card__input" name="email" placeholder="Email" type="email" required>
                <input class="flip-card__input" name="password" placeholder="Password" type="password" required>
                <button class="flip-card__btn">Let`s go!</button>
              </form>
            </div>
            <div class="flip-card__back">
              <div class="title">Registrate</div>
              <form class="flip-card__form" action="">
                <input class="flip-card__input" placeholder="Nombre" type="Nombre" required>
                <input class="flip-card__input" name="DNI" placeholder="DNI" type="DNI" required>
                <input class="flip-card__input" name="password" placeholder="Password" type="password" required>

                <div class="user-type">
      <label class="user-option">
        <input type="radio" name="user_type" value="Comprador">
        <span>Comprador</span>
      </label>
      <label class="user-option">
        <input type="radio" name="user_type" value="Vendedor">
        <span>Vendedor</span>
      </label>
    </div>
    
                <button class="flip-card__btn">Confirm!</button>
              </form>
            </div>
          </div>
        </label>
      </div>
    </div>
  </div>
</body>
</html>
