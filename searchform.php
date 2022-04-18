<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">

  <button type="submit" class="search-submit">

    <i class="fa fa-search" aria-hidden="true"></i>

  </button>

  <input 	type="search" class="search-field"
    placeholder="<?php echo esc_attr_x( 'Search for a course', 'placeholder' ) ?>"
    value="<?php echo get_search_query() ?>" name="s"
    title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"
  />

</form>