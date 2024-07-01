<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

function add_custom_scripts() {
  // JavaScriptファイルを読み込む
  wp_enqueue_script('custom-script', get_template_directory_uri() . 'js/javascript.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');


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