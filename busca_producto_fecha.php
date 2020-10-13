<? php
include('conexion.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//comprobamos que las fechas existan//
if (isset($desde)==false){
	$desde = $hasta;
	# code...
}
if (isset($hasta)==false){
	$hasta = $desde;
	# code...
}
//ejecutamos la consulta de busqueda//
$registro= mysql_query("SELECT * products WHERE date BETWEEN '$desde' AND '$hasta' ORDER BY id ASC");

//creamos nuestra viasta y la devolvemos a ajax 

echo  <table class= "table table-striped table-condensed table-hover">
<tr>
<th> Imagen</th>
<th> Descripción </th>
<th width="300">Categoria</th>
<th width="300">Stock</th>
<th width="300">precio de compra </th>
<th width="300">precio de venta </th>
<th width="300">fecha de registro </th>
<th width="300">Acciones </th>
</tr>;

if (mysql_num_rows($registro)>0){
while($registro2= msql_fetch_array($registro)){
	echo <tr>
	<td>'.$registro2['name'].'</td>
	<td>'.$registro2['quantity'].'</td>
	<td>'.$registro2['buy_price'].'</td>
	<td>'.$registro2['sale_price'].'</td>
	<td>'.$registro2['categorie_id'].'</td>
	<td>'.$registro2['media_id'].'</td>
	<td>'.$fechaNormal['date'].'</td>
	</tr>;
}
}else{
	echo <tr>
	<td colspan="6">No se encontraron resultados</td>
	</tr>;
}
echo </table>;
?>

