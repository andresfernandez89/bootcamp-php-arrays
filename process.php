<?php
session_start();
$empleados = $_SESSION['empleados'];


if (isset($_POST['action']) || isset($_GET['action'])) {

    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = "";
    }


    switch ($action){
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
        default:
            return_index();
    }
}

function add_employee($empleados){
    // Recupero los datos
    $campos = [];
    $legajo = isset($_POST['legajo']) ? strtoupper($_POST['legajo']) : "";
    $first_name = isset($_POST['first_name']) ? ucwords($_POST['first_name']) : "";
    $last_name = isset($_POST['last_name']) ? ucwords($_POST['last_name']) : "";
    $email = isset($_POST['email']) ? strtolower($_POST['email']) : "";
    $address = isset($_POST['address']) ? ucwords($_POST['address']) : "";
    $salary = isset($_POST['salary']) ? $_POST['salary'] : "";
    $role = isset($_POST['role']) ? $_POST['role'] : "";
/*     if($legajo == "") {           TERMINAR DE ARMARLO
        array_push($campos, "El campo Legajo no puede estar vacio");
    }
    if(count($campos) > 0) {          
        foreach ($campos as $key => $value) {
            echo "<li>$value</li>";
        }
    } */
    $empleado_new = [
        "legajo" => $legajo,
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
        $empleados[$employee_id]['legajo'] = isset($_POST['legajo']) ? strtoupper($_POST['legajo']) : "";
    }
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
            //array_push($search_id, $search_fn);
            $search_id = array_merge($search_id, $search_fn);
        }
        if (count($search_ln) != 0) {
            $search_id = array_merge($search_id, $search_ln);
        }
    };
    $_SESSION['search_id'] = $search_id;
}

function return_index() {
    header('LOCATION: index.php');
}

function save_empleados($empleados) {
    unset($_SESSION['empleados']);
    $_SESSION['empleados'] = $empleados;
}
