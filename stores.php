<?php
global $wpdb;
// $_COOKIE;
// echo "Start fetching data"; // ここで実行確認
$get_data = $wpdb->get_results('SELECT * FROM wp_gongcha ORDER BY id ASC');

// echo "Fetched data count: " . count($get_data); // 取得データの数を表示

// コンテナ開始
echo '<div class="container shop-one" data-shop-id="<?php echo $post->ID; ?>">';
echo '<div class="row">';

$count = 0;

foreach ($get_data as $data) {
    // 新しい行の開始
    if ($count > 0 && $count % 2 == 0) {
        echo '</div><div class="row">';
    }

    // echo "Processing data: " . $data->name; // 各データの処理開始を表示

    print <<<EOT
        <div class="col-sm-6 d-flex">
            <div class="shop-list-search">
                <div class="shop-list-inner">
                    <a href="$data->link">
                        <h3 class="shop-list-name">$data->name</h3>
                        <div class="shop-list-image">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="$data->img">
                                </div>
                                <div class="col-xs-8">
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
                        <h4 class="t_list">メリット</h4>
                        <div class="m_tag_list">
                            <ul>
                                <li>未経験者大歓迎</li>
                                <li>終電上がり</li>
                                <li>送り有り</li>
                                <li>土曜も営業</li>
                            </ul>
                        </div>
                    </a>
                    <div class="row">
                        <div class="col-xs-6 keepbtn">
                            <div class="keep_btn_a">
                                <a href="">
                                    <!-- キープの星の画像の箇所 -->
                                    <img src="">
                                    <button class="favorite-button" data-shop-id="$data->id">Add to Favorites</button>
                                    ▶︎キープする
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="keep_btn_a">
                                <a href="">
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
?>
