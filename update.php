<?php
// PHPのエラーログ
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// WordPress環境をロードする
require_once('../../../wp-load.php');

// グローバル変数 $wpdb を使用してデータベースに接続
global $wpdb;

// フォームから送信されたデータを取得
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id1']) && isset($_POST['id2'])) {
        $id1 = intval($_POST['id1']);
        $id2 = intval($_POST['id2']);

        if ($id1 === $id2) {
            echo "IDが同じです。異なるIDを指定してください。";
            exit;
        }

        try {
            $table_name = $wpdb->prefix . 'gongcha';
            $temp_id = -1;  // 一時的に使用するID

            $wpdb->query('START TRANSACTION');

            // ID1のレコードのIDを一時的なIDに変更
            $wpdb->update($table_name, array('id' => $temp_id), array('id' => $id1), array('%d'), array('%d'));

            // ID2のレコードのIDをID1のIDに変更
            $wpdb->update($table_name, array('id' => $id1), array('id' => $id2), array('%d'), array('%d'));

            // 一時的なIDをID2のIDに変更
            $wpdb->update($table_name, array('id' => $id2), array('id' => $temp_id), array('%d'), array('%d'));

            // トランザクションをコミット
            $wpdb->query('COMMIT');

            echo "ID $id1 と ID $id2 の交換が成功しました！";

        } catch (Exception $e) {
            $wpdb->query('ROLLBACK');
            echo "IDの交換に失敗しました: " . $e->getMessage();
        }
    } else {
        echo "Error: Form data not set.";
    }
} else {
    echo "Error: Form data not set.";
}
?>
