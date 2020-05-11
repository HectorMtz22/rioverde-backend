<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    
include_once 'producto.php';

class ApiProducto{

    //private $imagen
    //private $error

    function getAll()
    {
        $total["items"] = array();
        $producto = new Producto();

        $resultado = $producto->obtenerProductos();

        if($resultado->rowCount() !== 0) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            //$row = $resultado->fetch();

            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                $item=array
                (
                    "_id" => $row['codigo'],
                    "name" => $row['nombre'],
                    "brand" => $row['marca'],
                    "buy" => $row['compra'],
                    "price" => $row['precio'],
                    "total" => $row['stock']
                );
                array_push($total["items"], $item);
            }
            echo json_encode($total);
        }
        else
        {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
        return 0;
    }

    function getById($id)
    {
        $total["items"] = array();
        $producto = new Producto();

        $resultado = $producto->obtenerProducto($id);

        if($resultado->rowCount()) //la variable "$row" es = a fila, rowcount es contar las filas
        {

            while ($row = $resultado->fetch(PDO::FETCH_ASSOC))
            {
    
                $item=array
                (
                    "_id" => $row['codigo'],
                    "name" => $row['nombre'],
                    "brand" => $row['marca'],
                    "buy" => $row['compra'],
                    "price" => $row['precio'],
                    "total" => $row['stock']
                );
                //array_push($total["items"], $item); NO UTILIZAR
            }
            echo json_encode($item);
        }
        else
        {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
        return 0;
    }
    
    // Aqui tienes todas las funciones
    function add($item)
    {
        $producto = new producto();

        $producto->nuevoProducto($item);
        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
        return 0;
    }
    function update($item)
    {
        $producto = new producto();

        $producto->actualizarProducto($item);
        //$this->json_encode(array('mensaje' => '¡Producto Actualizado!'));
        return 0;
    }
    function updateStock($item)
    {
        $producto = new producto();

        $producto->actualizarStock($item);
        //$this->json_encode(array('mensaje' => '¡Producto Actualizado!'));
        return 0;
    }
    function delete($id)
    {
        $producto = new producto();

        $producto->eliminarProducto($id);
        //$this->json_encode(array('mensaje' => '¡Producto Eliminado!'));
        return 0;
    }

    
    /* Las funciones de aqui adentro son para subir las imagenes en un futuro   
        POR MIENTRAS NO SE USARÁ
    
        function subirImagen($file){
        $directorio = "imagenes/";

        $this->imagen = basename($file["name"]);
        $archivo = $directorio . basename($file["name"]);

        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    
        // valida que es imagen
        $checarSiImagen = getimagesize($file["tmp_name"]);

        if($checarSiImagen != false){
            //validando tamaño del archivo
            $size = $file["size"];

            if($size > 500000){
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            }else{

                //validar tipo de imagen
                if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                    // se validó el archivo correctamente
                    if(move_uploaded_file($file["tmp_name"], $archivo)){
                        //echo "El archivo se subió correctamente";
                        return true;
                    }else{
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                }else{
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        }else{
            $this->error = "El documento no es una imagen";
            return false;
        }
    }

    function getImagen(){
        return $this->imagen;
    }

    function getError(){
        return $this->error;
    }


    */
    
}

// Aqui mandamos a llamar toda la API 
// Esto es lo más importante
$api = new ApiProducto();

$data = json_decode(file_get_contents('php://input'), true);
foreach ($data as $clave => $valor) {
    // $array[3] se actualizará con cada valor de $array...
    echo "{$clave} => {$valor} ";
    print_r($data);
}

if (isset($data['_id'])){
    $id = $data['_id'];
    if($data['method'] == "GET") {
        if(is_numeric($id)){
            $api->getById($id);
        }else{
            json_encode(array('mensaje' => '¡Los parámetros son incorrectos!'));
        }
    }
    if($data['method'] == "POST") {
        $api->add($data);
    } 
    if($data['method'] == "PUT") {
        if($data['stock'] == "ASIES") {
            //$api->updateStock($data);
            print "Estas con stock asies";
        } else {
            //$api->update($data);
        }
    }
    if($data['method'] == "DELETE") {
        $api->delete($id);
    }
}else{
    $api->getAll();
}
?>