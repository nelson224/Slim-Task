<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Models;
/**
 * Description of EmpleadoController
 *
 * @author nelson
 */
class EmpleadoController extends Controller
{

    public function buscar_por_salario(Request $request, Response $response, $args)
    {
 
        $empleados = Models\Empleado::obtener_empleados();
        $data = array();
        foreach ($empleados as $item)
        {
            $salario = str_replace(',', '', $item['salary']);
            $salario = str_replace('$', '', $salario);
            if ($salario >= $args['min'] && $salario <= $args['max'])
            {
                $data[] = $item;
            }
        }
        
        $xml = self::xml($data);
        $response->withHeader('Content-Type', 'application/xml');
        $body = $response->getBody();
        $body->write($xml);
        $response->withBody($body);

    }
    
    public function listar_empleados(Request $request, Response $response, $args)
    {
        $params = $request->getQueryParams();
        
        $empleados = Models\Empleado::obtener_empleados();
        $filtro = array();
        if ($params['email'])
        {
            foreach ($empleados as $item)
            {
                if (stripos($item['email'], $params['email']) !== False)
                {
                    $filtro[] = $item;
                }
            }            
        } else {
            $filtro = $empleados;
        }
        $data = ['empleados' => $filtro];
        
        $this->container->renderer->render($response, 'lista.phtml', $data);
    }
    
    public function mostrar_empleado(Request $request, Response $response, $args)
    {
        $empleados = Models\Empleado::obtener_empleados();
        $empleado = array();
        foreach ($empleados as $item)
        {
            if ($item['id'] == $args['id'])
            {
                $empleado = $item;
                foreach ($item['skills'] as $skill)
                {
                    $skills[] = $skill['skill'];
                }
                $empleado['skills'] = implode(', ', $skills);
                break;
            }
        }
        $data = ['empleado' => $empleado];

        $this->container->renderer->render($response, 'detalle.phtml', $data);
    }
}
