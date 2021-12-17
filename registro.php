<!doctype html>
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
			<li><a href="#">Registrar</a></li>
			<li><a href="iniciarsesion.php">Iniciar Sesion</a></li>
		</ul>
        </nav>
        <header>
            <h1>Indique los datos del usuario </h1>
        </header>
        <main>
            <section>
                <?php
                    //Saber si no existe $_POST['enviar']
                    if(!(isset($_POST['enviar']))) 
                    {
                        echo '
                        <form action="registro.php" method="POST">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" /><br />
                        <label for="nombre"> Nombre</label>
                        <input type="text" name="nombre" /><br />
                        <label for="correo"> Correo</label>
                        <input type="text" name="correo" /><br />
                        <label for="contrasena"> Contraseña</label>
                        <input type="password" name="contrasena" /><br />
                        <label for="contrasena2"> Repita contraseña</label>
                        <input type="password" name="contrasena2" /><br />
                        <input type="submit" name ="enviar" value="Enviar" />
                    </form>';
                    }
                    else
                    {
                        //Saber si ha introducido la misma contraseña
                        if($_POST['contrasena']==$_POST['contrasena2'] )
                        {
                            $alta="INSERT INTO usuarios (usuario,nombre,correo,contrasena) VALUES 
                            ('".$_POST['usuario']."','".$_POST['nombre']."','".$_POST['correo']."','".$_POST['contrasena']."');";
                            require_once("procesos_bd.php");
                            $sql=new Procesos_bd();
                            $resultado=$sql->consultar($alta);
                            if (!$resultado) //Para comprobar si la consulta se ha realizado con exito
                            {
                            //Falla a la hora de meter los datos en la base de datos
                            echo 'No se pudieron guardar los datos. ';
                            echo $sql->error();
                            }
                            else
                            {   
                                //Sacar idUsuario del usuario que se acaba de registrar
                                /*  $sacaridUsuario="SELECT idUsuario FROM usuarios where usuario='".$_POST['usuario']."';";
                                $resultadoid=$sql->consultar($sacaridUsuario); */
                                $idUsuario=$sql->id_ultima();

                                //Sacar todos los minijuegos
                                $sacarMj="SELECT idMinijuego, nombre FROM minijuegos;";
                                $resultadoMj=$sql->consultar($sacarMj);
                                $cFilasMj=$sql->contarFilas($resultadoMj);

                                //Mostrar checbox con los minijuegos
                                echo "<form action='preferencias.php 'method='POST'>";
                                while($fila = $resultadoMj->fetch_assoc())
                                {
                                    echo"<label>".$fila['nombre']."</label><input type='checkbox' name=mj[] value=".$fila['idMinijuego']."> <br>";
                                }
                            }
                            //Campo oculto  con el id del usuario
                            echo "<input  name=idUsuario type='hidden' value='".$idUsuario."'>
                            <input  name=filasMj type='hidden' value='".$cFilasMj."'>
                            <input type='submit' name ='siguiente' value='Siguiente' /></form>";

                        }
                        else 
                        {
                            echo 'la contraseña no coinciden';
                        }
                    }
                ?>
            </section>
         </main>
    </body>
</html>