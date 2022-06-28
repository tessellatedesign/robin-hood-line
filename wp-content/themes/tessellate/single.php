<?php
/*
 * Single post template file
 */

get_header() ?>

	<main id="single-post" role="main">

		<?php if(have_posts()): ?>

			<?php while(have_posts()): the_post() ?>

				<section id="content" class="container">

					<article>

						<h1><?php the_title() ?></h1>

						<?php the_content() ?>

					</article>

				</section>

				<?php if(comments_open() || get_comments_number()) comments_template() ?>

				<section id="blocks">

					<?php get_template_part('blocks') ?>

				</section>

			<?php endwhile ?>

		<?php endif ?>

	</main>

<?php get_footer() ?>