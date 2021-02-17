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
    <!-- Header Main Container -->
    <div class="header-main">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="logo">
                    <a href="index.php""><img src="images/logo.png" alt="Globant"></a>
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
            <h1>Agregar Empleado</h1>
            <div class="card">
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col-12 col-md-10 offset-md-1">
                            <form method="post" name="add_employee" action="process.php" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="add">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="legajo" class="col-form-label">Legajo</label>
                                        <input type="text" class="form-control" id="legajo" name="legajo" tabindex="1" />
                                    </div>
                                    <div class="form-group offset-1 col-md-6">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                                        <label for="img_profile" class="col-form-label">Imagen</label>
                                        <input type="file" class="form-control" id="img_profile" name="img_profile" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="first_name" class="col-form-label">Nombre</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" tabindex="2" required />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="last_name" class="col-form-label">Apellido</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" tabindex="3" required />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" tabindex="4" placeholder="jmdiaz@mail.com" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="address" class="col-form-label">Dirección</label>
                                        <input type="text" class="form-control" id="address" tabindex="6" name="address" placeholder="Av Independencia 2110 3ºC" required />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="salary" class="col-form-label">Sueldo</label>
                                        <input type="number" class="form-control" id="salary" tabindex="8" name="salary" placeholder="250000" required />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="role" class="col-form-label">Role</label>
                                        <select name="role" id="role" class="form-control" tabindex="9">
                                            <option></option>
                                            <option>Programador</option>
                                            <option>Business Analyst</option>
                                            <option>QA</option>
                                            <option>Project Manager</option>
                                            <option>Tech Leader</option>
                                            <option>Diseñador UI</option>
                                            <option>Diseñador Gráfico</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 text-right">
                                        <a href="index.php"><input type="button" id='btn_cancel' class='btn btn-danger btn-md' value="Cancelar" /></a> <!-- Cambie el href y el tipo -->
                                        <input type="submit" id='btn_add' class='btn btn-success btn-md' value="Enviar" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div> <!-- container -->

</body>
</html>
