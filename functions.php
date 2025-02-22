<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く

function tag_echo_php( $atts ){
  ob_start();
  get_template_part('get_tag_name'); 
  return ob_get_clean();
}
add_shortcode( 'TAG_NAME', 'tag_echo_php' );

/* PHPの読み込み
---------------------------------------------------------- */

// Bootstrap読み込み
function inspiro_child_enqueue_styles() {
    // BootstrapのCSSを読み込む
    wp_enqueue_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );

    // 親テーマのスタイルを読み込む
    wp_enqueue_style( 'inspiro-parent-style', get_template_directory_uri() . '/style.css', array('bootstrap-css') );

    // 親テーマが読み込む style.min.css の後に子テーマのCSSを読み込む
    wp_enqueue_style( 'inspiro-child-style', get_stylesheet_directory_uri() . '/style.css', array('inspiro-parent-style'), null );
    
    // BootstrapのJavaScriptを読み込む
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'inspiro_child_enqueue_styles' );



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

// モーダルのメイン選択部分

// エリア検索
function custom_search_form_shortcode() {
    ob_start();
    include get_stylesheet_directory() . '/test.php';
    return ob_get_clean();
}
add_shortcode('custom_search_form', 'custom_search_form_shortcode');
// 店名検索
function custom_search_form_shortcode2() {
    ob_start();
    include get_stylesheet_directory() . '/test2.php';
    return ob_get_clean();
}
add_shortcode('custom_search_form2', 'custom_search_form_shortcode2');

function get_area_count($area) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'gongcha';
    $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE area = %s", $area ) );
    return $count;
}


// モーダル検索結果

// エリア検索
function modal_test(){
    ob_start();
    include get_stylesheet_directory() . '/search-results.php';
    return ob_get_clean();
  }
  add_shortcode('theme_page_templates', 'modal_test');

// 店名検索
function modal_test_second(){
    ob_start();
    include get_stylesheet_directory() . '/search-results2.php';
    return ob_get_clean();
  }
  add_shortcode('theme_page_templates_second', 'modal_test_second');

// タグ検索
function tag_search_button_shortcode() {
    // ボタンのHTMLを返す
    return '<form action="/tag-search" method="get">
                <button type="submit" name="tag" value="私服勤務">私服勤務</button>
            </form>';
}
add_shortcode('tag_search_button', 'tag_search_button_shortcode');



//　スライダーSlick
function enqueue_slick_slider() {
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-slider-js', get_template_directory_uri() . '/js/custom-slider.js', array('slick-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');

function enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome-5', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );

function add_google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Rounded+Mplus+1c&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// 他のコードがここにあるかもしれない

function enqueue_favorite_script() {
    wp_enqueue_script('favorite-script', get_stylesheet_directory_uri() . '/javascript.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_favorite_script');

// 投稿のLINEで問い合わせボタン
function add_scroll_button_to_posts($content) {
    if (is_single()) { // 単一投稿ページのみ
        $scroll_button = '
        <div id="scroll-button">
          <a href="https://lin.ee/bcrji1r">
            <div class="oubo">
              <div class="line-button">
                <div class="line-icon"></div>
                <span class="line-text">問い合わせる</span>
                <p class="line-subtext">24時間365日OK!</p>
              </div>
            </div>
          </a>
        </div>';
        $content .= $scroll_button; // 投稿の内容の最後にボタンを追加
    }
    return $content;
}
add_filter('the_content', 'add_scroll_button_to_posts');

// ブログカード
// 記事IDを指定して抜粋文を取得
function ltl_get_the_excerpt($post_id){
    global $post;
    $post_bu = $post;
    $post = get_post($post_id);
    setup_postdata($post_id);
    $output = get_the_excerpt();
    $post = $post_bu;
    return $output;
  }
  
  //ショートコード
  // ショートコード
function nlink_scode($atts) {
    extract(shortcode_atts(array(
        'url'=>"",
        'title'=>"",
        'excerpt'=>""
    ),$atts));

    $id = url_to_postid($url);//URLから投稿IDを取得

    $no_image = 'noimageに指定したい画像があればここにパス';//アイキャッチ画像がない場合の画像を指定

    //タイトルを取得
    if(empty($title)){
        $title = esc_html(get_the_title($id));
    }
    //抜粋文を取得
    if(empty($excerpt)){
        $excerpt = esc_html(ltl_get_the_excerpt($id));
    }

    //アイキャッチ画像を取得
    if(has_post_thumbnail($id)) {
        $img = wp_get_attachment_image_src(get_post_thumbnail_id($id),'medium');
        $img_tag = "<img src='" . $img[0] . "' alt='{$title}'/>";
    }else{
        $img_tag ='<img src="'.$no_image.'" alt="" />';
    }

    // **ここで $nlink を空の文字列として初期化**
    $nlink = '';

    $nlink .= '
        <div class="blog-card">
            <a href="'. esc_url($url) .'">
                <div class="blog-card-thumbnail">'. $img_tag .'</div>
                <div class="blog-card-content">
                    <div class="blog-card-title">'. esc_html($title) .' </div>
                    <div class="blog-card-excerpt">'. esc_html($excerpt) .'</div>
                </div>
                <div class="clear"></div>
            </a>
        </div>';

    return $nlink;
}
add_shortcode("nlink", "nlink_scode");


?>