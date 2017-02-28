<script type="text/javascript">
	(function(w, d, n, r, t, s){
		w.Stomt = w.Stomt||[];
		t = d.createElement(n);
		s = d.getElementsByTagName(n)[0];
		t.async=1;
		t.src=r;
		s.parentNode.insertBefore(t,s);
	})(window, document, 'script', '//www.stomt.com/widget.js');
	Stomt.push(['addTab', {
		targetId: '<?php echo esc_html( $options['targetId'] ); ?>',
		position: '<?php echo esc_html( $options['position'] ); ?>',
		label: '<?php echo esc_html( $options['label'] ); ?>',
		colorText: '<?php echo esc_html( $options['colorText'] ); ?>',
		colorBackground: '<?php echo esc_html( $options['colorBackground'] ); ?>',
		colorHover: '<?php echo esc_html( $options['colorHover'] ); ?>'
	}]);
</script>