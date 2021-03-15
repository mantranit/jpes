<div class="<?php echo isset($css_class) && !empty($css_class) ? $css_class : 'vc_navbar' ?>" role="navigation" id="vc_navbar">
	<ul class="vc_navbar-nav">
		<?php foreach($controls as $control): ?>
		<?php echo $control[1] ?>
		<?php endforeach; ?>
	</ul>
	<!--/.nav-collapse -->
</div>