<?php
//importar conexion

require 'includes/config/database.php';
$db = conectarDB();

//guardar en caso de que ocurra algun error para mostrar despues
$errores = [];
//autenticar usuario

//se busca saber cual es el estado del servidor??
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //evita que se ponga cualquier tipo de comando mysql
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //revisar que no esten vacios o invalidos
    if (!$email) {
        $errores[] = 'El email es obligatorio o no es valido';
    }
    if (!$password) {
        $errores[] = 'La clave es obligatoria';
    }
    //si no hay erroes 
    if (empty($errores)) {
        //revisa que el usuario exita
        //en query es obligatorio que se use "
        $query = "SELECT * FROM usuario WHERE correo = '${email}';";

        $resultado = mysqli_query($db, $query);
        //obtiene el numero de filas
        if ($resultado->num_rows) {
            //obtiene los datos del usuario y los guarda para comparar
            $usuario = mysqli_fetch_assoc($resultado);
            //compara en que sean iguales o no
            
            $auth = password_verify($password, $usuario['clave']);
            if ($auth) {
                session_start();
                var_dump("login exitoso");
                //esto es para llenar el arreglo de la sesion
                $_SESSION['usuario'] = $email;
                $_SESSION['login'] = true; //se puede generar cualquier nombre y darle cualquier valor
                //manda a la carpeta de admin
                header('location:admin');
            } else {
                $errores[] = 'la clave es incorrecta';
            }
        } else {
            $errores[] = 'El usuario no existe';
        }
    }
}

require 'includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion padtop">
    <h1>Iniciar Sesion</h1>
    <?php
    foreach ($errores as $error) {
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php
    }
    ?>
    <form method="POST" class="formulario login">
        <fieldset>
            <legend>Email y password</legend>

            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" placeholder="Tu E-mail..." required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Tu password...">
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="btn">
    </form>
</main>
<?php incluirTemplate('footer'); ?>