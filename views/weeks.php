		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header no-margin">
						<h1><?=$title?> <small><?=$subtext?></small></h1>
					</div>
				</div>
				<div class="col-md-1"></div>
<? $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']; ?>
<? foreach ($weekdays as $day): ?>
				<div class="col-md-2">
					<div class="page-header no-margin">
						<h2><?=$day?></h2>
					</div>
					<div class="page-header no-margin">
						<h4><i class="fa fa-beer"></i> Soups</h4>
					</div>
<?
foreach ($menu as $item):
	$food = $foods[$item->food_id];
	if ($food->type != FoodTypes::Soup || date('l', strtotime($item->date)) != $day) continue;
?>
					<div class="well well-sm">
						<strong class="food-title"><?=$food->name?></strong>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $menu as $item ?>
					<div class="page-header no-margin">
						<h4><i class="fa fa-cutlery"></i> Main Course</h4>
					</div>
<?
foreach ($menu as $item):
	$food = $foods[$item->food_id];
	if ($food->type != FoodTypes::Main || date('l', strtotime($item->date)) != $day) continue;
?>
					<div class="well well-sm">
						<strong class="food-title"><?=$food->name?></strong>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $menu as $item ?>
					<div class="page-header no-margin">
						<h4><i class="fa fa-birthday-cake"></i> Desserts</h4>
					</div>
<?
foreach ($menu as $item):
	$food = $foods[$item->food_id];
	if ($food->type != FoodTypes::Dessert || date('l', strtotime($item->date)) != $day) continue;
?>
					<div class="well well-sm">
						<strong class="food-title"><?=$food->name?></strong>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $menu as $item ?>
				</div>
<? endforeach; // $weekdays as $day ?>
			</div>
		</div>
