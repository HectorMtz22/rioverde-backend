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
            
            //(A) @hector
            //$row = $resultado->fetch();

            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                $item=array
                (
                    "_id" => $row['codigo'],
                    "name" => $row['nombre'],
                    "brand" => $row['marca'],
                    "price" => $row['precio'],
                    "total" => $row['stock']
                );
                //array_push($total["items"], $item);
            //}

            //echo json_encode($total);

            //(A) @hector
            $this->printJSON($item);
        }}
        else
        {
            //echo json_encode(array('mensaje' => 'No hay elementos'));
            $this->error('No hay elementos registrados');
        }
    }

    //(A) @hector si te causa error lo puedes borrar :D
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
                    "price" => $row['precio'],
                    "total" => $row['stock']
                );
                //array_push($total["items"], $item);
            }
            //echo json_encode($total);

            //(A) @hector
            $this->printJSON($item);
        }
        else
        {
            //echo json_encode(array('mensaje' => 'No hay elementos'));
            $this->error('No hay elementos registrados');
        }
    }
    //(A) hasta aqui termina esta funcion que pueds borrar



    function add($item)
    {
        $producto = new producto();

        $resultado = $producto->nuevoProducto($item);
        $this->exito('¡Nuevo producto registrado!');
    }



    //(A) esto es para filtrar los datos, si te causa error lo puedes borrar @hector
    function printJSON($array)
    {
        echo '<code>' . json_encode($array) . '</code>';
    }

    //(A) esto es para filtrar los datos, si te causa error lo puedes borrar @hector
    function error($mensaje)
    {
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>';
    }


    function exito($mensaje)
    {
        echo '<code>' . json_encode(array('mensaje' => $mensaje)) . '</code>';
    }


    /* Las funciones de aqui adentro son para subir las imagenes en un futuro @hector
    
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
    $api = new ApiProducto();
    //(A) @hector
    $api->getAll();
    /*
$data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['_id'])){
        $id = $data['_id'];
        if(isset($data['name'])) {
            $api->add($data);
        } else {
            if(is_numeric($id)){
                $api->getById($id);
            }else{
                $api->error('Los parametros son incorrectos');
            }
        }
    }else{
        $api->getAll();
    }

    */
}
?>