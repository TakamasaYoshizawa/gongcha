<?php
// PHPのエラーログ
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// WordPress環境をロードする
require_once('../../../wp-load.php');

// デバッグ用: 実行確認メッセージ
// echo "PHP script is running.";

// グローバル変数 $wpdb を使用してデータベースに接続
global $wpdb;

// フォームから送信されたデータを取得
if (isset($_POST['name']) && isset($_POST['business']) && isset($_POST['id'])) {
    $name = htmlspecialchars($_POST['name']);
    $business = htmlspecialchars($_POST['business']);
    $id = htmlspecialchars($_POST['id']);
    
    // デバッグ用: フォームデータ確認
    echo "次の情報を登録しました。<br/>Name: $name <br/>Business: $business <br/>ID: $id";

    // SQLクエリの準備と実行
    $table_name = $wpdb->prefix . 'gongcha'; // テーブル名はプレフィックスを含めて指定
    $result = $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'business' => $business,
            'id' => $id,
        ),
        array(
            '%s', // name は文字列
            '%s', // business は文字列
            '%s', // id は文字列
        )
    );

    // 結果のチェック
    if ($result !== false) {
        echo "<br/>正しく情報が追加されました！";
    } else {
        echo "<br/>情報の登録に失敗しました。";
    }
} else {
    echo "Error: Form data not set.";
}
?>
