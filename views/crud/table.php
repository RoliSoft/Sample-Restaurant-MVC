
		<div class="container">
			<div class="table-responsive">
				<table class="table table-hover table-striped">
					<thead>
					<tr>
<?
foreach ($fields as $field => $type):

	$conf = $type[1];

	if ($conf['hidden']) {
		continue;
	}
?>
						<th><?=$conf['name']?></th>
<? endforeach; // ($fields as $field => $type) ?>
						<th class="admin-table-btns">
							<a role="button" class="btn btn-xs btn-success" href="?action=create"><span class="fa fa-plus-circle"></span> Create</a>
						</th>
					</tr>
					</thead>
					<tbody>
<? foreach ($records as $record): ?>
					<tr class="item-<?=$record->getId()?>">
<?
	foreach ($fields as $field => $type):

		$conf = $type[1];

		if ($conf['hidden']) {
			continue;
		}

		if ($conf['primary_key']) {
			$id = $record->$field;
		}

		if ($conf['enum']) {
			$value = $conf['enum']::getName($record->$field);
		}
		else if ($conf['foreign_key']) {
			if (isset($foreigns[$field][$record->$field])) {
				$value = (string)$foreigns[$field][$record->$field];
			}
			else {
				$value = '#'.$record->$field;
			}
		}
		else {
			$value = $record->$field;
		}
?>
						<td><?=isset($conf['prefix'])?'<small>'.$conf['prefix'].'</small> ':''?><?=htmlspecialchars($value)?><?=isset($conf['suffix'])?' <small>'.$conf['suffix'].'</small>':''?></td>
<?  endforeach; // ($fields as $field => $type) ?>
						<td class="admin-table-btns">
							<a role="button" class="btn btn-xs btn-info" href="?action=edit&record=<?=$id?>"><span class="fa fa-pencil"></span> Edit</a>
							<a role="button" class="btn btn-xs btn-primary" href="?action=delete&record=<?=$id?>"><span class="fa fa-trash"></span> Delete</a>
						</td>
					</tr>
<? endforeach; // (records as $record) ?>
					</tbody>
				</table>
			</div>
		</div>
