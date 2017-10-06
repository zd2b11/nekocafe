<?php get_header(); ?>

        <main>
          <div class="main-contents">
            <h2 class="caption-box">フォトギャラリー</h2>
            <div class="photo-area">
              <ul>
              <?php
              $args = array(
                'post_type' => 'photo',
                'post_status' => 'publish',
                'posts_per_page' => -1
              );
              $customPosts = get_posts($args);
              ?>

              <?php if ($customPosts): ?>
              <?php foreach ($customPosts as $post): setup_postdata($post); ?>

              <?php
                $thumb =
                  wp_get_attachment_image_src(
                      get_post_thumbnail_id($post->ID),
                      'full'
                  );
                  $url = $thumb['0'];
              ?>
              <?php if ($url) :?>
              <li>
                <a class="thumb" href="<?php echo $url; ?>" rel="lightbox">
                  <?php
                      the_post_thumbnail(
                        'neko-staff-img',
                        array(
                        'title' => get_the_title()
                        )
                      );
                  ?>
                </a>
              </li>
              <?php endif; ?>

            <?php endforeach; ?>
            <?php endif;?>

            <?php wp_reset_postdata(); ?>
              </ul>
            </div>
          </div>
        </main>

<?php get_footer(); ?>
