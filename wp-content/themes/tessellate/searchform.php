<?php
/*
 * Search form template file
 */
?>

<section id="search">

	<form role="search" method="get" class="search-form" action="<?= esc_url(home_url('/')) ?>">

		<label>

			Search Text

			<input type="search" class="search-field" value="<?= get_search_query() ?>" name="s" />

		</label>

		<button type="submit" class="search-submit">

			Search

		</button>

	</form>

</section>