<?php
	$file = "test.xls";
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename='.$file);
	// $f = fopen('php://output', 'w')
?>

<table>
	<tr>
		<td>Producto</td>
		<td>Cantidad</td>
		<td>Precio Unitario</td>
		<td>Precio Total</td>
	</tr>
	<tr>
		<td>Papas</td>
		<td>1</td>
		<td>10</td>
		<td>10</td>
	</tr>
	<tr>
		<td>Papas</td>
		<td>1</td>
		<td>10</td>
		<td>10</td>
	</tr>
</table>