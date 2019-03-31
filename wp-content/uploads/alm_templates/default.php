<div class='xoneArticleBox xoneInfinite'>
<?php if ( has_post_thumbnail() ){ ?>
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(420, 320)) ?></a>
	<?php }
	$category = get_the_category();
	?>
<a href="<?php get_category_link( $catName[0]->term_id ) ?>">
	<div class='artCategory'><?php echo $category[0]->cat_name; ?></div></a>
<a href="<?php the_permalink(); ?>"><div class='artTitle'><?php the_title(); ?></div>
<div class='artContent'>
<?php 
$pos=strpos(get_the_content(), ' ', 210);
echo substr(get_the_content(),0,$pos ); ?>
</div>
</a>
</div>