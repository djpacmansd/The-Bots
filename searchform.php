<form id="bots-search" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label for="search_bar">
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
    <input id="search_bar" type="search" class="search_bar" placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder' ) ?>"
    value="<?php echo get_search_query() ?>" name="s">
  </label>
  <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>
  


