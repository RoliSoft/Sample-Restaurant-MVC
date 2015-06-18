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
<? foreach ($foods as $food): if ($food->type != FoodTypes::Soup) continue; ?>
					<div class="well">
						<h3 class="food-title"><?=$food->name?></h3>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $foods as $food ?>
				</div>
				<div class="col-md-4">
					<div class="page-header no-margin">
						<h2><i class="fa fa-cutlery"></i> Main Course</h2>
					</div>
<? foreach ($foods as $food): if ($food->type != FoodTypes::Main) continue; ?>
					<div class="well">
						<h3 class="food-title"><?=$food->name?></h3>
						<p class="food-desc">. . . <?=$food->calories?> calories, <?=$food->price?> RON</p>
					</div>
<? endforeach; // $foods as $food ?>
				</div>
				<div class="col-md-4">
					<div class="page-header no-margin">
						<h2><i class="fa fa-birthday-cake"></i> Desserts</h2>
					</div>
<? foreach ($foods as $food): if ($food->type != FoodTypes::Dessert) continue; ?>
					<div class="well">
						<h3 class="food-title"><?=$food->name?></h3>
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
