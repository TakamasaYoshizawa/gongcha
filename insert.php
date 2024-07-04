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
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['link']) 
    && isset($_POST['img']) && isset($_POST['description']) && isset($_POST['business'])
    && isset($_POST['salary']) && isset($_POST['area']) && isset($_POST['access'])
    && isset($_POST['op_time']) && isset($_POST['occupation'])) {

    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $link = htmlspecialchars($_POST['link']);
    $img = htmlspecialchars($_POST['img']);
    $description = htmlspecialchars($_POST['description']);
    $business = htmlspecialchars($_POST['business']);
    $salary = htmlspecialchars($_POST['salary']);
    $area = htmlspecialchars($_POST['area']);
    $access = htmlspecialchars($_POST['access']);
    $op_time = htmlspecialchars($_POST['op_time']);
    $occupation = htmlspecialchars($_POST['occupation']);
    
    // デバッグ用: フォームデータ確認
    echo "次の情報を登録しました。<br/>店舗ID:$id <br/>店舗名:$name <br/>
         リンク:$link <br/> 店舗画像:$img <br/>店舗説明:$description<br/>
         業種:$business<br/>時給:$salary<br/>エリア:$area<br/>アクセス:$access<br/>
         営業時間:$op_time<br/>職種:$occupation<br/>";

    // SQLクエリの準備と実行
    $table_name = $wpdb->prefix . 'gongcha'; // テーブル名はプレフィックスを含めて指定
    $result = $wpdb->insert(
        $table_name,
        array(
            'id' => $id,
            'name' => $name,
            'link' => $link,
            'img' => $img,
            'description' => $description,
            'business' => $business,
            'salary' => $salary,
            'area' => $area,
            'access' => $access,
            'op_time' => $op_time,
            'occupation' =>$occupation,
        ),
        array(
            '%s', // 各項目の区切り
            '%s', 
            '%s', 
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            
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
