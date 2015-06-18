
		<div class="container">
			<hr>

			<footer>
				<p>Developed for a class asignment.<br />&copy;<?=date('Y')?> RoliSoft &middot; <?=sprintf('%.3f', microtime(true) - $this->app->start)?>s<? $qc = $this->app->db->count(); if ($qc != 0) { print ' '.sprintf('%d', $qc).'q'; } ?></p>
			</footer>
		</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
