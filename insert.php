<?php
// PHPのエラーログ

// WordPress環境をロードする
require_once('../../../wp-load.php');

// グローバル変数 $wpdb を使用してデータベースに接続
global $wpdb;

// フォームから送信されたデータを取得
if (isset($_POST['id']) && isset($_POST['post_id']) && isset($_POST['name']) && isset($_POST['link']) 
    && isset($_POST['img']) && isset($_POST['business'])
    && isset($_POST['salary']) && isset($_POST['area']) && isset($_POST['business_time'])
    && isset($_POST['holiday'])) {

    $id = htmlspecialchars($_POST['id']);
    $post_id = intval($_POST['post_id']);  // 投稿IDを整数として取得
    $name = htmlspecialchars($_POST['name']);
    $link = htmlspecialchars($_POST['link']);
    $img = htmlspecialchars($_POST['img']);
    $business = htmlspecialchars($_POST['business']);
    $salary = htmlspecialchars($_POST['salary']);
    $area = htmlspecialchars($_POST['area']);
    $business_time = htmlspecialchars($_POST['business_time']);
    $holiday = htmlspecialchars($_POST['holiday']);

    // デバッグ用: フォームデータ確認
    echo "次の情報を登録しました。<br/>既存ID:$id<br/>投稿ID:$post_id <br/>店舗名:$name <br/>
         リンク:$link <br/> 店舗画像:$img <br/>
         業種:$business<br/>時給:$salary<br/>エリア:$area<br/>営業時間:$business_time<br/>
         定休日:$holiday";

    // SQLクエリの準備と実行
    // SQLクエリの準備と実行
$table_name = $wpdb->prefix . 'gongcha'; // テーブル名はプレフィックスを含めて指定
$result = $wpdb->insert(
    $table_name,
    array(
        'id' => $id,
        'post_id' => $post_id,
        'name' => $name,
        'link' => $link,
        'img' => $img,
        'business' => $business,
        'salary' => $salary,
        'area' => $area,
        'business_time' => $business_time,
        'holiday' => $holiday,
    ),
    array(
        '%d',
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s'
    )
);


if ($result !== false) {
    echo "<br/>正しく情報が追加されました！<a href='https://caba-island.com/登録-削除-更新'>ページに戻る</a>";

    // タグの取得と表示をここに移動
    $tags = get_the_tags($post_id); // 投稿IDからタグを取得
    if ($tags) {
        echo '<h4 class="t_list">タグ</h4>';
        echo '<div class="m_tag_list">';
        echo '<ul>';
        foreach ($tags as $tag) {
            echo '<li>' . esc_html($tag->name) . '</li>'; // タグ名をリストアイテムとして表示
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p>タグはありません。</p>';
    }
} else {
    // エラーメッセージを表示
    $error_message = $wpdb->last_error;
    echo "<br/>情報の登録に失敗しました。エラー: $error_message <a href='https://caba-island.com/登録-削除-更新'>ページに戻る</a>";
}
    
    
} else {
    echo "Error: Form data not set.";
}
?>
