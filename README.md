# Slim Framework

Lista simple de empleados

## Instalación

```bash
$ git clone https://github.com/nelson224/slim-task.git
$ composer install
```

## Rutas

* **GET** /
Muestra la lista de empleados con un campo de búsqueda por email.

* **GET** /empleado/{id}
Muestra los datos de un empleado.

* **GET** /salario/{min}/{max}
Realiza una búsqueda de empleados por un rango de salario y devuelve una lista en formato xml.
