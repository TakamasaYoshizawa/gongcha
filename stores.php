<?php
global $wpdb;
$get_data = $wpdb->get_results('SELECT * FROM wp_gongcha ORDER BY id ASC');

// コンテナ開始
echo '<div class="container shop-one">';
echo '<div class="row">';

$count = 0;

foreach ($get_data as $data) {
    // 新しい行の開始
    if ($count > 0 && $count % 2 == 0) {
        echo '</div><div class="row">';
    };

    $post_id = intval($data->post_id);  // 投稿IDを整数として取得

    // デバッグ用: 投稿IDとタグの取得確認
    $tags = get_the_tags($post_id);
    if ($tags) {
        $tag_list = '<div class="m_tag_list"><ul>';
        foreach ($tags as $tag) {
            $tag_list .= '<li>' . esc_html($tag->name) . '</li>';  // タグ名をリストアイテムとして表示
        }
        $tag_list .= '</ul></div>';
    } else {
        $tag_list = '<div class="m_tag_list"><ul><li>タグはありません。</li></ul></div>';
    }

    print <<<EOT
        <div class="col-sm-6 d-flex">
            <div class="shop-list-search">
                <div class="shop-list-inner">
                        <h3 class="shop-list-name">$data->name <span class="shop-id" style="display:none;">($data->id)</span></h3>
                        <div class="shop-list-image">
                            <div class="row">
                                <div class="col-4">
                                    <img src="$data->img">
                                </div>
                                <div class="col-8">
                                    <p>$data->description</p>
                                </div>
                            </div>
                        </div>
                        <table class="s-l-t">
                            <tbody>
                                <tr>
                                    <th>業種</th>
                                    <td>$data->business</td>
                                </tr>
                                <tr>
                                    <th>時給</th>
                                    <td>$data->salary</td>
                                </tr>
                                <tr>
                                    <th>エリア</th>
                                    <td>$data->area</td>
                                </tr>
                                <tr>
                                    <th>アクセス</th>
                                    <td>$data->access</td>
                                </tr>
                                <tr>
                                    <th>勤務時間</th>
                                    <td>$data->op_time</td>
                                </tr>
                                <tr>
                                    <th>職種</th>
                                    <td>$data->occupation</td>
                                </tr>
                            </tbody>
                        </table>
                        $tag_list  <!-- ここでタグを表示 -->
                    <div class="row">
                        <div class="col-6 keepbtn">
                            <div class="keep_btn_a">
                                <button class="favorite-button" data-shop-id="$data->id"></button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="keep_btn_a">
                                <a href="$data->link">
                                    ▶︎詳しく見る
                                    <picture>
                                        <source type="">
                                        <img src="">
                                    </picture>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    EOT;
    $count++;
}

// 最後の行を閉じる
echo '</div>';
echo '</div>';

// フッターにボタンを追加
echo '<footer>';
echo '<button id="toggle-ids">ID番号を表示する</button>';
echo '</footer>';
?>

<script>
// JavaScriptでボタンのクリックイベントを処理
document.getElementById('toggle-ids').addEventListener('click', function() {
    const ids = document.querySelectorAll('.shop-id');
    ids.forEach(id => {
        if (id.style.display === 'none') {
            id.style.display = 'inline';
        } else {
            id.style.display = 'none';
        }
    });
});
</script>
