<!doctype html>
<html lang=es>
  <head>
    <meta charset=utf-8 />
    <meta name=viewport content="width=device-width, initial-scale=1" />
    <title>Pagina examen</title>
    <link rel=stylesheet href=estilo.css />
  </head>
  <body>
    <nav></nav>
    <header>
      <h1>Preferencias del usuario </h1>
    </header>
    <main>
      <section>
        <?php
          require_once("procesos_bd.php");
          $sql=new Procesos_bd();
          if(isset($_POST['siguiente']))
          {
            if (isset($_POST['mj'])) 
            {
              foreach ($_POST['mj'] as $idMinijuego ) 
              {
                $meterPref="INSERT INTO preferencias (idUsuario, idMinijuego) VALUES ('".$_POST['idUsuario']."','".$idMinijuego."');";
                $resultado=$sql->consultar($meterPref); 
              }
            }   
            echo 'registro completo';
            echo ' <a href="registro.php">Volver</a>';             
          }
          $sql->cerrar();
        ?>
      </section>
    </main>
  </body>
</html>