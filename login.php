<?php
    require "includes/app.php";

    //importamos la conexion
    $db = conectarDB();

    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email){
            $errores[] = 'Debe Ingresar un Email Válido';
        }
        if (!$password){
            $errores[] = 'Debe Ingresar un Password Válido';
        }

        if(empty($errores)){
            $query = "SELECT * FROM usuarios WHERE email ='".$email."' ;";
            $result = mysqli_query($db, $query);

            if ($result -> num_rows){
                //Comprobar contraseña
                $usuario = mysqli_fetch_assoc($result);

                $auth = password_verify($password, $usuario['password']);

                if ($auth){
                    session_start();
                    $_SESSION['login'] = true;
                    header('Location: /admin/index.php');
                    exit();
                }else{
                    $errores[] = "El password es incorrecto";
                }
            } else{
                $errores[] = "Usuario Inválido";
            }
        }
    }

    // Solo incluir el header después de procesar el POST
    incluirTemplate("header");
?>

<main class="contenedor seccion contenido-centrado">

        <h1>Inicia Sesión</h1>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST">

        <fieldset>
            <legend>Información Personal</legend>

            <label for="email">Email</label>
            <input type="email" placeholder="Tu Email" id="email" name="email">

            <label for="password">Password</label>
            <input type="password" placeholder="Tu Password" id="password" name="password">

        </fieldset>
        
        <input class="boton boton-verde" type="submit" value="Iniciar Sesión">
    </form>

</main>

<?php
    incluirTemplate("footer");
?>