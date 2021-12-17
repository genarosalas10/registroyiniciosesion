!doctype html>
<html lang=es>
    <head>
        <meta charset=utf-8 />
        <meta name=viewport content="width=device-width, initial-scale=1" />
        <title>Pagina examen</title>
        <link rel=stylesheet href=estilo.css />
    </head>
    <body>
        <nav>
        <ul>
			<li><a href="registro.php">Registrar</a></li>
			<li><a href="iniciarsesion.php">Iniciar Sesion</a></li>
		</ul>
        </nav>
        <header>
            <h1>Inicio de sesion </h1>
        </header>
        <main>
            <section>
                <?php
                    if(!(isset($_POST['enviar']))) 
                    {
                        echo '
                        <form action="iniciarsesion.php" method="POST">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" /><br />
                            <label for="contrasena"> Contraseña</label>
                            <input type="password" name="contrasena" /><br />
                            <input type="submit" name ="enviar" value="Enviar" />
                        </form>';
                    }
                    else
                    {
                        $consulta="SELECT * FROM Usuarios WHERE usuario='".$_POST['usuario']."';";
                        require_once("procesos_bd.php");
                        $sql=new Procesos_bd();
                        $resultado=$sql->consultar($consulta);
                        $fila=$resultado->fetch_assoc();
                        if($_POST['usuario']==$fila['usuario']&&$_POST['contrasena']==$fila['contrasena']){
                            session_start();
                            $_SESSION['idUsuario']=$fila['idUsuario'];
                            echo 'inició de sesion correctamente, tu id de usuario es'.$_SESSION['idUsuario'];
                        }
                        else
                        {
                            echo 'No pudo iniciar sesion';
                        }
                    }
                ?>
            </section>
        </main>
    </body>
</html>