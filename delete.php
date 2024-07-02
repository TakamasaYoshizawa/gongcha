<?php
// PHPエラーログの表示を有効にする
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// WordPress環境をロードする
$path = realpath(dirname(__FILE__) . '/../../../wp-load.php');
if ($path) {
    require_once($path);
} else {
    die('Error: wp-load.php not found.');
}

// デバッグ用: 実行確認メッセージ
// echo "PHP script is running.<br>";

// グローバル変数 $wpdb を使用してデータベースに接続
global $wpdb;

// フォームから送信されたデータを取得
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // IDを整数に変換して取得
    
    // デバッグ用: フォームデータ確認
    echo "ID: $id<br>";

    // SQLクエリの準備と実行
    $table_name = $wpdb->prefix . 'gongcha'; // テーブル名はプレフィックスを含めて指定
    $result = $wpdb->delete(
        $table_name,
        array('id' => $id),
        array('%d') // id は整数
    );

    // 結果のチェック
    if ($result !== false) {
        echo "正しくデータが削除されました！";
    } else {
        echo "情報が削除されませんでした。" . $wpdb->last_error;
    }
} else {
    echo "Error: Form data not set.";
}
?>
