<?php
require_once 'Modelo/conexion.php'; 

class Producto {
    private $db;

    public function __construct() {
        $this->db = Conexion::getInstancia(); // Usamos el singleton
    }

    public function insertar($codigo, $producto, $precio, $cantidad) {
        $sql = "INSERT INTO productos (codigo, producto, precio, cantidad) 
                VALUES (?, ?, ?, ?)";
        return $this->db->insertSeguro($sql, [$codigo, $producto, $precio, $cantidad]);
    }

    public function actualizar($id, $codigo, $producto, $precio, $cantidad) {
        $sql = "UPDATE productos 
                SET codigo = ?, producto = ?, precio = ?, cantidad = ? 
                WHERE id = ?";
        return $this->db->updateSeguro($sql, [$codigo, $producto, $precio, $cantidad, $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        return $this->db->insertSeguro($sql, [$id]); // insertSeguro = execute seguro
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        return $this->db->queryOne($sql, [$id]);
    }

    public function listar() {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        return $this->db->query($sql);
    }

    public function buscar($valor) {
        $sql = "SELECT * FROM productos 
                WHERE id LIKE ? OR producto LIKE ? OR precio LIKE ?";
        $like = "%$valor%";
        return $this->db->query($sql, [$like, $like, $like]);
    }
}
