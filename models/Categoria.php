<?php
//include_once "entidades/Categoria.php";
include_once "funciones_comunes.php";
// Clase ModeloCategoria para manejar las operaciones relacionadas con la entidad Categoria
interface Operaciones{
    public function obtenerTodos() : array;
    public function obtenerPorID($id) : array;
    public function crear() : bool;
    public function editar() : bool;
    public function eliminar($id) : bool;
}

class Categoria
{
    private $id, $nombre, $descripcion, $borrado_en;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getBorradoEn()
    {
        return $this->borrado_en;
    }

    public function setBorradoEn($borrado_en): self
    {
        $this->borrado_en = $borrado_en;
        return $this;
    }

    public function __construct()
    {
        $this->id = "";
        $this->nombre = "";
        $this->descripcion = "";
        $this->borrado_en = "";
    }
    public function imprimirDatos(){
        echo "$this->id $this->nombre $this->descripcion";
    }
    // Método para obtener todas las categorías
    public function obtenerTodos(): array
    {
        $sql = "SELECT * FROM categoria WHERE borrado_en IS NULL"; //consulta para tener la lista de las categorias
        $resultado = seleccionar($sql);
        return $resultado; //retornando un array asociativo de la consulta
    }

    //metodo para crear la categoria
    public function crear(): bool
    {
        $sql = "INSERT INTO categoria(nombre, descripcion) VALUES (:nombre,:descripcion)";
        return ejecutarSQL($sql,[':nombre' => $this->nombre,':descripcion' => $this->descripcion]);
    }
    //metodo para eliminar la categoria
    public function eliminar(): bool
    {
        $sql = "DELETE FROM categoria WHERE ID = :id";
        return ejecutarSQL($sql, [":id"=>$this->nombre]);
    }
    //metodo para editar una categoria
    public function editar(): bool
    {
        $sql = "UPDATE categoria SET nombre = :nombre, descripcion = :descripcion WHERE ID = :id AND borrado_en IS NULL"; //la consulta verifica que no este borrada
        $parametros = [':id'=>$this->id,':nombre'=>$this->nombre,':descripcion'=>$this->descripcion];
        return ejecutarSQL($sql,$parametros);
    }
    //metodo para obtener una sola categoria por su ID
    public function obtenerPorID(): array
    {
        $sql = "SELECT * FROM categoria WHERE ID = :id AND borrado_en IS NULL"; //consulta para obtener una sola categoria por su ID
        $resultado = seleccionar($sql, [':id'=>$this->id]);
        return $resultado;
    }
    public function buscar()
    {
        $sql = "SELECT * FROM categoria WHERE nombre LIKE %?% AND borrado_en IS NULL"; // Consulta SQL para buscar por nombre
        $resultado = seleccionar($sql); //a ver si funciona la busqueda con el simbolo %
        return $resultado;
    }
}
header('Content-type: application/json');



//print_r($_POST);


$categoria = new Categoria();
if (isset($_GET["categoria"]) && $_GET["categoria"] == "consultar") {
    $resultado = $categoria->obtenerTodos();
    $categorias = json_encode($resultado);// convirtiendo array a json
    echo $categorias;
}
if (isset($_POST["categoria"]) && $_POST["categoria"] == "consultar1") {
    $categoria->setId($_POST["id"]);
    $resultado = $categoria->obtenerPorID();
    $categoria = json_encode($resultado);
    echo $categoria;
}
if (isset($_POST["categoria"]) && $_POST["categoria"] == "registrar") {
    $datos = json_decode($_POST["datos"], true);
    //$categoria->setId($datos["id"]);
    $categoria->setNombre($datos["nombre"]);
    $categoria->setDescripcion($datos["descripcion"]);
    //$categoria->imprimirDatos();
    echo $categoria->crear();
    // echo false;
}
if (isset($_POST["categoria"]) && $_POST["categoria"] == "editar") {
    $datos = json_decode($_POST["datos"], true);
    $categoria->setId($datos["id"]);
    $categoria->setNombre($datos["nombre"]);
    $categoria->setDescripcion($datos["descripcion"]);
    echo $categoria->editar();
}
if (isset($_POST["categoria"]) && $_POST["categoria"] == "eliminar") {
    $datos = json_decode($_POST["datos"], true);
    $categoria->setId($datos["id"]);
    echo $categoria->eliminar();
}
if (isset($_POST["categoria"]) && $_POST["categoria"] == "buscar") {
    $datos = json_decode($_POST["termino"], true);
    
}

// print_r($_SERVER)
// $pepe = new ModeloCategoria();
// $resultado = $pepe->obtenerCategorias();
//  print_r($resultado);


//$datos=  ["ID" => 5, "nombre" => "arroz", "descripcion" => "pan con cambur"];

//$categoria = new Categoria($datos);
//$xd = new ModeloCategoria();
//$xd->eliminarCategoria($categoria->getId());
//$xd->editarCategoria($categoria);
//$xd->crearCategoria($categoria);
//$xdx =  $xd->obtenerCategorias();
//print_r($xdx);
