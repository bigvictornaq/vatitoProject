<?php
include 'conexion_be.php';
include 'SED.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index2.php");
}
$correo = $_SESSION['usuario'];

$sql = "SElECT * FROM usuarios WHERE Correo = '$correo'";
$resultado = $conexion->query($sql);
$rows = $resultado->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Usuario</title>
    <link rel="stylesheet" href="../css/estilos2.css" />   <!--mi hoja de estilos-->
    <link rel="stylesheet" href="../css/visualizador.css">   <!--estilos del visualizador de pdf-->
    <link rel="stylesheet" href="../css/style.css" />  <!--estilos de la barra de navegación-->
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">   <!--Repositorio con diseños-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script defer src="../js/index.js"></script> <!----menú desplegable--->
</head>
<!--Barra de Navegación  hoja de estilos en style.css-->

<body>
    <header class="header">
        <nav class="nav">
            <a href="#" class="logo nav-link">Departamento de Sistemas</a>
            <button class="nav-toggle" aria-label="Abrir menú">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu">
                <li class="nav-menu-item">
                    <a href="perfil2admin.php" class="nav-menu-link nav-link">Inicio</a>
                </li>

                <li class="nav-menu-item">
                    <a href="cerrar_sesion.php" class="nav-menu-link nav-link">Salir</a>
                </li>
            </ul>
        </nav>
    </header>

    <style type="text/css">
        /*propiedades y estilos */
        html {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            text-size-adjust: 100%;
            line-height: 1.4;

        }

        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            color: #404040;
            font-family: "Arial", Segoe UI, Tahoma, sans-serifl, Helvetica Neue, Helvetica;
        }

        /*-------estilos del perfil----------------------------*/
        .perfil-usuario {
            background: linear-gradient(#3FD0F4, transparent);
            color: #333;

        }

        .perfil-usuario .sombra {
            position: absolute;
            display: block;
            background: linear-gradient(transparent, rgba(0, 0, 0, .5));
            width: 100%;
            height: 50%;
            bottom: 0;
            left: 0;
        }

        .perfil-usuario .portada-perfil,
        .perfil-usuario .sombra {
            border-radius: 0 0 20px 20px;
        }

        .perfil-usuario img {
            width: 100%;
        }

        .contenedor-perfil {
            max-width: 1024px;
            margin-left: auto;
            margin-right: auto;
        }

        .perfil-usuario .contenedor-perfil {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        .perfil-usuario .portada-perfil {
            display: block;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            height: 20rem;
            margin-bottom: .5rem;
        }

        .perfil-usuario .avatar-perfil {
            display: block;
            width: 230px;
            height: 230px;
            background-color: #D9DCF1;
            position: absolute;
            bottom: -65px;
            left: 4rem;
            border-radius: 50%;
            overflow: hidden;
            border: 8px solid #FFFFFF;
            box-shadow: 0 0 12px 2px rgba(0, 0, 0, .2);
        }

        .perfil-usuario .cambiar-foto {
            position: absolute;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color: rgba(0, 0, 0, .5);
            height: 57%;
            bottom: 0;
            left: 0;
            color: #fff;
            text-decoration: none;
            transform: translateY(50%);
            opacity: 0;
            transition: all ease-in 200ms;
        }

        .perfil-usuario .cambiar-foto i {
            margin-bottom: .5rem;
            font-size: 2rem;
        }

        .perfil-usuario .avatar-perfil:hover .cambiar-foto {
            transform: translateY(0);
            opacity: 1;
        }

        .perfil-usuario .datos-perfil {
            position: absolute;
            display: block;
            width: calc(100% - 230px - 8rem);
            right: 0;
            bottom: 0;
            color: #fff;
            text-shadow: 0 0 5px rgba(0, 0, 0, .2);
            padding-bottom: 1rem;
            padding-right: 1rem;
        }

        .perfil-usuario .titulo-usuario {
            font-size: 2.3rem;
            white-space: nowrap;
            margin-bottom: .5rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .perfil-usuario .bio-usuario {
            font-size: 1em;
            margin-bottom: .75rem;
        }

        .perfil-usuario .lista-perfil {
            list-style: none;
        }

        .perfil-usuario .lista-perfil li {
            display: inline-block;
            font-size: 1em;
            margin-right: 1rem;
        }

        .perfil-usuario .opciones-perfil {
            display: block;
            position: absolute;
            right: 2rem;
            top: 1rem;
        }

        .perfil-usuario .opciones-perfil button {
            border: 0;
            padding: 8px 20px;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, .5);
            color: #fff;
            cursor: pointer;
        }

        .perfil-usuario .menu-perfil ul {
            display: flex;
            list-style: none;
            margin-left: calc(200px + 8rem);
            width: calc(100% - 200px - 8rem);
        }

        .perfil-usuario .menu-perfil ul li {
            margin-right: 1rem;
        }

        .perfil-usuario .menu-perfil a {
            display: block;
            text-decoration: none;
            color: inherit;
            padding: 8px 20px;
            font-weight: bold;
            border-radius: 8px;
            transition: all ease-in 100ms;
        }

        .perfil-usuario .menu-perfil a:hover {
            background-color: #4CB0C6;
            color: #fff;
        }

        .perfil-usuario .icono-perfil {
            display: none;
            margin-right: .75rem;
        }

        @media (max-width: 780px) {
            .perfil-usuario .contenedor-perfil {
                width: 100%;
            }

            .perfil-usuario .avatar-perfil {
                left: calc(50% - 115px)
            }

            .perfil-usuario .datos-perfil {
                bottom: 200px;
                left: 0;
                width: 100%;
                padding: 15px;
                text-align: center;
            }

            .perfil-usuario .bio-usuario {
                font-size: 1em;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .perfil-usuario .titulo-usuario {
                font-size: 2.1rem;
            }

            .perfil-usuario .portada-perfil {
                height: 28rem;
            }

            .perfil-usuario .menu-perfil ul {
                flex-direction: column;
            }

            .perfil-usuario .lista-perfil {
                display: block;
            }

            .perfil-usuario .menu-perfil {
                margin-top: 2rem;
            }

            .perfil-usuario .menu-perfil ul {
                display: flex;
                list-style: none;
                margin-left: auto;
                margin-right: auto;
                padding-top: 2.5rem;
                width: 70%;
                background-color: #fff;
                border-radius: 12px;
                box-shadow: 0 0 12px 2px rgba(0, 0, 0, .1);
            }

            .perfil-usuario .icono-perfil {
                display: inline-block;
            }
        }

        .modal-container{
           background-color:rgba(0,0,0,0.3);
           display:flex;
           align-items: center;
           justify-content:center;
           position :fixed;
           opacity: 0;
           pointer-events:none;
           top:0;
           left:0;
           height:100vh;
           width:100vw;
           
        }

        .modal-container.show{
            pointer-events:auto;
            opacity: 1;
        }
        
        .modal1{
            background-color:#fff;
            border-radius:5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            padding: 30px 50px;
            width:600px;
            max-width:100%;
            text-align:center;
        }


    </style>
    <!--=            html del perfil de usuario (imagenes y personalización) =-->
    <section class="perfil-usuario">
        <div class="contenedor-perfil">
            <div class="portada-perfil" style="background-image: url('../images/portada.jpg');">
                <div class="sombra"></div>
                <div class="avatar-perfil">
                    <img src="../fotos de perfil/<?php echo utf8_decode($rows['Correo']); ?>/<?php echo utf8_decode($rows['Perfil']); ?> " alt="img">   <!-- hize cambio cana-->

                    <button class="cambiar-foto" id="open" >
                    <i class="fas fa-camera"></i>
                        <span>Cambiar foto</span>
                    </button>

                    <!---
                    <a href="#" id="open" class="cambiar-foto">
                        <i class="fas fa-camera"></i>
                        <span>Cambiar foto</span>
                    </a>
                        -->
                </div>
                <div class="datos-perfil">
                    <h4 class="titulo-usuario"><?php echo utf8_decode($rows['Nombre_Completo']); ?></h4>
                    <p class="bio-usuario"><?php echo utf8_decode($rows['Biografia']); ?></p>
                    <ul class="lista-perfil">
                    </ul>
                </div>
                <div class="opciones-perfil">
                    <button type="">Cambiar portada</button>
                    <button type=""><i class="fas fa-wrench"></i></button>
                </div>
            </div>
        </div>

            <!--- Aqui navaboy modifico cana 
            se agrego un modal mamalon de forma vanilla cana,
            se modifico css de que tienes aqui arriba, ademas js para que jale ---->
            
          
            <div class="modal-container" id="modal_container">
            <div class="modal1">
                <h1>Modal mamlon de navaboy</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta iusto perspiciatis explicabo 
                    doloremque unde tempora? Sed, similique eligendi quas nisi, quos vero sit aperiam voluptate dolores 
                    nulla deleniti quam praesentium!</p>
                    <form action="../processes/fotoup.php" 
                    method="post" 
                    enctype="multipart/form-data" id="formu">
                    <input type="file" name="userfoto">
                </form>
                <button id="close" form="formu" type="submit" name="update" value="update">
                        cierrame carnalito
                    </button>
            </div>
        </div>


    </section>

    <!--          Visualizador de usuarios       -->

    <body>
        <div style="padding-top: 60px;">


            <div>
                <div class="container">
                    <table class="table table-dark" style="table-layout: fixed; word-wrap: break-word;" id="myList">
                        <thead>
                            <tr>
                            <!--th scope="col">Id</th-->
                                <th scope="col">Perfil</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Biografia</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Password</th>
                                <th scope="col">Eliminar Usuario</th>
                                <th scope="col">Editar Usuario</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sql = "SELECT * from usuarios";
                            $result = mysqli_query($conexion, $sql);

                            while ($mostrar = mysqli_fetch_array($result)) {
                            ?>




                                <tr>
                                <!--td>?php echo $mostrar['Id'] ?> </td-->
                                    <td><?php echo $mostrar['Perfil'] ?> </td>
                                    <td><?php echo $mostrar['Nombre_Completo'] ?> </td>
                                    <td><?php echo $mostrar['Biografia'] ?> </td>
                                    <td><?php echo $mostrar['Correo'] ?> </td>

                                    <td><?php echo $mostrar['Password']?> </td>
                                    <td>
                                        <a href="deleteusuario.php?buscarId=<?= $mostrar['Id'] ?>" class="btn btn-outline-danger">Eliminar</a>

                                    </td>
                                    <td>
                                        <a href="updateusuario.php?buscarId=<?= $mostrar['Id'] ?>" class="btn btn-outline-info">Actualizar</a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                </div>



            </div>

        </div>


        </div>


        </div>


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        
        <link rel="stylesheet" href="../css/estilos.css">
    </body>
    <footer style="background-color: #3987ec;">
        <strong>
            <div class="container" style="color: white; text-align: center;">
                <p style="left: 2%; "> Tecnológico Nacional de México
                    Campus Ciudad Juárez <br> Av.Tecnológico No.1340 C.P.32500 Ciudad Juárez, Chih.México </p>
                <p style="right: 2%; "> Departamento de sistemas <br>
                    (656) 688 - 2500 Ext.2301 </p>

                <div class="card-footer bg-primary border-white"> </div>
        </strong>
    </footer>
    <script src="../js/modal.js"></script>
</body>

</html>