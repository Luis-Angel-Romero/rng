<?php
    include_once 'conexion/database.php';
    
    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // destroy the session 
        session_destroy(); 
    }
    
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: admin/admin.php');
            break;

            case 2:
                header('location: rg/rg.php');
            break;
                
            case 3:
                header('location: otro/otro.php');
            break;

            default:
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $query = $db->connect()->prepare('SELECT *FROM usuarios WHERE username = :username AND password = :password');
        $query->execute(['username' => $username, 'password' => $password]);

        $row = $query->fetch(PDO::FETCH_NUM);
        
        if($row == true){
            $rol = $row[3];
            
            $_SESSION['nom'] = $row[0];
            $_SESSION['rol'] = $rol;
            
            switch($rol){
                case 1:
                    header('location: admin/admin.php');
                break;

                case 2:
                    header('location: rg/rg.php');
                break;
                    
                case 3:
                    header('location: otro/otro.php');
                break;

                default:
            }
        }else{
            // no existe el usuario
            echo '
            <p class="bg-danger" align="center">
                <div class="row">
  					<div class="col-md-4"></div>
    				<div class="col-md-4">
                        <div class="alert alert-danger">
                            <strong>Cuidado!</strong> Nombre de usuario y/o contraseña incorrecto.
                        </div>
                    </div>
  		            <div class="col-md-4"></div>
				</div>
            </p>';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="img/logo.png">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <form action="#" method="POST">
       <div class="containes">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <center>
                    <br><br>
                    <h3><strong><font color="#1ab2ff">INICIAR SESIÓN</font></strong></h3>
                    <img src="img/logo.png" class="img-circle" width="200" height="200">                              
                    <br><br>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" class="form-control" name="username" placeholder="Usuario">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                                    <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/>
                                </svg>
                                <i class="bi bi-unlock-fill"></i>
                            </span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">       
                        </div><br>
                        <input type="checkbox" onclick="myFunction()">Mostrar contraseña.
                          <script>
                            function myFunction() {
                            var x = document.getElementById("password");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                              }
                            }
                          </script>
                          <br><br>
                        <input type="submit" class="btn btn-success" value="INICIAR SESIÓN">   
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>  
       </div>     
    </form>
</body>
</html>
