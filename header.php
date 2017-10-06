<?php

$bodyClass = "";
$css = "";
$subname = "";

/*
 * --------------------------
 * body タグのクラス名をページ毎に変える トップ画像を変えるため
 * --------------------------
 */

if (is_404 ()) {
  $bodyClass = "page404";
}
elseif (is_singular ('news_single')) {
  $bodyClass = "news_single";
}
else {
  $bodyClass = $post->post_name;
}

/*
 * --------------------------
 * ページ毎にCSSファイルを読み込む
 * --------------------------
 */

if (is_404 ()) {
  $css = "done_error_404";
}
elseif (is_singular('news_single')) {
  $css = "news_single";
}
elseif (is_page(array('contact_done','contact_error'))) {
  $css = "done_error_404";
}
else {
  $css = $post->post_name;
}


if ($bodyClass == "news_all") {
  $subname = "ニュース 一覧";
}
if ($bodyClass == "shop") {
  $subname = "店舗情報";
}
elseif ($bodyClass == "menu") {
  $subname = "フードメニュー";
}
elseif ($bodyClass == "photo") {
  $subname = "ギャラリー";
}
elseif ($bodyClass == "contact") {
  $subname = "お問い合わせ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="format-detection" content="telephone=no">
<title><?php bloginfo('name'); ?></title>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/marofavicon.ico">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/marowebclip.png">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sanitize.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/common.css">
<?php if ($css)
  echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/' . $css . '.css">';
?>
<?php if ($bodyClass == 'shop')
  echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/magnific-popup.css">';
?>
<link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/earlyaccess/nikukyu.css" rel="stylesheet">
<?php wp_head(); ?>
<script>
  jQuery(function($) {
    var headerNav = $('.header-nav');
    var mainImg = $('.main-img');
    var offset = mainImg.height();
    var timer = 0;
    var href;
    // ナビゲーションの固定
    function setClassFixed(){
      if ($(window).scrollTop() > 0) {
        headerNav.addClass('mobile-fixed');
      } else {
        headerNav.removeClass('mobile-fixed');
      }
      if ($(window).scrollTop() > offset) {
        headerNav.addClass('pc-fixed');
      } else {
        headerNav.removeClass('pc-fixed');
      }
    }
    // サブメニューを閉じる
    function closeMenu(){
      $(".main-menu-link").removeClass('open');
      $(".sub-menu-area").removeClass('show').addClass('hide');
    }

    // 画像を読み込んだとき
    $(window).load(function() {
      offset = mainImg.height();
      // console.log("画像を読み込んだとき:" + offset);
      setClassFixed();
    });
    // スクロールしたとき
    $(window).scroll(function() {
      // console.log("スクロールしたとき：" + $(this).scrollTop());
      setClassFixed();
    });
    // ウインドウ幅が変わったとき
    //    重さ軽減のため、タイマー使用(↓スクロールは動きがぎこちなくなるからタイマーなしで)
    //    $(window).on('scroll resize',function(){
    $(window).resize(function(){
      if (timer > 0) {
        clearTimeout(timer);
      }
      timer = setTimeout(function () {
        offset = mainImg.height();
        setClassFixed();
      }, 500);
    });

    // モバイルデザイン右上のメニューボタン開閉
    $('.navbtn').click(function() {
      headerNav.toggleClass('open');
      if ($(".gl-nav").css("display")=="none"){
        closeMenu();
      }
    });

    // メインメニューのリンクがクリックされたとき
    $(".sub-menu-area").removeClass('show').addClass('hide');  // 一旦全てのサブメニューを非表示にする
    $(".main-menu-link").click(function(){
      if($(this).parent().hasClass('nav-shop') || $(this).parent().hasClass('nav-menu')){
        if($(this).hasClass('open')){
          // サブメニューが開かれている状態でメインメニューのリンクがクリックされたとき
          closeMenu();
          href = $(this).attr("href");
          location.href = href;
        }
        else {
          // サブメニューが閉じている状態でメインメニューのリンクがクリックされたとき
          $(".main-menu-link").removeClass('open');  // 一旦全てのメインメニューのopenを外す
          $(this).addClass('open');  // クリックされたメニューにopenをつける
          $(".sub-menu-area").removeClass('show').addClass('hide');  // 一旦全てのサブメニューを非表示にする
          $("+ul",this).removeClass('hide').addClass('show');  // クリックされたところだけサブメニューを開く
          return false;  // サブメニューを開いた直後はまだ飛ばない
        }
      }
    });

    // サブメニューのリンクがクリックされたとき
    $(".sub-menu-link").click(function() {
      var speed = 500; // スクロールの速度(ミリ秒)
      var parentLink = $(this).closest('.main-menu-list').find("a").attr("href");  // 親メニューのリンク先取得
      var subLink = $(this).attr("href").split('#');  // サブメニューのリンク先を#で区切って配列に入れる
      var position;

      headerNav.removeClass('open');
      closeMenu();

      if (parentLink == subLink[0]){
        // 同じページ内のリンクなら、スムーススクロール
        position = $('#' + subLink[1]).offset().top;     // リンク先の要素の位置を取得
        $('body,html').animate({scrollTop:position}, speed, 'swing');
      }
      else {
        href = $(this).attr("href");
        location.href = href;
      }
      return false;
    });

    // メニュー以外の場所がクリックされたとき、メニューを閉じる
    $(function() {
      headerNav.on('click', function(e) {
        e.stopPropagation();
      });
      $(document).on('click', function() {
        headerNav.removeClass('open');
        closeMenu();
      });
    });

  });
</script>

<?php if ($bodyClass == 'top'): ?>
  <?php
    // 「トップ」ページのとき、店長メッセージを取得
    $args = array(
    'post_type' => 'maro_message',
    'post_status' => 'publish',
    'posts_per_page' => -1
    );
    $customPosts = get_posts($args);
    if ($customPosts) {
      foreach ($customPosts as $post) {
        setup_postdata($post);
        $msg_array[] = post_custom('maro_message_text');
      }
    }
    wp_reset_postdata();
  ?>
<script>
  jQuery(function($) {
    // 店長メッセージの表示
    var msg_arr = <?php echo json_encode($msg_array, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;  // 店長メッセージ
    var msg_num = 0; // 現在のメッセージ番号
    var msg_max = msg_arr.length; // メッセージの最大値
    var interval = 2000; // 切り替えの間隔

    function cycleMsg(){
      $('.maro-message').fadeOut('slow', function(){
        $('.msg-text').text(setMsg());
      });
      $('.maro-message').fadeIn('slow', function(){
        setTimeout(cycleMsg, interval);  //再び自分自身を呼び出す
      });
    }

    function setMsg(){
      var msg_text = msg_arr[msg_num];
      msg_num++;  // 次のメッセージ番号を準備
      if(msg_num == msg_max) msg_num = 0;
      return msg_text;
    }

    $('.msg-text').text(setMsg());  // はじめに表示しておく文字
    setTimeout(cycleMsg, interval);  // 一定時間毎にメッセージを変更
  });
</script>
<?php endif; ?>

<?php if ($bodyClass == 'shop'): ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.magnific-popup.min.js"></script>
<script>
  jQuery(function($) {
    // 「ショップ」ページのとき、猫スタッフをモーダルで表示(Magnific Popupプラグイン使用)
    $('.popup-modal').magnificPopup({
      type: 'inline',
      preloader: false,
      gallery: {
          enabled:true
      }
    });
    //閉じるリンクの設定
    $(document).on('click', '.popup-modal-close', function (e) {
      e.preventDefault();
      $.magnificPopup.close();
    });
  });
</script>
<?php endif; ?>
</head>

<body class="<?php echo $bodyClass; ?>">
  <div class="back-img">
    <header class="gl-header">
      <div class="header-nav">
        <div class="mobile-head">
          <div class="logo">
            <div class="logo-img">
              <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo_h40.png" alt="<?php bloginfo('name'); ?>">
              </a>
            </div>
            <div class="shop-name">
              <h1><?php bloginfo('name'); ?></h1>
            </div>
          </div>
          <div class="navbtn">
            <div class="navbtn-line">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <p>メニュー</p>
          </div>
        </div>
        <nav class="gl-nav">
          <ul class="main-menu-area">

          <?php $navItems = wp_get_nav_menu_items('nekonavi'); ?>
          <?php foreach ($navItems as $navItem): ?>
          <li class="nav-<?php echo $navItem->post_excerpt; ?> main-menu-list">
            <a href="<?php echo $navItem->url; ?>" class="main-menu-link"><?php echo $navItem->title; ?></a>
          <?php if ($navItem->post_excerpt == 'shop'): ?>
            <ul class="sub-menu-area">
              <li class="sub-menu-list"><a href="<?php echo $navItem->url; ?>#neko-staff" class="sub-menu-link">猫スタッフ</a></li>
              <li class="sub-menu-list"><a href="<?php echo $navItem->url; ?>#price-list" class="sub-menu-link">料金案内</a></li>
            </ul>
          <?php endif; ?>
          <?php if ($navItem->post_excerpt == 'menu'): ?>
            <ul class="sub-menu-area">
              <li class="sub-menu-list"><a href="<?php echo $navItem->url; ?>#food-area" class="sub-menu-link">フード</a></li>
              <li class="sub-menu-list"><a href="<?php echo $navItem->url; ?>#drink-area" class="sub-menu-link">ドリンク</a></li>
              <li class="sub-menu-list"><a href="<?php echo $navItem->url; ?>#neko-oyatu-area" class="sub-menu-link">猫おやつ</a></li>
            </ul>
          <?php endif; ?>
          </li>
          <?php endforeach; ?>

          </ul>
        </nav>

      </div>
      <div class="main-img<?php if ($_SERVER["REQUEST_METHOD"] === "POST") echo " main-img-none" ;?>">
        <div class="main-img-area">
          <div class="main-img-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo_main_img.png" alt="">
          </div>
          <div class="page-title">
            <div class="page-name">
              <div class="page-name-area">
                <h1 class="page-main-name"><?php the_title(); ?></h1>
                <h2 class="page-sub-name"><?php echo $subname; ?></h2>
              </div>
            </div>
            <div class="page-img">
            <?php if (in_array($bodyClass, array('top', 'news_all', 'shop', 'menu', 'photo', 'contact'))): ?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $bodyClass; ?>_img.png" alt="">
            <?php endif; ?>
            <?php if ($bodyClass == 'top'): ?>
              <div class="maro-message">
                <div class="maro-msg-area">
                  <p class="msg-text"></p>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </header>