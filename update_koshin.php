<?php
// WordPress環境をロード
require_once('../../../wp-load.php');
global $wpdb;

// フォームから送信されたデータを取得
if (isset($_POST['id']) && isset($_POST['post_id']) && isset($_POST['name']) && isset($_POST['link']) 
    && isset($_POST['img']) && isset($_POST['business'])
    && isset($_POST['salary']) && isset($_POST['area']) && isset($_POST['business_time'])
    && isset($_POST['holiday'])) {

    // データを取得・サニタイズ
    $id = intval($_POST['id']);  // 更新対象のID
    $post_id = intval($_POST['post_id']);
    $name = htmlspecialchars($_POST['name']);
    $link = htmlspecialchars($_POST['link']);
    $img = htmlspecialchars($_POST['img']);
    $business = htmlspecialchars($_POST['business']);
    $salary = htmlspecialchars($_POST['salary']);
    $area = htmlspecialchars($_POST['area']);
    $business_time = htmlspecialchars($_POST['business_time']);
    $holiday = htmlspecialchars($_POST['holiday']);

    // テーブル名
    $table_name = $wpdb->prefix . 'gongcha';

    // 既存データの確認
    $existing_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if ($existing_data) {
        // 既存データを更新
        $result = $wpdb->update(
            $table_name,
            array(
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
            array('id' => $id), // 更新条件
            array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'), // データ型
            array('%d') // 条件のデータ型
        );

        if ($result !== false) {
            echo "<p>情報が正しく更新されました！<a href='https://caba-island.com/'>トップページに戻る</a></p>";
        } else {
            $error_message = $wpdb->last_error;
            echo "<p>更新に失敗しました。エラー: $error_message <a href='https://caba-island.com/'>トップページに戻る</a></p>";
        }
    } else {
        echo "<p>指定されたIDのデータが見つかりません。<a href='https://caba-island.com/'>トップページに戻る</a></p>";
    }
} else {
    echo "<p>フォームデータが正しく送信されていません。</p>";
}
?>
