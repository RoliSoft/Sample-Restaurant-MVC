		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header no-margin">
						<h1>Passes <small>Up To 30% Discounts</small></h1>
					</div>
				</div>
<? foreach ($passes as $pass): ?>
				<div class="col-md-6">
					<div class="page-header no-margin">
						<h2><i class="fa fa-ticket"></i> <?=$pass->name?></h2>
					</div>
					<div class="well">
						<form action="passes" method="post" class="pull-right">
<? if ($user): ?>
							<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-name="Sapientia Canteen" data-key="<?=$stripe['publishable_key']?>" data-amount="<?=$pass->price*100?>" data-allow-remember-me="false" data-email="<?=$user['email']?>" data-currency="ron" data-description="<?=$pass->name?> Pass"></script>
							<input type="hidden" name="pass_id" value="<?=$pass->id?>" />
<? else: ?>
							<a class="btn btn-default" href="login" role="button">Sign in to Buy</a>
<? endif; ?>
						</form>
						<h3 class="food-title"><big><?=$pass->meals?></big> meals &middot; <big><?=$pass->price?></big> RON &middot; <big><?=round(100-(($pass->price/$pass->meals)/14*100))?></big>% Off</h3>
					</div>
				</div>
<? endforeach; // $passes as $pass ?>
			</div>
		</div>
