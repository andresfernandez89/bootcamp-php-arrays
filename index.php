<?php
session_start();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica Arrays</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <!-- Header Main Container -->
        <div class="header-main">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="logo">
                            <a href="sesionOK.php"><img src="images/logo.png" alt="Globant"></a>
                        </div>
                    </div>
                    <div class="col-6 col-md-8">
                        <nav>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-12 bg-image "></div>
            <div class="col-md-8 col-lg-12 ">
                <h4 class="text-center mt-3">
                    <?php if ($_SESSION["usuario"]) {
                        echo isset($_COOKIE["usuario"])? "Sesion Iniciada de " . $_COOKIE["usuario"]:"";
                    }else {
                        echo "Sesion No iniciada";
                    }
                    /* echo isset($_SESSION["usuario"])? "Sesion Iniciada de " . $_COOKIE["usuario"]:"Sesion No iniciada"; */?>
                </h4>
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-6 mx-auto">
                                <h3 class="login-heading mb-4">Bienvenido</h3>
                                <form action="process.php" method="post" name="sesion">
                                <input type="hidden" name="action" value="sesion">
                                <div class="form-label-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email address" autofocus>
                                    <label for="email">Email address</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    <label for="password">Password</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember password</label>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                                <div class="text-center">
                                    <a class="small" href="#">Forgot password?</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>