<?php if(function_exists('have_rows')): ?>

<?php if(have_rows('blocks')): ?>

	<?php
		$previous = '';
		$args = array( 'previous' => $previous );
	?>

	<?php while(have_rows('blocks')): the_row() ?>

		<section class="block previous-block-<?= $previous ?> block-<?= get_row_layout() ?>">

			<?php
				get_template_part('blocks/block', get_row_layout(), $args);
			?>

		</section>

		<?php
			$previous = get_row_layout();
			$args = array( 'previous' => $previous );
		?>

	<?php endwhile ?>

<?php endif ?>

<?php endif ?>