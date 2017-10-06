      <footer>
        <div class="footer-container">
          <div class="footer-info">
            <div class="shop-info-text">
              <h2><?php bloginfo('name'); ?></h2>
              <table>
                <tr>
                  <th>●住所</th>
                  <td>〒000-0000
                    <br> 〇〇〇〇●〇〇〇〇●〇〇〇〇●
                    <br> 0-0-0　〇〇〇〇● 0F
                    <br>
                    <div class="google-btn">
                      <a href="<?php echo home_url('/map'); ?>">google mapで見る</a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>●TEL</th>
                  <td>00-0000-0000</td>
                </tr>
                <tr>
                  <th>●EMAIL</th>
                  <td>xxxxxxx@xxxxx.com</td>
                </tr>
                <tr>
                  <th>●営業時間</th>
                  <td>10:00-20:00　※火曜日定休</td>
                </tr>
              </table>
            </div>
            <div class="footer-map">
              <img src="<?php echo get_template_directory_uri(); ?>/images/map.jpg" alt="">
            </div>
          </div>
          <p class="copyright"><small>Copyright &copy; 2017 nekocafe-maro. All rights reserved.</small></p>
        </div>
      </footer>
    </div>
    <?php wp_footer(); ?>
  </body>

</html>
