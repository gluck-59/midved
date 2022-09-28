		<script src="/application/js/jquery-1.9.1.js"></script>
		<script src="/application/js/bootstrap.min.js"></script>
		<script src="/application/js/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="/application/js/bootstrap-select/i18n/defaults-ru_RU.js"></script>
		<script src="/application/js/script.js"></script>

		<script>
			jQuery.fn.extend({
				autoHeight: function () {
					function autoHeight_(element) {
						return jQuery(element)
							.css({ 'height': 'auto', 'overflow-y': 'hidden' })
							.height(element.scrollHeight);
					}
					return this.each(function() {
						autoHeight_(this).on('input', function() {
							autoHeight_(this);
						});
					});
				}
			});

			$('textarea').autoHeight();
		</script>
		<?php include_once 'modals.php';?>

		<!--center class="row" style="opacity: 0.4;">
			<span class="hidden-xs label label-primary">hidden-xs</span>
			<span class="hidden-sm label label-primary">hidden-sm</span>
			<span class="hidden-md label label-danger">hidden-md</span>
			<span class="hidden-lg label label-default">hidden-lg</span>
		</center-->
		<center id="benchmark" class="text-muted">Total: <?=$this->benchmark->elapsed_time()?>s, env=<?=ENVIRONMENT?></center>
	</body>
</html>
