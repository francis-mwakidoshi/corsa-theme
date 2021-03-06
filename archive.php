<?php
define('NO_PAGESECTIONS', TRUE);
define('IS_BLOG', TRUE);

get_header();
 ?>
	<section class="l-section">

		<div class="l-subsection">
			<div class="l-subsection-h">
				<div class="l-subsection-hh g-html i-cf">

					<div class="l-content">
					<?php /* If this is a category archive */ if (is_category()) { ?>
						<h2><?php _e('Category Archive for', 'us') ?> &quot;<?php single_cat_title(); ?>&quot; </h2>

						<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
						<h2><?php _e('Posts Tagged', 'us') ?> &quot;<?php single_tag_title(); ?>&quot;</h2>

						<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
						<h2><?php _e('Archive for', 'us') ?> <?php the_time('F jS, Y'); ?></h2>

						<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<h2><?php _e('Archive for', 'us') ?> <?php the_time('F, Y'); ?></h2>

						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<h2><?php _e('Archive for', 'us') ?> <?php the_time('Y'); ?></h2>

						<?php /* If this is an author archive */ } elseif (is_author()) { ?>
						<h2><?php _e('Author Archive', 'us') ?></h2>

						<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<h2><?php _e('Blog Archives', 'us') ?></h2>
					<?php } ?>

					<div class="hr type_invisible"></div>

						<div class="w-blog imgpos_atleft more_hidden">
							<div class="w-blog-h">
								<div class="w-blog-list">
									<?php while (have_posts()) : the_post();
										if (has_post_thumbnail()) {
											$the_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-list');
											$the_thumbnail = $the_thumbnail[0];
										} else {
											$the_thumbnail =  get_template_directory_uri() .'/img/placeholder/500x500.gif';
										}
										?>
										<div <?php post_class('w-blog-entry') ?>>
											<div class="w-blog-entry-h">
												<a class="w-blog-entry-link" href="<?php echo get_permalink(get_the_ID());?>">
												<span class="w-blog-entry-preview">
													<img src="<?php echo $the_thumbnail;?>" alt="">
												</span>

													<h2 class="w-blog-entry-title">
														<span class="w-blog-entry-title-h"><?php echo get_the_title();?></span>
													</h2>
												</a>
												<div class="w-blog-entry-body">
													<div class="w-blog-entry-meta">
														<div class="w-blog-entry-meta-date">
															<span class="w-blog-entry-meta-date-month"><?php echo get_the_date('M');?></span>
															<span class="w-blog-entry-meta-date-day"><?php echo get_the_date('d');?></span>
															<span class="w-blog-entry-meta-date-year"><?php echo get_the_date('Y');?></span>
														</div>

														<div class="w-blog-entry-meta-comments">
															<a class="w-blog-entry-meta-comments-h" href="<?php echo get_permalink(get_the_ID());?>#comments"><i class="fa fa-comments"></i><?php echo get_comments_number();?></a>
														</div>
													</div>

													<div class="w-blog-entry-short">
														<?php echo apply_filters('the_excerpt', get_the_excerpt());?>
													</div>

												</div>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
							</div>
						</div>

						<?php if (function_exists('us_pagination') AND $pagination = us_pagination()) { ?>
							<div class="g-hr type_invisible"></div>
							<div class="g-pagination">
								<?php echo $pagination ?>
							</div>
						<?php } else  { ?>
							<div class="g-hr type_invisible"></div>
							<div class="g-pagination">
								<?php posts_nav_link(' ', '<span class="g-pagination-item to_prev">&laquo; Prev</span>',  '<span class="g-pagination-item to_next">Next &raquo;</span>'); ?>
							</div>
						<?php } ?>

					</div>
					<div class="l-sidebar">
						<?php if (@$smof_data['post_sidebar_pos'] != 'No Sidebar') {
							dynamic_sidebar('default_sidebar');
						} ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
get_footer();