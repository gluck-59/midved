		<script src="/application/js/jquery-1.9.1.js"></script>
		<script src="/application/js/bootstrap.min.js"></script>
		<script src="/application/js/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="/application/js/bootstrap-select/i18n/defaults-ru_RU.js"></script>

        <script src="/application/js/toastr.min.js"></script>
        <link rel="stylesheet" href="/application/css/toastr.css">

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

        <div class="clearfix"><hr></div>

		<div class="row">
			<div class="col-md-9 col-lg-8 col-xs-12">
				<!--center class="row" style="opacity: 0.4;">
					<span class="hidden-xs label label-primary">hidden-xs</span>
					<span class="hidden-sm label label-primary">hidden-sm</span>
					<span class="hidden-md label label-danger">hidden-md</span>
					<span class="hidden-lg label label-default">hidden-lg</span>
				</center-->
				<center id="benchmark" class="text-muted"><a id="em">© <a href="//github.com/gluck-59/midved" target="_blank">gluck</a> <span id="year"></span> | server: <?=$this->benchmark->elapsed_time()?></center>
			</div>
		</div>
	</body>
</html>
<script>
    function footerFill() {
        let to = 'mailto:';
        let em = 'glu'+'ck59@gm'+'ail.com';
        document.getElementById('em').setAttribute('href', to+em)
    }

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>