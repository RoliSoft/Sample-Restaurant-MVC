		<div class="jumbotron">
			<div class="container text-center">
				<div class="page-header admin-form-new-header">
					<h2><i class="fa fa-exclamation-circle breathe-shadow"></i> Confirm Deletion</h2>
				</div>
				<p>Are you sure you would like to remove ‘<?=htmlspecialchars($item)?>’ from <?=htmlspecialchars($class)?>?</p>
				<p>
					<form class="form-horizontal" method="post" action="?action=delete&amp;record=<?=htmlspecialchars($id)?>">
						<input type="hidden" name="token" value="<?=$_SESSION['del_csrf']?>">
						<button type="submit" name="delete" value="yes" class="btn btn-md btn-primary"><i class="fa fa-check"></i> Yes</button>
						<button type="submit" name="delete" value="no" class="btn btn-md btn-default"><i class="fa fa-times"></i> No</button>
					</form>
				</p>
			</div>
		</div>
