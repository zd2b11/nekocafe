<?php get_header(); ?>

        <main>
          <div class="main-contents">
            <div id="neko-staff">
              <h2 class="caption-box">猫スタッフ</h2>
              <ul>

              <?php
                $args = array(
                    'post_type' => 'neko_staff',
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                );
                $customPosts = get_posts($args);
              ?>
              <?php if ($customPosts) :?>
                <?php foreach ($customPosts as $post) : setup_postdata($post); ?>

                  <li>
                    <div class="neko-staff-box">
                      <div class="neko-staff-img">
                        <a class="popup-modal" href="#profile-<?php echo $post->ID ;?>">
                        <?php if (has_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('neko-staff-img'); ?>
                        <?php else: ?>
                          <img src="<?php echo get_template_directory_uri(); ?>/images/logo_300.jpg">
                        <?php endif; ?>
                        </a>
                      </div>
                      <div class="staffname-area">
                        <div class="btn-area">
                          <a class="popup-modal staffname" href="#profile-<?php echo $post->ID ;?>"><?php echo mb_strimwidth(post_custom('neko_name'), 0, 20, ''); ?></a>
                        </div>
                      </div>
                    </div>

                    <div id="profile-<?php echo $post->ID ;?>" class="mfp-hide">
                      <div class="inline-box">
                        <div class="profile-image">
                          <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large'); ?>
                          <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo_300.jpg">
                          <?php endif; ?>
                        </div>
                        <div class="profile-text">
                          <p>名前：<?php echo mb_strimwidth(post_custom('neko_name'), 0, 20, ''); ?></p>
                          <p>性格：<?php echo mb_strimwidth(post_custom('neko_seikaku'), 0, 30, ''); ?></p>
                          <p>性別：<?php echo post_custom('neko_osu_mesu'); ?></p>
                          <p><?php echo mb_strimwidth(post_custom('neko_comment'), 0, 200, ''); ?></p>
                        </div>
                      </div>
                      <div class="popup-modal-close">
                        <a href="#" class="close-btn">閉じる</a>
                      </div>
                    </div>

                  </li>

                <?php endforeach; ?>
              <?php endif; ?>
              <?php wp_reset_postdata(); ?>

              </ul>
            </div>
            <div id="price-list">
              <h2 class="caption-box">料金案内</h2>
              <div class="price-list-area">
                <table>
                  <tr>
                    <th class="plan">プラン</th>
                    <th>平日</th>
                    <th>土・日・祝</th>
                  </tr>
                  <tr>
                    <th class="plan">30分ごと</th>
                    <td class="weekday">500円</td>
                    <td class="holiday">600円</td>
                  </tr>
                  <tr>
                    <th class="plan">90分セット</th>
                    <td class="weekday">1,200円</td>
                    <td class="holiday">1,500円</td>
                  </tr>
                  <tr>
                    <th class="plan">120分セット</th>
                    <td class="weekday">1,500円</td>
                    <td class="holiday">1,800円</td>
                  </tr>
                  <tr>
                    <th class="plan">180分セット</th>
                    <td class="weekday">2,000円</td>
                    <td class="holiday">2,400円</td>
                  </tr>
                  <tr>
                    <th class="plan">フリータイム</th>
                    <td class="weekday">2,500円</td>
                    <td class="holiday">3,000円</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </main>

<?php get_footer(); ?>