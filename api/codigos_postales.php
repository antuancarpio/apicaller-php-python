<?php
//Este API regresa las colonias asociadas al codigo postal
//Validamos que envie el codigo postal
header("Content-Type: application/json; charset= utf-8");

if (empty($_GET["codigo"])) {
    http_response_code(400);
    echo json_encode(["error"=>"falta el parametro 'codigo'"]);
    exit;
}

$codigo = trim($_GET["codigo"]);
//NOS CONECTAMOS A LA BASE DE DATOS

$con = mysqli_connect("localhost","root","","database");
//SI NO NOS PUDIMOS CONECTAR

if(!$con){
    http_response_code(500);
    echo json_encode(["error"=>"error de conexion a la base de datos"]);
}

mysqli_set_charset($con,"utf8mb4");

$consulta = mysqli_prepare($con,"select `from` from `table` where `select` = ?");

mysqli_stmt_bind_param($consulta, "i", $codigo);

mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);

$colonias = [];

while($row=mysqli_fetch_assoc($resultado)){
    $colonias[] = $row["from"];
}

echo json_encode($colonias,JSON_UNESCAPED_UNICODE);

mysqli_stmt_close($consulta);

mysqli_close($con);

?>