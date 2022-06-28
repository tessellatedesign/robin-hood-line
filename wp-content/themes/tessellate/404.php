<?php
/*
 * Error page template file
 */

get_header() ?>

	<main id="error" role="main">

		<section id="content" class="container">

			<h1>Page not found</h1>

			<p>This page cannot be found. Try a search below.</p>

			<?php get_search_form() ?>

		</section>

	</main>

<?php get_footer() ?>