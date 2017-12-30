
<?php
require_once("navbar.php");
require_once("clases/conexion.php");
$query = "select idCategoria,nombreCategoria from Categoria order by nombreCategoria ASC";
$resultado=$mysqli->query($query);


?>



<html lang="es">

	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="js/ingresosMultiples.js" type="text/javascript"></script>
		<script language="javascript" src="js/selectDinamicos.js" ></script>

	</head>

	<body>
<!-- Formulario de Ingresos-->

	<div class="container">
		<div class="panel panel-primary">
				  <div class="panel-heading"><h4><center><strong>Ingresos</strong></center></h4></div>
				  <div class="panel-body">

			<form class="from-row" method="post">

				<table class="table bg-info"  id="tabla">
					<tr class="fila-fija">
<!--Seleccionar Categoria-->
					<td><div class="row">
							<div class="col-lg-12">
								<label for="categoria">Categoria</label>
    							<div class="input-group">
		      							<select class="form-control" name="cbx_categoria" id="cbx_categoria">
		      								<option value="0"> Seleccione Categoria</option>
		      								<?php while($row = $resultado->fetch_assoc()) {?>
		      									<option value="<?php echo $row['idCategoria'];?>" ><?php echo $row['nombreCategoria'];?></option>
		      									<?php } ?>
		      							</select>
    							</div>
    					</div>
  					  </div>
					</td>



					<td><div class="row">
							<div class="col-lg-12">
								<label for="categoria">Producto</label>
    							<div class="input-group">
		      				<!--<div><select name="cbx_producto" id="cbx_producto"></select></div>-->
									<select class="form-control" name="cbx_producto" id="cbx_producto"></select>

    							</div>
    						</div>
  					    </div>
					</td>




<!--Campo Cantidad-->

				<td><div class="row">
						<div class="col-lg-18">
							<label for="cantidad">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cantidad</label>
								<div class="input-group">
											<span class="input-group-btn">
											</span>
											<input type="text" class="form-control" required name="cantidad[]">
								</div>
						</div>
				</td>
<!--Campo PrecioEntrada-->

				<td><div class="row">
						<div class="col-lg-18">
							<label for="precio">&nbsp;&nbsp;Precio de Entrada $$</label>
								<div class="input-group">
											<span class="input-group-btn">

											</span>
											<input type="text" class="form-control" required name="precio[]">
								</div>
						</div>
				</td>
<!--Campo Bodega-->

<td><div class="row">
		<div class="col-lg-18">
			<label for="bodega">&nbsp;&nbsp;Bodega</label>
				<div class="input-group">
							<span class="input-group-btn">

							</span>
							<input type="text" class="form-control" required name="bodega[]">
				</div>
		</div>
</td>

<!--Boton Eliminar-->

<td class="eliminar"><div class="row">
		<div class="col-lg-18">
			<label for="eliminar">&nbsp;&nbsp;</label>
				<div class="input-group">
							<span class="input-group-btn"></span>
							<!--<input type="button" value="Menos">-->
							<button type="button" class="btn btn-danger" value="Menos"><strong> <strong><span class="glyphicon glyphicon-minus-sign" aria-hidden="true">
							</span></button>



				</div>
		</div>
</td>


</tr>
				</table>

				<div class="btn-der">
					<button id="adicional" name="adicional" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
						<strong>Agregar Entrada</strong></button>
					<button type="submit" name="insertar" class="btn btn-primary "><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
						 <strong>Guardar</strong></button>



				</div>
			</form>

  </div>
</div>
</div>

<?php
				//Eventos del Boton MAS
				if(isset($_POST['insertar']))
				{
				//$items1 = ($_POST['id']);
				$items2 = ($_POST['codpro']);
				$items3 = ($_POST['cantidad']);
				$items4 = ($_POST['precio']);
				$items5 = ($_POST['bodega']);
				while(true) {
				    //RECUPERAR LOS VALORES DE LOS ARREGLOS

				    $item2 = current($items2);
				    $item3 = current($items3);
				    $item4 = current($items4);
					$item5 = current($items5);
				    //ASIGNARLOS A VARIABLES
						//$id=(( $item1 !== false) ? $item1 : ", &nbsp;");
					$cod=(( $item2!== false) ? $item2: ", &nbsp;");
				    $can=(( $item3 !== false) ? $item3 : ", &nbsp;");
				    $pre=(( $item4 !== false) ? $item4 : ", &nbsp;");
				    $bod=(( $item5 !== false) ? $item5 : ", &nbsp;");
				    //Cocatenamos los valores para insertarlos en el orden correspondiente
				    $valores='("'.$cod.'","'.$can.'","'.$pre.'","'.$bod.'"),';
				    $valoresQ= substr($valores, 0, -1);
				    //QUERY DE INSERCIÓN
				    $sql = "INSERT INTO detalleEntradas
				    (idEntrada,codProducto,Cantidad,PrecioEntrada,idBodega)
					VALUES $valoresQ";
					  $sqlRes=$mysqli->query($sql);
				    //$item1 = next( $items1 );
				    $item2 = next( $items2 );
				    $item3 = next( $items3 );
				    $item4 = next( $items4 );
   					$item5= next( $items5);
				    if($item2 === false && $item3 === false && $item4 === false  && $item5 === false) break;
				}
				}
			?>


		</section>

	</body>

</html>
