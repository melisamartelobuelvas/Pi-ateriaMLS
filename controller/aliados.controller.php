<?php

class AliadosController{
    
    
    public function __CONSTRUCT(){
    }
    
    public function Index(){
        $json = file_get_contents('https://www.datos.gov.co/resource/hyyt-j46k.json');
        $dato = json_decode($json);
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/aliados/listar.php';
        require_once 'view/footer.php';
    }

    public function Buscar(){
        if(empty($_REQUEST['regimen'])){
            header('Location: /aliados/');
        }
        $json = file_get_contents('https://www.datos.gov.co/resource/hyyt-j46k.json?regimen='.$_REQUEST['regimen']);
        $dato = json_decode($json);
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/aliados/listar.php';
        require_once 'view/footer.php';
    }
}