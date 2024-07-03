<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

// function add_custom_scripts() {
//   // JavaScriptファイルを読み込む
//   wp_enqueue_script('custom-script', get_stylesheet_directory() . '/js/javascript.js', array(), null, true);
// }
// add_action('wp_enqueue_scripts', 'add_custom_scripts');


function tag_echo_php( $atts ){
  ob_start();
  get_template_part('get_tag_name'); 
  return ob_get_clean();
}
add_shortcode( 'TAG_NAME', 'tag_echo_php' );

/* PHPの読み込み
---------------------------------------------------------- */
// function expand_stores_html() {
//   ob_start();
//   include 'stores.php';
//   return ob_get_clean();
// }
// add_shortcode('stores', 'expand_stores_html');

// GPT記載のコード１ ->sc_testと同じ内容を出力する。

function expand_stores_html() {
  // 出力バッファリングを開始
  ob_start();
  
  // テーマディレクトリ内のstores.phpファイルのパスを取得
  $file_path = get_stylesheet_directory() . '/stores.php';

  // ファイルが存在するか確認
  if (file_exists($file_path)) {
      // stores.phpファイルを含む
      include $file_path;
  } else {
      // ファイルが見つからない場合のエラーメッセージ
      echo "Error: stores.php file not found.";
  }
  
  // 出力バッファリングの内容を返す
  return ob_get_clean();
}

// ショートコードを追加
add_shortcode('stores', 'expand_stores_html');

function shortcode_test(){
  ob_start();
  $data = get_stylesheet_directory() . '/stores.php';
  include $data;
  return ob_get_clean();
}
add_shortcode('sc_test', 'shortcode_test');

// クッキー取得情報一覧表示
// ショートコードの追加
// functions.php

// // お気に入りリストを表示するショートコードの関数
// function display_favorite_shops() {
//   global $wpdb;

//   // クッキーからお気に入りのショップIDを取得
//   if (isset($_COOKIE['favorites'])) {
//       $favorite_ids = explode(',', $_COOKIE['favorites']);
//   } else {
//       return '<p>No favorites added yet.</p>';
//   }

//   if (empty($favorite_ids)) {
//       return '<p>No favorites added yet.</p>';
//   }

//   // ショップ情報を取得するためのクエリを構築
//   $placeholders = implode(',', array_fill(0, count($favorite_ids), '%d'));
//   $query = $wpdb->prepare("SELECT * FROM wp_gongcha WHERE id IN ($placeholders)", $favorite_ids);
//   $favorite_shops = $wpdb->get_results($query);

//   // お気に入りリストのHTMLを生成
//   $output = '<div class="favorite-shops">';
//   foreach ($favorite_shops as $shop) {
//       $output .= '<div class="shop-one" data-shop-id="' . esc_attr($shop->id) . '">';
//       $output .= '<h3>' . esc_html($shop->name) . '</h3>';
//       $output .= '<p>' . esc_html($shop->description) . '</p>';
//       $output .= '<a href="' . esc_url($shop->link) . '">詳細を見る</a>';
//       $output .= '</div>';
//   }
//   $output .= '</div>';

//   return $output;
// }

// // ショートコードを登録
// add_shortcode('favorite_shops', 'display_favorite_shops');

// ショートコード: お気に入りのページ一覧を表示
function display_favorites_list() {
  global $wpdb;
  $output = '<div class="container">';

  if (isset($_COOKIE['favorites'])) {
      $favorites = explode(',', $_COOKIE['favorites']);

      if (!empty($favorites)) {
          $count = 0;
          $output .= '<div class="row">';
          foreach ($favorites as $id) {
              $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM wp_gongcha WHERE id = %d", $id));

              if ($data) {
                  if ($count > 0 && $count % 2 == 0) {
                      $output .= '</div><div class="row">';
                  }

                  ob_start();
                  $template_data = array('data' => $data, 'id' => $id);
                  extract($template_data);
                  include locate_template('favorite-template.php');
                  $output .= ob_get_clean();

                  $count++;
              }
          }
          $output .= '</div>';
      } else {
          $output .= '<p>お気に入りに登録されているショップはありません。</p>';
      }
  } else {
      $output .= '<p>お気に入りに登録されているショップはありません。</p>';
  }

  $output .= '</div>';
  return $output;
}
add_shortcode('favorites_list', 'display_favorites_list');
