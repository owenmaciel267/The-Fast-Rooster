<?php


include("config/config.php");
$ID = "";
$ID_eliminar = "";
$nuevoNombre = "";
$nuevoTelefono = "";
$nuevoEmail = "";
$nuevoMensaje = "";


// si apreté botón Actualizar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["actualizar"])) {
	$ID = $_POST["ID"];

	$stmt = $conexion->prepare("SELECT * FROM zapa WHERE ID=?");
	$stmt->bind_param("i", $ID);

	// Ejecutar la declaración preparada
	if ($stmt->execute()) {
		$stmt->bind_result($ID, $nuevoApellido, $nuevoNombre, $nuevoEmail);
		while ($stmt->fetch()) {
	}
	} else {
			echo "Error: " . $stmt->error;
	}
}
// si aprieto el botón Update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $ID = $_POST["ID_update"];
    $nuevoNombre = $_POST["nuevo_nombre"];
    $nuevoTelefono = $_POST["nuevo_telefono"];
    $nuevoEmail = $_POST["nuevo_email"];
    $nuevoMensaje = $_POST["nuevo_mensaje"];
    // Validar la entrada
    if (!empty($id) && !empty($nuevoNombre) && !empty($nuevoTelefono) && !empty($nuevoEmail)  && !empty($nuevoMensaje)) {
        // Crear una declaración preparada
        $stmt = $conexion->prepare("UPDATE zapa SET nombre=?, telefono=?, email=?, mensaje=? WHERE id=?");
        $stmt->bind_param("sssi", $nuevoNombre, $nuevoTelefono, $nuevoEmail,$nuevoMensaje,$id);

        // Ejecutar la declaración preparada
        if ($stmt->execute()) {
					echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
					Registro actualizado con éxito.
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>";
			} else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Datos de entrada inválidos.";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Actualizar</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

  <main>

  <div class="container-fluID mb-2 shadow bg-black">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col">
                    <!-- Formulario para actualizar un usuario -->
                    <h2 class="text-white">Actualizar Usuario</h2>
                    <form action="actualizar.php" method="POST" class="row g-3 mb-3">
                    <div class="col">
                        <label for="ID_update" class="form-label">ID de Usuario:</label>
                        <input type="text" name="ID_update" ID="ID_update" class="form-control" value="<?php echo $ID; ?>" required readonly>
                    </div>
                    <div class="col">
                        <label for="nuevo_nombre" class="form-label">Nuevo Nombre:</label>
                        <input type="text" name="nuevo_nombre" ID="nuevo_nombre" class="form-control" value="<?php echo $nuevoNombre; ?>" required>
                    </div>
                    <div class="col">
                        <label for="nuevo_telefono" class="form-label">Nuevo Telefono:</label>
                        <input type="text" name="nuevo_telefono" ID="nuevo_telefono" class="form-control" value="<?php echo $nuevoApellIDo; ?>" required>
                    </div>
                    <div class="col">
                        <label for="nuevo_email" class="form-label">Nuevo Email:</label>
                        <input type="text" name="nuevo_email" ID="nuevo_email" class="form-control" value="<?php echo $nuevoEmail; ?>" required>
                    </div>
                    <div class="col">
                        <label for="nuevo_mensaje" class="form-label">Nuevo mensaje:</label>
                        <input type="text" name="nuevo_mensaje" ID="nuevo_mensaje" class="form-control" value="<?php echo $nuevoMensaje; ?>" required>
                    </div>
                        <input type="submit" name="update" value="Update" class="btn-actualizar">
                    </form>
                    </div>
            </div>
        </div>



  </main>
  



  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXIDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TIDwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
