<?php
/*
Template Name: Store Search Results
*/

get_header();
ini_set('display_errors', 1);
error_reporting(E_ALL);

global $wpdb;

// SQLクエリの作成
$query = "SELECT * FROM {$wpdb->prefix}gongcha WHERE 1=1";
$get_data = $wpdb->get_results($query);
var_dump($get_data);

if ($get_data) {
    foreach ($get_data as $data) {
        echo $data->name;
    }
} else {
    echo 'データが見つかりませんでした。';
}

$search_term = isset($_GET['shop']) ? $_GET['shop'] : '';

// デバッグ用のチェック
echo 'ここまで表示されているか確認！'; // ここが表示されるか確認

// ここから出力が問題ないか確認
echo <<<EOT
<div class="sample-content">
    <h1>データの表示テスト</h1>
    <p>この内容が表示されない場合、何らかの出力エラーが考えられます。</p>
</div>
EOT;

get_footer();
?>
