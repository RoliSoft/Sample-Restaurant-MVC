
		<div class="jumbotron">
			<div class="container">
				<div class="page-header admin-form-new-header">
<? if ($record): ?>
					<h2><i class="fa fa-pencil breathe-shadow"></i> Edit <?=htmlspecialchars((string)$record)?></h2>
<? else: // record ?>
					<h2><i class="fa fa-plus-circle breathe-shadow"></i> Create <?=$class?></h2>
<? endif; // record?>
				</div>
				<form class="form-horizontal" method="post" action="?action=manage">
<?
foreach ($fields as $field => $type):

	$conf = $type[1];

	if ($conf['primary_key']) {
		if ($record) {
			$conf['readonly'] = true;
		}
		else {
			continue;
		}
	}

	unset($values);

	if ($conf['enum']) {
		$values = $conf['enum']::getConsts();
	}

	if ($conf['foreign_key']) {
		$values = $foreigns[$conf['foreign_key']];
	}

	$attrs   = '';
	$classes = '';

	if (!$conf['hidden']) {
		$attrs = ' required';
	}

	if ($conf['readonly']) {
		$attrs = ' readonly';

		if ($type[0] == 'int' && !$record) {
			$attrs .= ' value="0"';
		}
	}

	if ($type[0] == 'date') {
		$classes .= ' datepicker';
		$conf['prefix'] = '<i class="fa fa-calendar"></i>';
	}
	else if ($type[0] == 'datetime') {
		$classes .= ' datetimepicker';
		$conf['prefix'] = '<i class="fa fa-clock-o"></i>';
	}

	if ($record && !$values) {
		$attrs .= ' value="'.htmlspecialchars($record->$field).'"';
	}
?>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?=$conf['name']?></label>
						<div class="col-sm-10">
<?  if (isset($conf['suffix']) || isset($conf['prefix'])): ?>
							<div class="input-group">
<?  endif; // suffix or prefix ?>
<?  if (isset($conf['prefix'])): ?>
								<span class="input-group-addon"><?=$conf['prefix']?></span>
<?  endif; // prefix ?>
<?  switch ($type[0]): ?>
<?      default: ?>
								<input type="text" class="form-control<?=$classes?>" name="<?=$field?>"<?=$attrs?>>
<?      break; case 'int': ?>
<?          if (isset($values)): ?>
								<select class="form-control<?=$classes?>" name="<?=$field?>"<?=$attrs?>>
<?              foreach ($values as $key => $value): ?>
									<option value="<?=$key?>"<?=($record && $record->$field == $key ? ' selected' : '')?>><?=$value?></option>
<?              endforeach; // $values as $key => $value ?>
								</select>
<?          else: // enum or foreign ?>
								<input type="number" class="form-control<?=$classes?>" name="<?=$field?>"<?=$attrs?>>
<?          endif; // enum or foreign?>
<?      break; endswitch; // field type ?>
<?  if (isset($conf['suffix'])): ?>
								<span class="input-group-addon"><?=$conf['suffix']?></span>
<?  endif; // suffix ?>
<?  if (isset($conf['suffix']) || isset($conf['prefix'])): ?>
							</div>
<?  endif; // suffix or prefix ?>
						</div>
					</div>
<? endforeach; // $fields as $field => $type ?>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="hidden" name="token" value="<?=$_SESSION['cru_csrf']?>">
							<button type="submit" class="btn btn-md btn-default"><i class="fa fa-check"></i> Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
