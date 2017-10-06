<?php get_header(); ?>

        <main>
          <div class="main-contents">

            <div class="concept">
              <h2 class="caption-box">猫カフェ マロ とは</h2>
              <div class="concept-area">
                <p>○○県○○市<br>
                  JR ○○駅から徒歩２分</p>
                <p>店長マロをはじめとする個性豊かな猫スタッフが皆さまをお待ちしております。</p>
                <p>落ち着いた雰囲気の店内で、ふわふわの猫たちと一緒に遊んだり、読書したり、お茶を飲みながらのんびりゆったり癒しのお時間をお楽しみいただけます。</p>
              </div>
            </div>

            <div class="notice">
              <?php
              $args = array(
              'post_type' => 'notice',
              'post_status' => 'publish',
              'posts_per_page' => -1
              );
              $customPosts = get_posts($args);
              ?>

              <?php if ($customPosts): ?>
              <h2 class="caption-box">お知らせ</h2>
              <?php foreach ($customPosts as $post): setup_postdata($post); ?>

              <div class="notice-area">
                <div class="date-time">
                  <p><?php the_time('Y年m月d日 H時i分'); ?></p>
                </div>
                <div class="notice-text">
                  <?php the_content(); ?>
                </div>
              </div>

              <?php endforeach; ?>
              <?php endif; ?>
              <?php wp_reset_postdata(); ?>
            </div>

            <div class="news">
              <h2 class="caption-box">新着ニュース</h2>
              <div class="news-area">
                <ul>

                <?php
                $args = array(
                'post_type' => 'news_single',
                'post_status' => 'publish',
                'posts_per_page' => 3
                );
                $customPosts = get_posts($args);
                ?>

                <?php if ($customPosts): ?>
                <?php foreach ($customPosts as $post): setup_postdata($post); ?>

                  <li>
                    <div class="news-box">
                      <div class="img-date-title">
                        <div class="news-thumb">
                          <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                              <?php the_post_thumbnail('news-thumb-large'); ?>
                            <?php else: ?>
                              <img src="<?php echo get_template_directory_uri(); ?>/images/logo_200.jpg">
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
                              }else{
                                echo $post->post_title;
                              }
                            ?>
                            </a>
                          </p>
                        </div>
                      </div>
                    </div>
                  </li>

                <?php endforeach; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>

                </ul>
                <div class="news-all-btn">
                  <a href="<?php echo home_url('/news_all/'); ?>">ニュース一覧を表示する</a>
                </div>
              </div>
            </div>
          </div>
        </main>
<?php get_footer(); ?>