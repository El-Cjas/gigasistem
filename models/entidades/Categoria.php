<?php
class Categoria{
    private $id;
    private $nombre,$descripcion;

    //constructor para inicializar los atributos de la clase
    //recibe un array asociativo con los datos de la categoria
    public function __construct($datos) {
        $this->id = $datos["ID"] ?? 0;
        $this->nombre = $datos["nombre"];
        $this->descripcion = $datos["descripcion"];
    }
    //metodo para obtener el id de la categoria
    public function getId() {
        return $this->id;
    }
    //metodo para obtener el nombre de la categoria
    public function getNombre() {
        return $this->nombre;
    }
    //metodo para obtener la descripcion de la categoria
    public function getDescripcion() {
        return $this->descripcion;
    }
    //metodo para obtener los datos de la categoria en un array asociativo
    public function getDatos() {
        return [
            //":ID" => $this->id, //no se si esto ira
            ":nombre" => $this->nombre,
            ":descripcion" => $this->descripcion
        ];
    }
    //metodo para obtener los datos de la categoria en formato JSON
    public function getDatosJson() {
        return json_encode($this->getDatos());
    }
    public function verificarDatos(){
        // si algunas de estas dos variables estan vacias me tira false
        return !empty($this->nombre) && !empty($this->descripcion);
    }
    //metodo para validar los datos de la categoria
    public function validarDatos() {
        if (empty($this->nombre) || empty($this->descripcion)) {
            echo "Todos los campos son obligatorios.";
            return false;
        }
        if (strlen($this->nombre) < 3) {
            echo "El nombre debe tener al menos 3 caracteres.";
            return false;
        }
        if (strlen($this->descripcion) < 5) {
            echo "La descripción debe tener al menos 5 caracteres.";
            return false;
        }
        return true;
    }
}




?>