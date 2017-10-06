<?php get_header(); ?>

		<main>
			<div class="main-contents">
				<div class="news-single-area">
					<h2 class="caption-box">ニュース</h2>

					<?php if(have_posts()): ?>
						<?php while(have_posts()): the_post(); ?>

						<div class="news-single-box">
							<div class="img-date-title">
								<div class="news-thumb">
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail('news-thumb-large'); ?>
									<?php else: ?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/logo_200.jpg">
									<?php endif; ?>
								</div>
								<div class="date-title">
									<p class="news-date"><?php the_time('Y年m月d日 H時i分'); ?></p>
									<p class="news-title"><?php the_title(); ?></p>
								</div>
							</div>
							<div class="news-kiji">
								<?php the_content(); ?>
							</div>
						</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>

				<div class="btn-area">
					<?php if (get_next_post()): ?>
						<div class="new-btn">
							<?php next_post_link('%link', '新しい記事へ'); ?>
						</div>
					<?php else: ?>
						<div class="new-btn btn-disable">
							<p>新しい記事へ</p>
						</div>
					<?php endif;?>

					<?php if (get_previous_post()): ?>
						<div class="old-btn">
							<?php previous_post_link('%link', '古い記事へ'); ?>
						</div>
					<?php else: ?>
					<div class="old-btn btn-disable">
						<p>古い記事へ</p>
					</div>
					<?php endif;?>

					<div class="news-all-btn">
						<a href="<?php echo home_url('/news_all'); ?>">ニュース一覧を表示する</a>
					</div>
				</div>

			</div>
		</main>

<?php get_footer(); ?>