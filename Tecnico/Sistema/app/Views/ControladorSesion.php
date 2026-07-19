<?php

require_once('../MODEL/modlogin.php'); 

if (isset($_POST['correo']) && !empty($_POST['correo']) 
&& isset($_POST['contrasena']) && !empty($_POST['contrasena'])) {

    $correoIN = $_POST['correo']; 
    $contraIN = $_POST['contrasena'];

    try {
        $objUsuario = new modeloUsuario(NULL,NULL,NULL,NULL,$correoIN,NULL,NULL,NULL,NULL,NULL); 
        $consultaLogin = $objUsuario->consultalogin(); 
        
        $usuarioBD = $consultaLogin->correoUsuario; 
        $contraBD =  $consultaLogin->contraseña;
        $estadoUsuarioBD = $consultaLogin->estadoUsuario;
        $tipoUsuarioBD = $consultaLogin->idRolFK; 
        
        if ($correoIN == $usuarioBD) {
            if ($contraIN == $contraBD) {
                session_start(); 
                $_SESSION['correo'] = $usuarioBD; 

                if ($tipoUsuarioBD == 2) {
                    if ($estadoUsuarioBD == "Activo") {
                        echo '<script type="text/javascript">
                            alert("¡¡INGRESO EXITOSO ADMINISTRADOR!!");    
                            window.location.href="../VIEW/perfil/admin-perfil.php"; 
                            </script>';
                    } else {
                        echo '<script type="text/javascript">
                            alert("ERROR: Estado Inactivo");   
                            window.location.href="../VIEW/login.php";  
                            </script>';
                    }

                } elseif ($tipoUsuarioBD == 1) {
                    if ($estadoUsuarioBD == "Activo") {
                        echo '<script type="text/javascript">
                            alert("¡¡INGRESO EXITOSO CLIENTE!!");    
                            window.location.href="../VIEW/cliente-perfil.php";
                            </script>';
                    } else {
                        echo '<script type="text/javascript">
                            alert("ERROR: Estado Inactivo");   
                            window.location.href="../VIEW/login.php";  
                            </script>';
                    }

                } elseif ($tipoUsuarioBD == 3) {
                    if ($estadoUsuarioBD == "Activo") {
                        echo '<script type="text/javascript">
                            alert("¡¡INGRESO EXITOSO DOMICILIARIO!!");    
                            window.location.href="../VIEW/domiciliario-perfil.php";
                            </script>';
                    } else {
                        echo '<script type="text/javascript">
                            alert("ERROR: Estado Inactivo");   
                            window.location.href="../VIEW/login.php";  
                            </script>';
                    }

                } else {
                    echo '<script type="text/javascript">
                        alert("ERROR: Tipo de usuario no reconocido");  
                        window.location.href="../VIEW/login.php";    
                        </script>';
                }

            } else {
                echo '<script type="text/javascript">
                    alert("ERROR: Contraseña incorrecta");   
                    window.location.href="../VIEW/login.php";
                    </script>';
            }
        } else {
            echo '<script type="text/javascript">
                alert("ERROR: Correo incorrecto");  
                window.location.href="../VIEW/login.php";    
                </script>';
        }

    } catch (\Throwable $error) {
        echo 'ERROR: '. $error->getMessage();  
        die(); 
    }

} else {
    header('location: ../VIEW/MenuPrincipal.php'); 
}

?>
