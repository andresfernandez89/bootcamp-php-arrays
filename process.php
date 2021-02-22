<?php
session_start();
$empleados = isset($_SESSION['empleados'])? $_SESSION['empleados']: "";


if (isset($_POST['action']) || isset($_GET['action'])) {

    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = "";
    }


    switch ($action){
        case("sesion"):
            sesion();
            break;
        case("add"):
            add_employee($empleados);
            return_index();
            break;
        case("del"):
            $employee_id = isset($_GET['id']) ? $_GET['id'] : "";
            del_employee($employee_id, $empleados);
            return_index();
            break;
        case("edit"):
            $employee_id = isset($_POST['id']) ? $_POST['id'] : "";
            edit_employee($employee_id, $empleados);
            return_index();
            break;
        case("search"):
            $keywords = isset($_GET['keywords']) ? ucwords($_GET['keywords']) : "";
            search($keywords, $empleados);
            header('LOCATION: search.php');
            break;
        case("order"):
            $order = isset($_GET['order']) ? $_GET['order'] : "";
            orderName($empleados, $order);
            header('LOCATION: order.php');
            break;
        default:
            return_index();
    }
}

function sesion() {
    if($_POST["email"] == "andres_f89@hotmail.com" && $_POST["password"] ==123) {
        $nombreUsuario = "Andres Fernandez";
        $sesionIniciada = true;
        setcookie("usuario", $nombreUsuario,time()+60*30, '/Bootcamp-PHP/bootcamp-php-arrays/', 'localhost', false, true);
        $_SESSION["usuario"] = $_POST["email"];
        setcookie("email", $_POST["email"],time()+60*30, '/Bootcamp-PHP/bootcamp-php-arrays/', 'localhost', false, true);
        setcookie("password", $_POST["password"],time()+60*30, '/Bootcamp-PHP/bootcamp-php-arrays/', 'localhost', false, true);
        header('LOCATION: sesionOK.php');
    }
}

function add_employee($empleados){
    // Recupero los datos
    $legajo = isset($_POST['legajo']) ? strtoupper($_POST['legajo']) : "";
    $img_profile = uploadImg();
    $first_name = isset($_POST['first_name']) ? ucwords($_POST['first_name']) : "";
    $last_name = isset($_POST['last_name']) ? ucwords($_POST['last_name']) : "";
    $email = isset($_POST['email']) ? strtolower($_POST['email']) : "";
    $address = isset($_POST['address']) ? ucwords($_POST['address']) : "";
    $salary = isset($_POST['salary']) ? $_POST['salary'] : "";
    $role = isset($_POST['role']) ? $_POST['role'] : "";

    $empleado_new = [
        "legajo" => $legajo,
        "img_profile" => $img_profile,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "address" => $address,
        "email" => $email,
        "salary" => $salary,
        "rol" => $role,
    ];
    if (validate_duplicate($empleados, $legajo)) {
        array_push($empleados, $empleado_new);
        save_empleados($empleados);
    }
}

function edit_employee($employee_id, $empleados) {
    $legajo = isset($_POST['legajo']) ? strtoupper($_POST['legajo']) : "";
    if (validate_duplicate($empleados, $legajo)) {
        $empleados[$employee_id]['legajo'] = $legajo;
    }
    $empleados[$employee_id]['img_profile']  = uploadImg();
    $empleados[$employee_id]['first_name'] = isset($_POST['first_name']) ? ucwords($_POST['first_name']) : "";
    $empleados[$employee_id]['last_name'] = isset($_POST['last_name']) ? ucwords($_POST['last_name']) : "";
    $empleados[$employee_id]['email'] = isset($_POST['email']) ? strtolower($_POST['email']) : "";
    $empleados[$employee_id]['address'] = isset($_POST['address']) ? ucwords($_POST['address']) : "";
    $empleados[$employee_id]['salary'] = isset($_POST['salary']) ? $_POST['salary'] : "";
    $empleados[$employee_id]['rol'] = isset($_POST['role']) ? $_POST['role'] : "";
    save_empleados($empleados);
}

function validate_duplicate($empleados, $legajo) {
    if (!in_array($legajo, array_column($empleados, 'legajo')))
    return true;
    else
    return false;
}


function del_employee($employee_id, $empleados) {
    if (in_array($employee_id, array_keys($empleados))) {
        unset($empleados[$employee_id]);
        save_empleados($empleados);
    }
}

function search($keywords, $empleados) {
    $first_name = array_column($empleados, 'first_name');
    $last_name = array_column($empleados, 'last_name');
    $search_id = [];
    $keywords = explode(" ", $keywords);
    foreach ($keywords as $key => $keyword) {
        $search_fn = array_keys($first_name, $keyword);
        $search_ln = array_keys($last_name,$keyword);
        if (count($search_fn) != 0) {
            $search_id = array_merge($search_id, $search_fn);
        }
        if (count($search_ln) != 0) {
            $search_id = array_merge($search_id, $search_ln);
        }
    };
    $_SESSION['search_id'] = $search_id;
}

function uploadImg() {
    if ($_FILES["img_profile"]["error"] == UPLOAD_ERR_OK) {
        $directorio = 'uploads/';
        $nombre_tmp = $_FILES["img_profile"]["tmp_name"];
        $nombreArchivo = $directorio . basename($_FILES["img_profile"]["name"]);
        $nombreNuevo = isset($_POST['legajo']) ? $directorio . strtoupper($_POST['legajo']) : "";
        if (isset($nombreNuevo)) {
            $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            $nombreNuevo .= '.' . $tipoArchivo;
            if($tipoArchivo === "jpg" || $tipoArchivo === "png") {
                if(move_uploaded_file($nombre_tmp, $nombreArchivo)) {
                    rename($nombreArchivo, $nombreNuevo);
                    return $nombreNuevo;
                }else {
                    return $msj='Hubo un error en la subida del archivo';
                }
            } else {
                return $msj='Solo se admiten archivos jpg o png';
            }
        } else {
            return $msj = "No se encontraron archivos.";
        }
    }
}

function return_index() {
    header('LOCATION: sesionOK.php');
}

function save_empleados($empleados) {
    unset($_SESSION['empleados']);
    $_SESSION['empleados'] = $empleados;
}

function orderName($empleados, $order) {
    $campos = array_column($empleados, $order);
    asort($campos);
    $orderKeys = array_keys($campos);
    $newEmpleados = [];
    foreach ($orderKeys as $value) {
        array_push($newEmpleados, $empleados[$value]);
    }
    $empleados = array_replace($empleados, $newEmpleados);
    save_empleados($empleados);
}
