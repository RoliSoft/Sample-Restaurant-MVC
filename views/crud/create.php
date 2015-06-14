
		<div class="jumbotron">
			<div class="container">
				<div class="page-header admin-form-new-header">
					<h2><i class="fa fa-plus-circle breathe-shadow"></i> Add new <?=$class?></h2>
				</div>
				<form class="form-horizontal" method="post" action="?action=create">
<?
foreach ($fields as $field => $type):

	$conf = $type[1];

	if ($conf['primary_key']) {
		continue;
	}
?>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?=$conf['name']?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="<?=$field?>">
						</div>
					</div>
<? endforeach; // ($fields as $field => $type) ?>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="hidden" name="token" value="<?=$_SESSION['cru_csrf']?>">
							<button type="submit" class="btn btn-md btn-default"><i class="fa fa-check"></i> Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
