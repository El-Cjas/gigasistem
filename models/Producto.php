<?php
require_once 'Conexion.php';
require_once 'entidades/Producto.php';

class Producto {
    private $id, $nombre, $descripcion, $codigo;
    private $precioCompra;
    private $precioVenta, $stock, $idCategoria;
    
    public function __construct() {
        $this->id = '';
        $this->nombre = '';
        $this->descripcion = '';
        $this->codigo = '';
        $this->precioCompra = 0;
        $this->precioVenta = 0;
        $this->stock = 0;
        $this->idCategoria = '';
    }

    public function getId() {
        return $this->id;
    }
    
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre): self {
        $this->nombre = $nombre;
        return $this;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function setDescripcion($descripcion): self {
        $this->descripcion = $descripcion;
        return $this;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }
    
    public function setCodigo($codigo): self {
        $this->codigo = $codigo;
        return $this;
    }
    //fin de encapsulamiento
    
    public function obtenerTodosProductos() {
    $sql = " SELECT 
            p.ID, 
            p.nombre, 
            p.descripcion, 
            p.codigo, 
            c.nombre AS categoria, 
            p.precio_compra, 
            p.precio_venta, 
            p.stock
        FROM producto p    
        JOIN categoria c ON c.ID = p.ID_categoria
        WHERE p.borrado_en IS NULL
        ORDER BY p.ID ASC
    ";
        return seleccionar($sql);
    }

    public function registrarProducto(Producto $producto) {
        $sql = "INSERT INTO producto(nombre, descripcion, codigo, precio_compra, precio_venta, stock, ID_categoria) 
                VALUES ({$this->nombre}, {$this->descripcion}, {$this->codigo}, {$this->precioCompra}, {$this->precioVenta}, {$this->stock}, {$this->idCategoria})";
        return ejecutarSQL($sql);
    }    
    
    public function actualizarProducto($producto) {
        $sql = "UPDATE producto SET 
        nombre = :nombre, 
        descripcion = :descripcion, 
        codigo = :codigo, 
        precio_compra = :precio_compra, 
        precio_venta = :precio_venta, 
        ID_categoria = :ID_categoria 
        WHERE ID = {$this->id}";
        return ejecutarSQL($sql);
    }    
    public function obtenerProductoPorId($id) {
        $sql = "SELECT * FROM producto WHERE ID = {$this->id} AND borrado_en IS NULL";
        return seleccionar($sql);
    }
       public function buscarProductos($termino) {
       $sql = "SELECT p.*, c.nombre AS categoria 
               FROM producto p 
               JOIN categoria c ON p.ID_categoria = c.ID 
               WHERE (p.nombre LIKE :termino OR c.nombre LIKE :termino OR p.descripcion LIKE :termino) 
               AND p.borrado_en IS NULL";        
        return seleccionar($sql);
   }    
    //este metodo esta solo para unas pruebas que estuve haciendo xdd 
    public function obtenerProductoID($id) {
        $sql = "SELECT * FROM producto WHERE ID = ? AND borrado_en IS NULL";
        return seleccionar($sql);
    }
    //este metodo es para eliminar un producto, en realidad no lo elimina, solo lo marca como borrado
    //esto es para que no se pierdan los datos de las entradas y salidas de productos
    //ya que si se eliminara, se perderian los datos de las entradas y salidas de productos
    //por eso se marca como borrado, para que no se muestre en las consultas normales
    //pero si se puede acceder a los datos de las entradas y salidas de productos
    //si se necesita acceder a los productos borrados, se puede hacer
    //con una consulta que no tenga la condicion de borrado
    //por ejemplo: SELECT * FROM producto WHERE borrado_en IS NOT NULL
    //pero eso no se hace en este modelo, ya que no es necesario
    //si se necesita acceder a los productos borrados, se puede hacer en el controlador
    //o en una consulta especifica
    //por eso se usa el campo borrado_en, para marcar como borrado un producto
    //y no perder los datos de las entradas y salidas de productos
    //esto es una buena practica para no perder los datos de las entradas y salidas de productos
    //y poder acceder a los datos de los productos borrados si es necesario

    public function eliminarProducto($id) {
        $sql = "DELETE FROM producto WHERE ID = ?";
        return seleccionar($sql);
    }
    public function buscarProducto($termino) {    
        $sql = "SELECT
                    p.ID,
                    p.nombre,
                    p.descripcion,
                    p.codigo,
                    c.nombre AS categoria,
                    p.precio_compra,
                    p.precio_venta,
                    p.stock
                FROM
                    producto p
                JOIN categoria c ON
                    c.ID = p.ID_categoria
                WHERE
                    p.borrado_en IS NULL AND p.descripcion OR p.nombre OR p.codigo LIKE {$termino}--hay que ver si eso no es haceable
                ORDER BY
                    p.ID ASC";
        return seleccionar($sql);
    }

}//fin de la clase


?>