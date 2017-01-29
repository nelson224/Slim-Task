<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Models;
/**
 * Description of Empleado
 *
 * @author nelson
 */
class Empleado
{
    public function obtener_empleados()
    {
        $content = file_get_contents(__DIR__ . '/../../db/employees.json', true);
        return json_decode($content, true);       
    }
}
