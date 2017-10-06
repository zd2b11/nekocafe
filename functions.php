<?php

/*
 * メニューの有効化
 */
register_nav_menus();


/*
 * アイキャッチ画像の有効化
 */
add_theme_support('post-thumbnails');


/*
 * 画像サイズの登録
 */
add_image_size('news-thumb-small', 80, 80, true);
add_image_size('news-thumb-large', 200, 200, true);
add_image_size('neko-staff-img', 300, 300, true);
add_image_size('food-img', 420, 420, true);


/*
 * カスタム投稿タイプ：店長メッセージ
 */
register_post_type(
	'maro_message',
		array(
			'labels' => array(
			'name' => '★店長メッセージ',
			'add_new_item' => '★追加：店長メッセージ',
			'edit_item' => '★編集：店長メッセージ'
		),
		'public' => true,
		'supports' => array('title')
	)
);

/*
 * カスタム投稿タイプ：お知らせ
 */
register_post_type(
	'notice',
		array(
			'labels' => array(
			'name' => '★お知らせ',
			'add_new_item' => '★追加：お知らせ',
			'edit_item' => '★編集：お知らせ'
		),
		'public' => true,
		'supports' => array('title', 'editor')
	)
);

/*
 * カスタム投稿タイプ：ニュース
 */
register_post_type(
	'news_single',
		array(
			'labels' => array(
			'name' => '★ニュース',
			'add_new_item' => '★追加：ニュース',
			'edit_item' => '★編集：ニュース'
		),
		'public' => true,
		'supports' => array('title', 'editor',  'thumbnail')
	)
);


/*
 * カスタム投稿タイプ：猫スタッフ
 */
register_post_type(
		'neko_staff',
		array(
				'labels' => array(
						'name' => '★猫スタッフ',
						'add_new_item' => '★追加：猫スタッフ',
						'edit_item' => '★編集：猫スタッフ'
				),
				'public' => true,
				'supports' => array('title', 'thumbnail')
		)
);

/*
 * カスタム投稿タイプ：フードメニュー
 */
register_post_type(
		'food_menu',
		array(
				'labels' => array(
						'name' => '★フードメニュー',
						'add_new_item' => '★追加：フードメニュー',
						'edit_item' => '★編集：フードメニュー'
				),
				'public' => true,
				'supports' => array('title', 'thumbnail')
		)
);



/*
 * カスタム投稿タイプ：フォト
 */
register_post_type(
		'photo',
		array(
				'labels' => array(
						'name' => '★フォト',
						'add_new_item' => '★追加：フォト',
						'edit_item' => '★編集：フォト'
				),
				'public' => true,
				'supports' => array('title', 'thumbnail')
		)
);


?>