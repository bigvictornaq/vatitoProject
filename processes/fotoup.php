<?php


include '../php/conexion_be.php';


session_start();



$correo = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index2.php");
}

if(isset($_POST['update' ])){
    $userImage = $_FILES['userfoto'];

    $img_name = $userImage['name'];
	$img_size = $userImage['size'];
	$tmp_name = $userImage['tmp_name'];
	$error = $userImage['error'];

    if($error === 0){
        if($img_size > 125000){
            $em = "Disculpe carnal, pero su foto esta muy pesada  la neta.";
		    header("Location: perfil2admin.php?error=$em");
        }else{
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); // aqui devolvemos el name de la ruta de la imagen
			$img_ex_lc = strtolower($img_ex); // convierte un string en minusculas
            $allowed_exs = array("jpg", "jpeg", "png");  // extension permitida cana
            if(in_array($img_ex_lc, $allowed_exs)){
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc; // esta puedes cambiarla,
																	//lo que hace crear un nombre con identificador unico 
				
																	//para que no tengas problemas al momento de guardarlo.
				// aqui lo guardar en la ruta de tu pc
                $img_upload_path = '../fotos de perfil/'.$correo.'/'.$new_img_name;

                 
                if(file_exists('../fotos de perfil/'.$correo)){ //revisamos si existe ese carpeta
                    move_uploaded_file($tmp_name, $img_upload_path);
                    }else{
                    mkdir('../fotos de perfil/'.$correo);
                   move_uploaded_file($tmp_name, $img_upload_path);
                }													
             

                // aqui movemos a la base de datos
                $sql = "UPDATE usuarios SET Perfil = '$new_img_name' WHERE Correo = '$correo'";
               $resultado =  mysqli_query($conexion, $sql);
               
                header("location: ../php/perfil2admin.php?error=$resultado");
            }else{
                $em = "No puedes subir archivos de este tiopo";
		        header("Location: index.php?error=$em");
            }
        }
    }

}

?>     