<div class="code-block-content archive grid-row">
<?php 

while (have_posts()) {

the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class("post post-single col-4 pricing-blocks-desc"); ?> itemscope itemtype="https://schema.org/BlogPosting">

  <?php if ( has_post_thumbnail() ) { ?> 

<div class="code-block-content">
	<div class="post-featured-image">
  		<?php the_post_thumbnail(['class'=>'blog-archive-img']); ?>
  	</div>
</div>

<?php
}
?>
  <div class="post-titles">
    <a href="<?php the_permalink(); ?>">
      <h1 class="page-title col-4-h1">
        <?php the_title(); ?>
    </h1>
    </a>

  </div>
</article>
<?php
}
?>
</div>
<div class="code-block-content archive">
<div class="nav-next alignright"><?php next_posts_link( '  Next › ' ); ?></div>
<div class="nav-previous alignleft"><?php previous_posts_link( ' ‹ Previous ' ); ?></div>
</div>
