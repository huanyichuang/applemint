<div class="popular-posts">
<?php 
$query = new WP_Query( array(
  	'post_type' => 'post',
    'posts_per_page' => 9
)); 
if ( $query -> have_posts() ) : ?>
  <div class="grid-row">
<?php while ( $query -> have_posts() ) : $query -> the_post();?>
  <div class="col-4 pricing-blocks-desc">
    <article id="post-<?php the_ID(); ?>" <?php post_class("post post-single"); ?> itemscope itemtype="https://schema.org/BlogPosting">
    <a href="<?php esc_html(the_permalink());?>">
      <?php if (has_post_thumbnail()) { the_post_thumbnail(['class'=>'blog-archive-img']);} 
      else {echo '<img class="blog-archive-img" src="https://source.unsplash.com/random/280x210" alt="applemint blog posts">';}; ?>
      <h1 class="page-title col-4-h1">
      <?php the_title(); ?>
      </h1>
    </a>
    </article>  
    </div>
    <?php endwhile; 
    the_posts_pagination( array(
	'mid_size'  => 2,
	'screen_reader_text' => ' '
) );
    else: echo 'no query';?> </div> <?php endif;
  ?>
</div>
