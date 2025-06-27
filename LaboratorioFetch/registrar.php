<?php
require_once 'Modelo/producto.php';

$producto = new Producto();

$accion = $_POST['accion'] ?? '';
$valor = $_POST['valor'] ?? '';
$id = $_POST['id'] ?? null;

switch ($accion) {
    case 'listar':
        $productos = $producto->listar();
        echo json_encode($productos);
        break;

    case 'buscar':
        $productos = $producto->buscar($valor);
        echo json_encode($productos);
        break;

    case 'registrar':
        $codigo = $_POST['codigo'] ?? '';
        $pro = $_POST['producto'] ?? '';
        $precio = $_POST['precio'] ?? 0;
        $cantidad = $_POST['cantidad'] ?? 0;

      
        if (empty($pro) || $precio <= 0) {
            echo json_encode([
                "success" => false,
                "error" => "Producto y precio son requeridos y válidos"
            ]);
            exit;
        }

        $res = $producto->insertar($codigo, $pro, $precio, $cantidad);
        if ($res) {
            echo json_encode([
                "success" => true,
                "message" => "Producto registrado correctamente"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "error" => "Error al registrar producto"
            ]);
        }
        break;

    case 'modificar':
        if ($id) {
            $codigo = $_POST['codigo'] ?? '';
            $pro = $_POST['producto'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $cantidad = $_POST['cantidad'] ?? 0;

            if (empty($pro) || $precio <= 0) {
                echo json_encode([
                    "success" => false,
                    "error" => "Producto y precio son requeridos y válidos"
                ]);
                exit;
            }

            $res = $producto->actualizar($id, $codigo, $pro, $precio, $cantidad);
            if ($res) {
                echo json_encode([
                    "success" => true,
                    "message" => "Producto modificado correctamente"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "error" => "Error al modificar producto"
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "error" => "ID requerido para modificar"
            ]);
        }
        break;

    case 'eliminar':
        if ($id) {
            $res = $producto->eliminar($id);
            if ($res) {
                echo json_encode([
                    "success" => true,
                    "message" => "Producto eliminado correctamente"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "error" => "Error al eliminar producto"
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "error" => "ID requerido para eliminar"
            ]);
        }
        break;

    case 'obtenerPorId':
        if ($id) {
            $prod = $producto->obtenerPorId($id);
            if ($prod) {
                echo json_encode([
                    "success" => true,
                    "data" => $prod
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "error" => "Producto no encontrado"
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "error" => "ID requerido"
            ]);
        }
        break;

    default:
        echo json_encode([
            "success" => false,
            "error" => "Acción inválida"
        ]);
        break;
}
?>
