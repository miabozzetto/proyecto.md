<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos - Bootstrap + PHP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4">Lista de Alumnos</h1>

    <?php
    // Conexión a la base de datos
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "escueladb";

    $conn = new mysqli($host, $usuario, $contrasena, $base_datos);

    if ($conn->connect_error) {
        die('<div class="alert alert-danger">Conexión fallida: ' . $conn->connect_error . '</div>');
    } else {
        echo '<div class="alert alert-success">Conexión exitosa</div>';
    }

    // Agregar nuevo dato a la base de datos
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insertar'])) {
        $dni = $_POST['dni'];
        $legajo = $_POST['legajo'];
        $curso = $_POST['curso'];

        if (empty($dni) || empty($legajo) || empty($curso)) {
            echo '<div class="alert alert-danger">Por favor, ingresa todos los valores.</div>';
        } else {
            $sql_insert = "INSERT INTO persona (dni, n_legajo, curso) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("sss", $dni, $legajo, $curso);

            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Datos insertados correctamente.</div>';
            } else {
                echo '<div class="alert alert-danger">Error al insertar los datos: ' . $conn->error . '</div>';
            }
        }
    }

    // Mostrar la tabla de ejemplo (reemplazada según tu solicitud)
    echo '
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
    ';

    $conn->close();
    ?>

    <!-- Formulario para ingresar un nuevo dato -->
    <div class="mt-5">
        <h2>Ingresar Nuevo Dato</h2>
        <form action="index.php" method="POST">
            <div class="form-group mb-3">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese el DNI" required>
            </div>

            <div class="form-group mb-3">
                <label for="legajo">Legajo</label>
                <input type="text" class="form-control" id="legajo" name="legajo" placeholder="Ingrese el Legajo" required>
            </div>

            <div class="form-group mb-3">
                <label for="curso">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" placeholder="Ingrese el Curso" required>
            </div>

            <button type="submit" name="insertar" class="btn btn-primary">Insertar Datos</button>
        </form>
    </div>
</div>

</body>
</html>
