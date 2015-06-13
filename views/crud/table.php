
		<div class="container">
			<div class="table-responsive">
				<table class="table table-hover table-striped">
					<thead>
					<tr>
<?
foreach ($fields as $field => $type):
	$conf = $type[1];
	if ($conf['hidden']) continue;
?>
						<th><?=$conf['name']?></th>
<? endforeach; // ($fields as $field => $type) ?>
					</tr>
					</thead>
					<tbody>
<? foreach ($records as $record): ?>
					<tr>
<?
foreach ($fields as $field => $type):
	$conf = $type[1];
	if ($conf['hidden']) continue;
?>
						<td><?=isset($conf['prefix'])?'<small>'.$conf['prefix'].'</small> ':''?><?=$record->$field?><?=isset($conf['suffix'])?' <small>'.$conf['suffix'].'</small>':''?></td>
<? endforeach; // ($fields as $field => $type) ?>
					</tr>
<? endforeach; // (records as $record) ?>
					</tbody>
				</table>
			</div>
		</div>
