<?php
/*
 * Post home template file
 */

get_header() ?>

	<main id="home" role="main">

		<section id="archive" class="container">

			<h1><?php the_archive_title() ?></h1>

			<?php if(have_posts()): ?>

				<div class="row">

					<?php while(have_posts()): the_post() ?>

						<article class="col">

							<h2>

								<a href="<?php the_permalink() ?>">

									<?php the_title() ?>

								</a>

							</h2>

							<?php the_excerpt() ?>

						</article>

					<?php endwhile ?>

				</div>

				<?php
				the_posts_pagination(array(
					'prev_text' => '&lt;',
					'next_text' => '&gt;'
				))
				?>

			<?php endif ?>

		</section>
		
		<section id="blocks">

			<?php get_template_part('blocks') ?>

		</section>

	</main>

<?php get_footer() ?>
