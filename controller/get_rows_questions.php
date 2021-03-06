<?php
/*******************************************
 *
 * 2014 - DDSI (Dise�o y desarrollo de sistemas de informaci�n)
 * Grado en Ingenier�a Inform�tica
 *
 * Ernesto Serrano <erseco@correo.ugr.es>
 * Garo� Exp�sito Luis <garoluis@correo.ugr.es
 * Daniel P�rez G�zquez <Plenidag@correo.ugr.es>
 * Jose Fco Alcalde <jfap0003@correo.ugr.es>
 *
 *
 *******************************************
 *
 * 	Obtiene las filas de la tabla, para cargarlas mediante ajax
 *
 ******************************************************************************/
?>
<?php

// Incluimos el fichero de configurac�on (por el __autoload)
include "../config.php";

// Instanciamos un nuevo objeto
$entity = new Questions();
$rows = $entity->getAll();

// Recorremos todas las filas
foreach ($rows as $row): ?>

	<tr id="tr_<?php echo $row["id"]; ?>" <?php if ($row["corrections"] != "") echo " class=\"warning\""; ?>>
		<td><?php echo $row["id"]; ?></td>
		<td><?php echo $row["category"]; ?></td>
		<td><?php echo $row["language"]; ?></td>
		<td><?php echo $row["question"]; ?></td>
		<td><?php echo $row["answer1"]; ?></td>
		<td><?php echo $row["answer2"]; ?></td>
		<td><?php echo $row["answer3"]; ?></td>

		<td>
			<?php
				if ($row["corrections"] != ""): ?>
					<span class="glyphicon glyphicon-warning-sign" rel="tooltip" data-html="true" title="<?php echo nl2br($row["corrections"]); ?>"></span>
			<?php endif; ?>
		</td>


		<td class="td-action">
			<button class="btn btn-primary btn-xs" data-toggle="modal" href="controller/modal_questions.php?id=<?php echo $row["id"]; ?>" data-target="#update" data-placement="top" rel="tooltip" data-title="Edit" ><i class="glyphicon glyphicon-pencil"></i></button>
		</td>
		<td class="td-action">
			<button onclick="delete_row('Questions', <?php echo $row["id"]; ?>);" class="btn btn-danger btn-xs" rel="tooltip" data-title="Delete"><i class="glyphicon glyphicon-trash" ></i></button>
		</td>
	</tr>

<?php endforeach; ?>