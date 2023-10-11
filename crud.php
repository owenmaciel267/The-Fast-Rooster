
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Style -->
    <link rel="stylesheet" href="./style/style.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="./logo/logo11.png" type="image/x-icon">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <title>Tabla pedidos</title>
</head>
<body>
    <nav class="header">
            <div class="logo">
                <a href="./index.html">
                    <img src="./logo/logo11.png" alt="">
                </a>
            </div>
            <ul class="list_menu">
                <li class="lis menu__item" data-aos="fade-right" data-aos-duration="3000"><a href="./index.html">Inicio</a></li>

                <li class="menu__item" data-aos="fade-right" data-aos-duration="3000">
                    <a href="#" >Categoria 👟</a>

                    <ul class="menu__nesting" >
                        <li class="lis" data-aos="fade-right" data-aos-duration="3000">
                            <a href="#" >Basquet</a>
                        </li>
                        <li class="lis" data-aos="fade-right" data-aos-duration="3000">
                            <a href="#" >Futbol 11</a>
                        </li>
                        <li class="lis" data-aos="fade-right" data-aos-duration="3000">
                            <a href="#" >Futbol 5</a>
                        </li>
                        <li class="lis" data-aos="fade-right" data-aos-duration="3000">
                            <a href="#" >Running</a>
                        </li>
                        <li class="lis" data-aos="fade-right" data-aos-duration="3000">
                            <a href="#" >Skate</a>
                        </li>
                        <li class="lis" data-aos="fade-right" data-aos-duration="3000">
                            <a href="#" >Gama Importada</a>
                        </li>
                        <li class="lis" data-aos="fade-right" data-aos-duration="3000">
                            <a href="#" >Premium</a>
                        </li>
                    </ul>
                </li>

                <li class="lis menu__item" data-aos="fade-right" data-aos-duration="2000"><a href="#" >Sobre</a></li>
                <li class="lis menu__item" data-aos="fade-right" data-aos-duration="2000"><a href="./crud.php">Pedidos</a></li>
            </ul>
            <div class="hambur">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>

        
        
        
        
        <?php
        include("config/config.php");

        // Crear (Insertar)
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
            $nombre = $_POST["nombre"];
            $telefono = $_POST["telefono"];
            $email = $_POST["email"];
            $mensaje = $_POST["mensaje"];
            
            // Validar la entrada (puedes agregar más validaciones según sea necesario)
            if (!empty($nombre) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
                        // Crear una declaración preparada
                $stmt = $conexion->prepare("INSERT INTO zapa (nombre, telefono, email, mensaje) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nombre, $telefono, $email, $mensaje );

                // Ejecutar la declaración preparada
                if ($stmt->execute()) {
                    echo "Registro creado con éxito. \n";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Cerrar la declaración preparada
                $stmt->close();
            } else {
                echo "Datos de entrada inválidos.";
            }
        }

        // Leer (Seleccionar)
        $consulta = "SELECT * FROM zapa";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            echo "<br>";
            echo '<table class=" table table-dark table-striped table-hover">';
            // echo    "<caption> TABLA ENCABEZADO </caption>";
            echo "<tr>";
                echo    '<th scope="col">id</th>';
                echo    '<th scope="col">nombre</th>';
                echo    '<th scope="col">telefono</th>';
                echo    '<th scope="col">email</th>';
                echo    '<th scope="col">mensaje</th>';
                echo    '<th scope="col">actividad</th>';
            echo "</tr>";
            echo '<tbody>';
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo   '<td scope="row"> ' . $fila["ID"] . "</td>"; // generalmente no mostramos públicamente el id
                    echo    "<td> " . $fila["nombre"] . "</td>";
                    echo    "<td> " . $fila["telefono"] . "</td>";
                    echo    "<td> " . $fila["email"] . "</td>";
                    echo    "<td> " . $fila["mensaje"] . "</td>";
                    echo "<td>";
                        echo "<form action='crud.php' method='post'>";
                            echo '<input type="submit" name="actualizar" class="btn-actualizar" value="Actualizar">';	
                            echo '<input type="submit" name="eliminar" value="Eliminar" class="mx-3 btn-eliminar">';
                        echo "</form>";
                    echo "</td>";
                    echo "</tr>" ;
                }
                echo '</tbody>';
                echo "</table>";
            } else {
                echo "No se encontraron registros.";
            }
        ?>
        
    </body>

</html>