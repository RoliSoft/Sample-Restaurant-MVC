		<div class="container">
			<div class="row reservation-row">
				<form method="post" action="week">
				<div class="col-md-12">
					<div class="page-header no-margin">
						<h1><?=$title?> <small><?=$subtext?></small></h1>
					</div>
				</div>
<? $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']; ?>
<? foreach ($weekdays as $day): ?>
				<div class="col-md-2">
					<div class="page-header no-margin">
						<h2><?=$day?></h2>
					</div>
					<div class="page-header no-margin">
						<h4><i class="fa fa-beer"></i> Soups</h4>
					</div>
					<div class="food-wells-soup">
<?
foreach ($menu as $item):
	$food = $foods[$item->food_id];
	if ($food->type != FoodTypes::Soup || date('l', strtotime($item->date)) != $day) continue;
?>
					<div class="well well-sm">
<? if (empty($_SESSION['user'])): ?>
							<strong class="food-title"><?=$food->name?></strong>
<? else: ?>
							<div class="radio radio-info">
								<input type="radio" name="radio-soup-<?=strtolower($day)?>" id="radio-<?=$item->id?>" value="<?=$item->id?>"<?=($reserves[$item->id]?' checked':'')?>>
								<label for="radio-<?=$item->id?>"><strong class="food-title"><?=$food->name?></strong></label>
							</div>
<? endif; ?>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $menu as $item ?>
					</div>
					<div class="page-header no-margin">
						<h4><i class="fa fa-cutlery"></i> Main Course</h4>
					</div>
					<div class="food-wells-main">
<?
foreach ($menu as $item):
	$food = $foods[$item->food_id];
	if ($food->type != FoodTypes::Main || date('l', strtotime($item->date)) != $day) continue;
?>
					<div class="well well-sm">
<? if (empty($_SESSION['user'])): ?>
						<strong class="food-title"><?=$food->name?></strong>
<? else: ?>
						<div class="radio radio-success">
							<input type="radio" name="radio-main-<?=strtolower($day)?>" id="radio-<?=$item->id?>" value="<?=$item->id?>"<?=($reserves[$item->id]?' checked':'')?>>
							<label for="radio-<?=$item->id?>"><strong class="food-title"><?=$food->name?></strong></label>
						</div>
<? endif; ?>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $menu as $item ?>
					</div>
					<div class="page-header no-margin">
						<h4><i class="fa fa-birthday-cake"></i> Desserts</h4>
					</div>
					<div class="food-wells-dessert">
<?
foreach ($menu as $item):
	$food = $foods[$item->food_id];
	if ($food->type != FoodTypes::Dessert || date('l', strtotime($item->date)) != $day) continue;
?>
					<div class="well well-sm">
<? if (empty($_SESSION['user'])): ?>
						<strong class="food-title"><?=$food->name?></strong>
<? else: ?>
						<div class="radio radio-danger">
							<input type="radio" name="radio-dessert-<?=strtolower($day)?>" id="radio-<?=$item->id?>" value="<?=$item->id?>"<?=($reserves[$item->id]?' checked':'')?>>
							<label for="radio-<?=$item->id?>"><strong class="food-title"><?=$food->name?></strong></label>
						</div>
<? endif; ?>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $menu as $item ?>
				</div>
				</div>
<? endforeach; // $weekdays as $day ?>
				<div class="col-md-12">
					<p class="bigger-font text-center">
<? if (empty($_SESSION['user'])): ?>
						<i class="fa fa-info-circle"></i> <a href="login">Sign in</a> to reserve your food.
<? else: ?>
						<input type="hidden" name="token" value="<?=$_SESSION['res_csrf']?>" />
						<button type="submit" class="btn btn-success"><i class="fa fa-th-list"></i> <?=(empty($reserves)?'Submit':'Update')?> Reservation</button>
<? endif; ?>
					</p>
				</div>
				</form>
			</div>
		</div>
