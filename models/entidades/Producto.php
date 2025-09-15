<?php

class Producto {
    private $ID;
    private $nombre;
    private $descripcion;
    private $codigo;
    private $precio_compra;
    private $precio_venta;
    private $stock;
    private $ID_categoria;

    public function __construct(array $datos) {
        $this->ID = $datos['ID'] ?? null;
        $this->nombre = $datos['nombre'] ?? null;
        $this->descripcion = $datos['descripcion'] ?? null;
        $this->codigo = $datos['codigo'] ?? null;
        $this->precio_compra = $datos['precio_compra'] ?? null;
        $this->precio_venta = $datos['precio_venta'] ?? null;
        // Se asegura de que stock siempre tenga un valor, evitando el warning "Undefined array key"
        $this->stock = $datos['stock'] ?? 0;
        $this->ID_categoria = $datos['ID_categoria'] ?? null;
    }

    // Getters
    public function getID() { return $this->ID; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getCodigo() { return $this->codigo; }
    public function getPrecioCompra() { return $this->precio_compra; }
    public function getPrecioVenta() { return $this->precio_venta; }
    public function getStock() { return $this->stock; }
    public function getIDCategoria() { return $this->ID_categoria; }

    public function getDatos(): array {
        return [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'codigo' => $this->codigo,
            'precio_compra' => $this->precio_compra,
            'precio_venta' => $this->precio_venta,
            'stock' => $this->stock,
            'ID_categoria' => $this->ID_categoria,
        ];
    }

    public function getDatosConID(): array {
        return [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'codigo' => $this->codigo,
            'precio_compra' => $this->precio_compra,
            'precio_venta' => $this->precio_venta,
            'ID_categoria' => $this->ID_categoria,
            'ID' => $this->ID
        ];
    }

    public function validarDatos(): bool {
        if (empty($this->nombre) || empty($this->descripcion) || empty($this->codigo) || empty($this->ID_categoria)) {
            return false;
        }

        if (!is_numeric($this->precio_compra) || $this->precio_compra < 0 || !is_numeric($this->precio_venta) || $this->precio_venta < 0) {
            return false;
        }

        // --- VALIDACIÓN DE PRECIO MÁXIMO ---
        $precioMaximo = 999999999.99;
        if ($this->precio_compra > $precioMaximo || $this->precio_venta > $precioMaximo) {
            return false; // El precio es demasiado grande
        }

        return true;
    }
}
