<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <?php 

    function introduccion(){
        // en php todas la variables inician con simbolo de $
        $miVariable = "Julio";
        // concatenamos con .
        echo "<h1>Hola" . $miVariable . "</h1>";
        // operaciones
        $val1 = 10;
        $val2 = 0;
        $suma = $val1 + $val2;
        $resta = $val1 - $val2;

        if ($suma > 10){
            echo "La suma es mayor a 10" . $suma;
        }
        else {
            echo "La suma es menor a 10" . $suma;
        }
        for ($contador = 1 ; $contador <= 10 ; $contador ++){
            echo "contador" . $contador . "<br/>";
        }
    }
    //introduccion();

    $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
    $conexion = new PDO("mysql:host=localhost;dbname=intro2023B", "root", "", $pdo_options);
    // ejecutar la consulta

    if (isset($_POST["accion"]) &&
    $_POST["accion"] == "crear"){
        $insert = $conexion->prepare("INSERT INTO alumno (carnet, nombre, dpi, direccion) VALUES (:carnet,:nombre,:dpi,:direccion)");
        //asignamos los valores a los parametros
        $insert->bindValue("carnet", $_POST["carnet"]);
        $insert->bindValue("nombre", $_POST["nombre"]);
        $insert->bindValue("dpi", $_POST["dpi"]);
        $insert->bindValue("direccion", $_POST["direccion"]);
        // ejecutar la consulta
        $insert->execute();
    }

    $select = $conexion->query("SELECT carnet, nombre, dpi, direccion from alumno");
    ?>

    <a href="crear.php">Crear nuevo</a>
    <table border="1">
        <thead>
            <tr>
                <th>Carnet</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Direccion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($select->fetchAll() as $registro) { ?>
                <tr>
                    <td> <?php echo $registro["carnet"] ?> </td>
                    <td> <?php echo $registro["nombre"] ?> </td>
                    <td> <?php echo $registro["dpi"] ?> </td>
                    <td> <?php echo $registro["direccion"] ?> </td>
                    <td>
                        <form action="Editar.php" method="POST">
                            <button type="submit">Editar</button>
                            <input type="hidden" name="carnet" value="<?php echo $registro["carnet"] ?>">
                        </form>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
        
</body>
</html>