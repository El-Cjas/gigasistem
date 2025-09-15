# TODO: Implementar paginación AJAX con jQuery en Dashboard

## Pasos a completar:

- [?] Agregar método `obtenerProductosPaginados($page, $limit)` en ModeloProducto.php
- [ ] Agregar método `listarProductosAjax()` en ControladorProducto.php para retornar JSON
- [ ] Modificar dashboard.php: remover bucle PHP, agregar script jQuery para cargar datos AJAX
- [ ] Agregar controles de paginación HTML en dashboard.php
- [ ] Probar la funcionalidad

# acomodar clases de modelo

## pasos a completar:
- [ ] Eliminar la conexion antigua de las clases
- [ ] Añadir atributos a la clase
- [ ] Añadir metodos get y set por cada atributo
- [ ] Arreglar consultas de los metodos
- [ ] reemplazar la logica de las consultas por las funciones del archivo funciones_comunes.php

### A considerar:
- [ ] acomodar logica de los set y get para validaciones