<?php get_header(); ?>


        <main>
          <div class="main-contents">
            <h2 class="caption-box">ニュース 一覧</h2>


            <?php
              $paged = (int) get_query_var('paged');
              $args = array(
                'posts_per_page' => 5,
                'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'news_single',
                'post_status' => 'publish'
              );
              $the_query = new WP_Query($args);
            ?>

            <?php if ($the_query->have_posts()): ?>

            <div class="newslist-area">
              <ul>

              <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                <li>
                  <div class="news-box">
                    <div class="news-thumb">
                      <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('news-thumb-small'); ?>
                        <?php else: ?>
                          <img src="<?php echo get_template_directory_uri(); ?>/images/logo_80.jpg">
                        <?php endif; ?>
                      </a>
                    </div>
                    <div class="date-title">
                      <p class="news-date"><?php the_time('Y年m月d日'); ?></p>
                      <p class="news-time"><?php the_time('H時i分'); ?></p>
                      <p class="news-title">
                        <a href="<?php the_permalink(); ?>">
                        <?php
                          if(mb_strlen($post->post_title, 'UTF-8')>20){
                            $title= mb_substr($post->post_title, 0, 20, 'UTF-8');
                            echo $title . '……';
                          }
                          else{
                            echo $post->post_title;
                          }
                        ?>
                        </a>
                      </p>
                    </div>
                  </div>
                </li>

              <?php endwhile; ?>

              </ul>
            </div>

            <div class="page-area">
              <?php
                if ($the_query->max_num_pages > 1) {
                  $page_format = paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%/',
                    'current' => max(1, $paged),
                    'total' => $the_query->max_num_pages,
                    'mid_size' => 1,
                    'end_size' => 1,
                    'type' => 'array',
                    'prev_text' => ('新しいページへ'),
                    'next_text' => ('古いページへ')
                  ));

                  // var_dump($page_format);

                  if( is_array($page_format) ) {
                    echo '<ul>';
                    // echo "test:" . $paged;
                    if ($paged <= 1) {
                      echo '<li><span class="btn-disable">新しいページへ</span></li>';
                    }
                    foreach ( $page_format as $page ) {
                        echo "<li>$page</li>";
                    }
                    if ($paged == $the_query->max_num_pages) {
                      echo '<li><span class="btn-disable">古いページへ</span></li>';
                    }
                    echo '</ul>';
                  }
                }
              ?>
            </div>

            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

          </div>
        </main>

<?php get_footer(); ?>