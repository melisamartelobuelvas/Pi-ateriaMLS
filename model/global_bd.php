<?php
class global_bd
{
	private $pdo;
	private $tabla;

	public function __CONSTRUCT($tbl)
	{
		try
		{	
			$this->tabla = $tbl;
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{

			$stm = $this->pdo->prepare("SELECT * FROM $this->tabla");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id,$columnid="id")
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM $this->tabla WHERE $columnid = '$id'");   
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("DELETE FROM $this->tabla WHERE id = $id");
			$stm->execute();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($datos,$id,$columnid="id")
	{
		try 
		{
			$sql = "UPDATE $this->tabla SET ";
			while ($column=current($datos)) {
			    $sql=$sql.key($datos)."='".$column."'";
			    next($datos);
			    if(current($datos)){
			    	$sql=$sql.",";
			    }
			}
			$sql=$sql." WHERE $columnid='".$id."'";
			return $this->pdo->query($sql)->execute();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar($datos)
	{
		try 
		{
			$datos2=$datos;
			$sql = "INSERT INTO $this->tabla (";
			while (current($datos)) {
			    $sql=$sql.key($datos);
			    next($datos);
			    if(current($datos)){
			    	$sql=$sql.",";
			    }
			}

			$sql = $sql.") VALUES (";

			while ($column = current($datos2)) {
			    $sql=$sql."'".$column."'";
			    next($datos2);
			    if(current($datos2)){
			    	$sql=$sql.",";
			    }
			}

			$sql = $sql.")";

		   $this->pdo->prepare($sql)->execute();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Buscar($column,$text,$omitir=false,$id_omitir=0)
	{
		try 
		{
			$sql = "SELECT * FROM $this->tabla WHERE ";
			for ($i=0; $i < count($column); $i++) { 
				
				$sql=$sql.$column[$i]." LIKE '%".$text."%' ";
				if($i<count($column)-1){
					$sql=$sql."or ";
				}
			}
                        if($omitir){
                            $sql.="and id != '".$id_omitir."'";
                        }
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
        
        public function Existe($column,$text)
	{
            try 
            {
                $sql = "SELECT * FROM $this->tabla WHERE ";
                for ($i=0; $i < count($column); $i++) { 

                    $sql=$sql.$column[$i]." = '".$text."' ";
                    if($i<count($column)-1){
                            $sql=$sql."or ";
                    }
                }
                
                $stm = $this->pdo->prepare($sql)->execute();
                return $stm;
            } catch (Exception $e) 
            {
                die($e->getMessage());
            }
	}
}