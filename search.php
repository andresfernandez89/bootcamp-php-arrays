<?php
session_start();
$empleados = $_SESSION['empleados'];
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
                <a href="index.php"><img src="images/logo.png" alt="Globant"></a>
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
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Listado de Empleados</h1>
            <div class="card">
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="form-group col-6 text-left">
                        <form action="process.php" name="search" method="get">
                            <input type="hidden" name="action" value="search">
                            <input type="text" class="form-control" name="keywords" placeholder="Ingrese las palabras clave (Nombre - Apellido)">
                            <input type="submit" class="btn btn-success mt-1" value="Buscar">
                            <a href="index.php"><input type="button" id='btn_cancel' class='btn btn-danger btn-md mt-1' value="Volver" /></a>
                        </form>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-info" href="add_form.php">Agregar</a>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Legajo</th>
                                        <th>Nombre y Apellido</th>
                                        <th>Dirección</th>
                                        <th>Email</th>
                                        <th>Sueldo</th>
                                        <th>Rol</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $search_id = $_SESSION['search_id'];
                                    foreach ($search_id as $value) {
                                    ?>
                                    <tr>
                                        <td><?=$empleados[$value]['legajo']?></td>
                                        <td><?=$empleados[$value]['first_name'] . ' ' . $empleados[$value]['last_name']?></td>
                                        <td><?=$empleados[$value]['address']?></td>
                                        <td><?=$empleados[$value]['email']?></td>
                                        <td><?=$empleados[$value]['salary']?></td>
                                        <td><?=$empleados[$value]['rol']?></td>
                                        <td>
                                            <a href="edit_form.php?action=edit&id=<?=$value?>">Editar</a>
                                            <a href="process.php?action=del&id=<?=$value?>">Eliminar</a>
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
    </div>
</div>

</body>
</html>
