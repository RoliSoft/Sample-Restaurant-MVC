		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header no-margin">
						<h1><?=$title?> <small><?=$subtext?></small></h1>
					</div>
				</div>
				<div class="col-md-4">
					<div class="page-header no-margin">
						<h2><i class="fa fa-beer"></i> Soups</h2>
					</div>
<?
foreach ($foods as $food):
	if ($food->type != FoodTypes::Soup) {
		continue;
	}
	$rate = $food->getRating();
?>
					<div class="well">
						<h3 class="food-title"><?=$food->name?></h3>
						<p class="pull-left">
							<span class="star-<?=($rate<=0.1?'gray':($rate<=1?'red':($rate<=3?'blue':'green')))?>">
								<span class="fa fa-<?=($rate<1?($rate<0.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="1"></span>
								<span class="fa fa-<?=($rate<2?($rate<1.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="2"></span>
								<span class="fa fa-<?=($rate<3?($rate<2.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="3"></span>
								<span class="fa fa-<?=($rate<4?($rate<3.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="4"></span>
								<span class="fa fa-<?=($rate<5?($rate<4.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="5"></span>
							</span>
						</p>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $foods as $food ?>
				</div>
				<div class="col-md-4">
					<div class="page-header no-margin">
						<h2><i class="fa fa-cutlery"></i> Main Course</h2>
					</div>
<?
foreach ($foods as $food):
	if ($food->type != FoodTypes::Main) {
		continue;
	}
	$rate = $food->getRating();
?>
					<div class="well">
						<h3 class="food-title"><?=$food->name?></h3>
						<p class="pull-left">
							<span class="star-<?=($rate<=0.1?'gray':($rate<=1?'red':($rate<=3?'blue':'green')))?>">
								<span class="fa fa-<?=($rate<1?($rate<0.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="1"></span>
								<span class="fa fa-<?=($rate<2?($rate<1.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="2"></span>
								<span class="fa fa-<?=($rate<3?($rate<2.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="3"></span>
								<span class="fa fa-<?=($rate<4?($rate<3.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="4"></span>
								<span class="fa fa-<?=($rate<5?($rate<4.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="5"></span>
							</span>
						</p>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $foods as $food ?>
				</div>
				<div class="col-md-4">
					<div class="page-header no-margin">
						<h2><i class="fa fa-birthday-cake"></i> Desserts</h2>
					</div>
<?
foreach ($foods as $food):
	if ($food->type != FoodTypes::Dessert) {
		continue;
	}
	$rate = $food->getRating();
?>
					<div class="well">
						<h3 class="food-title"><?=$food->name?></h3>
						<p class="pull-left">
							<span class="star-<?=($rate<=0.1?'gray':($rate<=1?'red':($rate<=3?'blue':'green')))?>">
								<span class="fa fa-<?=($rate<1?($rate<0.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="1"></span>
								<span class="fa fa-<?=($rate<2?($rate<1.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="2"></span>
								<span class="fa fa-<?=($rate<3?($rate<2.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="3"></span>
								<span class="fa fa-<?=($rate<4?($rate<3.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="4"></span>
								<span class="fa fa-<?=($rate<5?($rate<4.5?'star-o':'star-half-o'):'star')?> rate-star" data-food-id="<?=$food->id?>" data-rating="5"></span>
							</span>
						</p>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $foods as $food ?>
				</div>
				<div class="col-md-12">
					<p class="bigger-font text-center"><i class="fa fa-info-circle"></i>
<? if (empty($_SESSION['user'])): ?>
						<a href="login">Sign in</a> to reserve your food.
<? else: ?>
						Reserve your food on the <a href="week">Week</a> page.
<? endif; ?>
					</p>
				</div>
			</div>
		</div>
