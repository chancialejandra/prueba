<?php
include 'config/db.php';

// Consulta para obtener todos los centros
$sqlCentros = "SELECT ID_CENTRO, DESCRIPCION FROM centro";
$centros = $pdo->query($sqlCentros)->fetchAll(PDO::FETCH_ASSOC);

// Obtener el centro seleccionado
$idCentro = isset($_GET['idCentro']) ? $_GET['idCentro'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Enlace a Bootstrap CSS local -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Listado de Clientes por Centro</title>
</head>
<body class="bg-light">
    <div class="text-center mb-4">
        <h1>LISTADO DE CLIENTES POR CENTRO</h1>
    </div>
    <div class="text-center mb-4"> 
    	<img src="imagen.jpg" alt="Imagen" class="img-fluid">
    </div>
    <div class="row justify-content-center d-flex">
    	<label for="centro" class="visually-hidden col-md-2">Selecciona un Centro</label>
    	<div class="d-flex col-md-3">
    		<form method="GET" action="index.php" class="d-flex">
    			<div class="form-group me-2 mb-0 flex-grow-1">
    				<select class="form-control" id="centro" name="idCentro">
    					<option value="">Todos los Centros</option>
    					<?php foreach ($centros as $centro): ?>
                                        <option value="<?= $centro['ID_CENTRO'] ?>" <?= $idCentro == $centro['ID_CENTRO'] ? 'selected' : '' ?>>
                                            <?= $centro['DESCRIPCION'] ?>
                                        </option>
                        <?php endforeach; ?>
    				</select>
    			</div>
    			<button type="submit" class="btn btn-primary">Filtrar</button>
    			<a href="index.php" class="btn btn-secondary ms-2">Limpiar</a>
    		</form>
     	</div>
    </div>

    <div  class="row justify-content-center mt-5">
    	<div class="table-responsive">
    		<table>
    			<thead>
    				<tr>
    					<th>ID</th>
    					<th>Nombre</th>
    					<th>Apellido</th>
    					<th>Profesión</th>
    					<th>Email</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
    				//consulta para obtener los usuarios segun id del centro
    					$stmt=$pdo->prepare("
    						SELECT cliente.ID_CLIENTE, cliente.NOMBRE, cliente.APELLIDO , cliente.PROFESION , cliente.EMAIL FROM cliente INNER JOIN centro ON cliente.FK_IDCENTRO = centro.ID_CENTRO
    						WHERE (:idCentro = ' ' OR centro.ID_CENTRO = :idCentro )
    					");
    				$stmt ->execute(['idCentro' => $idCentro]);

    				//mostrar
    				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo "<tr>
                                        <td>" . $row["ID_CLIENTE"] . "</td>
                                        <td>" . $row["NOMBRE"] . "</td>
                                        <td>" . $row["APELLIDO"] . "</td>
                                        <td>" . $row["PROFESION"] . "</td>
                                        <td>" . $row["EMAIL"] . "</td>
                                      </tr>";
                            }
    				?>
    			</tbody>
    		</table>
    	</div>
    </div>
</body>
</html>
