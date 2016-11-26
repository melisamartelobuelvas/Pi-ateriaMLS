<?php
if(!isset($_SESSION)){
    session_start();
}
$_SESSION['errores']=[];
require_once 'model/global_bd.php';

class UsuarioController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new global_bd("usuario");
    }
    
    public function Index(){
        $dato = $this->model->Listar();
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        if(isset($_SESSION['rol']) && $_SESSION['rol']=='administrador'){
            require_once 'view/usuario/listar.php';
        }else {
            require_once 'view/usuario/ingresar.php'; 
        }
        require_once 'view/footer.php';
    }

    public function Ver(){
        if(isset($_REQUEST['id'])){
            $dato = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'include/util.php';
        require_once 'view/usuario/ver.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){

        $dato=null;
        if(isset($_REQUEST['id'])){
            $dato = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/lateral.php';
        require_once 'view/usuario/registrar.php';
        require_once 'view/footer.php';
    }
    
    
    public function Guardar(){
        
        $codigo=md5(time());
        
        $datos = array(
            'nombre' => $_REQUEST['nombre'], 
            'identificacion' => $_REQUEST['identificacion'],
            'direccion' => $_REQUEST['direccion'], 
            'telefono' => $_REQUEST['telefono'],
            'usuario' => $_REQUEST['usuario'], 
            'correo' => $_REQUEST['correo'],
            'verificador' => $codigo,
            'clave' => crypt($_REQUEST['clave'])
            );
        
        $resultado=$this->model->Buscar(['correo'],$_REQUEST['correo']);
        if(!$resultado){
            require_once 'include/util.php';
            correo_confirmacion($_REQUEST['correo'],$codigo);
        }
        
        $_REQUEST['id']>0?$this->model->Actualizar($datos,$_REQUEST['id']):$this->model->Registrar($datos);
        
        header('Location: /usuario');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: /usuario');
    }

    public function Buscar(){

        $dato = $this->model->Buscar(['usuario','correo'],$_REQUEST['buscar']);

        require_once 'view/header.php';
        require_once 'view/usuario/listar.php';
        require_once 'view/footer.php';
    }

    public function Verificar_usuario(){
        
        $resultado=$this->model->Buscar(['usuario'],$_REQUEST['usuario']);
        if(!$resultado){
            echo 'ok';
        }else{
            echo 'bad';
        }
    }
    
    public function Iniciar_sesion(){
        $dato = $this->model->Obtener($_REQUEST['usuario'],'usuario');
        if(password_verify($_REQUEST['clave'],$dato->clave)){
            if($dato->activo=="1"){
                $_SESSION['id']=$dato->id;
                $_SESSION['rol']=$dato->administrador==1?"administrador":"usuario";
                header('Location: /usuario/');
            }else{
                array_push($_SESSION['errores'],"El usuario no ha confirmado el correo");
            }
        }else{
            array_push($_SESSION['errores'],"La combinacion de usuario y contraseña no son correctas");  
        }
        $this->Index();
    }
    
    public function Cerrar_sesion(){
        unset($_SESSION['id']);
        unset($_SESSION['rol']);
        header('Location: /usuario/');
    }
    
    public function Confirmar() {
        $dato = $this->model->Obtener($_REQUEST['id'],'verificador');
        if($dato!=null){
            if(!$dato->activo){
                $this->model->Actualizar(['activo'=>true],$_REQUEST['id'],'verificador');
                echo "Correo confirmado";
            }else{
                array_push($_SESSION['errores'],"El correo ya ha sido confirmado antes");
            }
        }else{
            array_push($_SESSION['errores'],"Codigo de confirmacion no encontrado");
        }
        $this->Index();
    }
    
}