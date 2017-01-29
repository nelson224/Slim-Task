<?php
// Routes

/*$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/

$app->get("/", "Controllers\EmpleadoController:listar_empleados");
$app->get("/empleado/{id}", "Controllers\EmpleadoController:mostrar_empleado");
$app->get("/salario/{min}/{max}", "Controllers\EmpleadoController:buscar_por_salario");