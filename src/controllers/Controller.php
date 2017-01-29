<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

use \Slim\Container;
/**
 * Description of Controller
 *
 * @author nelson
 */
class Controller
{
    /**
     * Slim DI Container
     *
     * @var \Slim\Container
     */
    protected $container;

    /**
     * Construtor
     *
     * @param object $c
     * @return void
     */
    public function __construct(Container $c)
    {
        $this->container = $c;
    }
    
    public static function xml($data)
    {
        $xml_user_info = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><empleados></empleados>");
        self::_array_to_xml($data, $xml_user_info);

        return  $xml_user_info->asXML();
    }
    
    public static function _array_to_xml($array, &$xml_user_info) 
    {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml_user_info->addChild("$key");
                    self::_array_to_xml($value, $subnode);
                }else{
                    $subnode = $xml_user_info->addChild("item$key");
                    self::_array_to_xml($value, $subnode);
                }
            }else {
                $xml_user_info->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}
