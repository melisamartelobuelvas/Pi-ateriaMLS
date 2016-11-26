<?php
if(!isset($_SESSION)){
    session_start();
}
$_SESSION['errores']=[];
require_once 'model/global_bd.php';

class ProductoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        
        $this->model = new global_bd("producto");
    }
    
    public function Index(){
        $dato = $this->model->Listar();
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/producto/listar.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        if(isset($_SESSION['rol']) && $_SESSION['rol']=='administrador'){
            $dato=null;
            if(isset($_REQUEST['id'])){
                $dato = $this->model->Obtener($_REQUEST['id']);
            }

            require_once 'view/header.php';
            require_once 'view/lateral.php';
            require_once 'view/producto/registrar.php';
            require_once 'view/footer.php';
        }else{
            header('Location: /usuario/');
        }
        
    }
    
    public function Guardar(){
        if(isset($_SESSION['rol']) && $_SESSION['rol']=='administrador'){
            if(isset($_FILES['imagen'])){
                $dir_subida = 'assets/uploads/';
                $fichero_subido = $dir_subida . basename($_FILES['imagen']['name']);
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
                    $datos = array(
                        'nombre' => $_REQUEST['nombre'], 
                        'cantidad' => $_REQUEST['cantidad'], 
                        'preciodecompra' => $_REQUEST['preciodecompra'], 
                        'preciodeventa' => $_REQUEST['preciodeventa'],
                        'descripcion' => $_REQUEST['descripcion'], 
                        'ruta' => $fichero_subido
                        );
                    $this->ActualizarJSON();
                   $this->model->Registrar($datos);
                } else {
                    echo "¡Posible ataque de subida de ficheros!\n";
                }
            }  else if($_REQUEST['id']>0){
                $datos = array(
                        'nombre' => $_REQUEST['nombre'], 
                        'cantidad' => $_REQUEST['cantidad'],
                        'descripcion' => $_REQUEST['descripcion']
                        );
                    $this->ActualizarJSON();
                    $this->model->Actualizar($datos,$_REQUEST['id']);
            }  else {
                echo "Debe subir una imagen";
            }

            
            //header('Location: /producto/');
        }else{
            //header('Location: /usuario/');
        }
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        $this->ActualizarJSON();
        header('Location: /producto/');
    }
    
    public function AggAlCarrito(){
        array_push($_SESSION["carrito"],[$_REQUEST['cantidad'],$_REQUEST['id']]);
        print_r($_SESSION["carrito"]);
    }
    
    public function Carrito() {
        $dato = [];
        $i=0;
        foreach($_SESSION["carrito"] as $p){
            $prod=$this->model->Obtener($p[1]);
            array_push($dato,[posicion=>$i,id=>$p[1],cantidad=>$p[0],nombre=>$prod->nombre,imagen=>$prod->ruta]);
            $i++;
        }
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/producto/carrito.php';
        require_once 'view/footer.php';
    }
    
    public function EliminarCarrito(){
        echo $_REQUEST['id'];
        unset($_SESSION["carrito"][$_REQUEST['id']]);
        
        //header('Location: /producto/carrito/');
    }
    
    public function ActualizarJSON(){
        $dato = $this->model->Listar();
        //header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode($dato);
        $file = 'assets/json/productos.json';
        file_put_contents($file, $json_string);
    }
    
    public function Buscar(){

        $dato = $this->model->Buscar(['nombre','descripcion'],$_REQUEST['buscar']);

        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/producto/listar.php';
        require_once 'view/footer.php';
    }
}