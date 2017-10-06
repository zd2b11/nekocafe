<?php get_header(); ?>

				<main>
					<div class="main-contents">
						<div id="food-area">
							<?php
								$args = array(
										'post_type' => 'food_menu',
										'post_status' => 'publish',
										'posts_per_page' => -1
								);
								$customPosts = get_posts($args);
							?>
							<?php if ($customPosts) :?>

							<h2 class="caption-box">フード</h2>
							<div class="osusume-menu">
								<ul>

									<?php foreach ($customPosts as $post) : setup_postdata($post); ?>
										<?php if (post_custom('food_category') == "フード" and post_custom('food_osusume') == "おすすめ"): ?>

										<li>
											<div class="osusume-box">
													<div class="food-img">
													<?php if (has_post_thumbnail()) : ?>
														<?php the_post_thumbnail('food-img'); ?>
													<?php else: ?>
														<img src="<?php echo get_template_directory_uri(); ?>/images/logo_420.jpg">
													<?php endif; ?>
												</div>
												<div class="foodname-area">
													<p class="foodname"><?php echo mb_strimwidth(post_custom('food_name'), 0, 30, '', 'utf-8'); ?></p>
												</div>
											</div>
										</li>

										<?php endif; ?>
									<?php endforeach; ?>

								</ul>
							</div>
							<div class="sonota-menu">
								<ul>

									<?php foreach ($customPosts as $post) : setup_postdata($post); ?>
										<?php if (post_custom('food_category') == "フード"): ?>

										<li>
											<div class="food-name">
												<p><?php echo mb_strimwidth(post_custom('food_name'), 0, 30, '', 'utf-8'); ?></p>
											</div>
											<div class="food-price">
												<p>&yen;<?php echo mb_strimwidth(post_custom('food_price'), 0, 6, '', 'utf-8'); ?></p>
											</div>
										</li>

										<?php endif; ?>
									<?php endforeach; ?>

								</ul>
							</div>
						</div>
						<div id="drink-area">
							<h2 class="caption-box">ドリンク</h2>
							<div class="osusume-menu">
								<ul>

									<?php foreach ($customPosts as $post) : setup_postdata($post); ?>
										<?php if (post_custom('food_category') == "ドリンク" and post_custom('food_osusume') == "おすすめ"): ?>

										<li>
											<div class="osusume-box">
													<div class="food-img">
														<?php if (has_post_thumbnail()) : ?>
															<?php the_post_thumbnail('food-img'); ?>
														<?php else: ?>
															<img src="<?php echo get_template_directory_uri(); ?>/images/logo_420.jpg">
														<?php endif; ?>
													</div>
												<div class="foodname-area">
													<p class="foodname"><?php echo mb_strimwidth(post_custom('food_name'), 0, 30, '', 'utf-8'); ?></p>
												</div>
											</div>
										</li>

										<?php endif; ?>
									<?php endforeach; ?>

								</ul>
							</div>
							<div class="sonota-menu">
								<ul>

									<?php foreach ($customPosts as $post) : setup_postdata($post); ?>
										<?php if (post_custom('food_category') == "ドリンク"): ?>

										<li>
											<div class="food-name">
												<p><?php echo mb_strimwidth(post_custom('food_name'), 0, 30, '', 'utf-8'); ?></p>
											</div>
											<div class="food-price">
												<p>&yen;<?php echo mb_strimwidth(post_custom('food_price'), 0, 6, '', 'utf-8'); ?></p>
											</div>
										</li>

										<?php endif; ?>
									<?php endforeach; ?>

								</ul>
							</div>
						</div>
						<div id="neko-oyatu-area">
							<h2 class="caption-box">猫おやつ</h2>
							<div class="osusume-menu">
								<ul>

									<?php foreach ($customPosts as $post) : setup_postdata($post); ?>
										<?php if (post_custom('food_category') == "猫おやつ" and post_custom('food_osusume') == "おすすめ"): ?>

										<li>
											<div class="osusume-box">
													<div class="food-img">
														<?php if (has_post_thumbnail()) : ?>
															<?php the_post_thumbnail('food-img'); ?>
														<?php else: ?>
															<img src="<?php echo get_template_directory_uri(); ?>/images/logo_420.jpg">
														<?php endif; ?>
													</div>
												<div class="foodname-area">
													<p class="foodname"><?php echo mb_strimwidth(post_custom('food_name'), 0, 30, '', 'utf-8'); ?></p>
												</div>
											</div>
										</li>

										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="sonota-menu">
								<ul>

									<?php foreach ($customPosts as $post) : setup_postdata($post); ?>
										<?php if (post_custom('food_category') == "猫おやつ"): ?>

										<li>
											<div class="food-name">
												<p><?php echo mb_strimwidth(post_custom('food_name'), 0, 30, '', 'utf-8'); ?></p>
											</div>
											<div class="food-price">
												<p>&yen;<?php echo mb_strimwidth(post_custom('food_price'), 0, 6, '', 'utf-8'); ?></p>
											</div>
										</li>

										<?php endif; ?>
									<?php endforeach; ?>

								</ul>
							</div>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>

						</div>
					</div>
				</main>

<?php get_footer(); ?>