<?php
global $wpdb;

// クエリパラメーターを取得
$business = isset($_GET['business']) ? $_GET['business'] : '';

// クエリの準備（業種が指定されている場合、その業種に絞り込む）
$query = "SELECT * FROM wp_gongcha WHERE 1=1";

if ($business) {
    $query .= $wpdb->prepare(" AND business = %s", $business);
}

$query .= " ORDER BY id ASC";

// データベースクエリの実行
$get_data = $wpdb->get_results($query);
?>

<!-- ボタンの下にデータを表示 -->
<div class="container shop-one">
    <div class="row">
        <?php
        $count = 0;

        foreach ($get_data as $data) {
            // 新しい行の開始
            if ($count > 0 && $count % 2 == 0) {
                echo '</div><div class="row">';
            }

            $post_id = intval($data->post_id);  // 投稿IDを整数として取得

            // タグの取得と表示
            $tags = get_the_tags($post_id);
            $tag_list = '<div class="m_tag_list"><ul>';
            if ($tags) {
                foreach ($tags as $tag) {
                    $tag_list .= '<li>' . esc_html($tag->name) . '</li>';
                }
            } else {
                $tag_list .= '<li>タグはありません。</li>';
            }
            $tag_list .= '</ul></div>';

            print <<<EOT
            <div class="col-sm-6 d-flex">
                <div class="shop-list-search">
                    <div class="shop-list-inner">
                        <h3 class="shop-list-name" style="font-family: Arial, sans-serif !important;">$data->name<span class="shop-id" style="display:none;">($data->id)</span></h3>
                        <div class="shop-list-image">
                            <div class="row">
                                <div class="col-5">
                                    <img src="$data->img">
                                </div>
                                <div class="col-7 shop-detail">
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
                                    <th>エリア</th>
                                    <td>$data->area</td>
                                </tr>
                                <tr>
                                    <th>平均時給</th>
                                    <td>$data->salary</td>
                                </tr>
                                <tr>
                                    <th>営業時間</th>
                                    <td>$data->business_time</td>
                                </tr>
                                <tr>
                                    <th>定休日</th>
                                    <td>$data->holiday</td>
                                </tr>
                            </tbody>
                        </table>
                        $tag_list
                        <div class="row">
                            <div class="col-6 keepbtn">
                                <div class="keep_btn_a">
                                    <button class="favorite-button" data-shop-id="$data->id">▶︎キープする</button>
                                </div>
                            </div>
                            <div class="col-6 detailbtn">
                                <div class="detail_btn_a">
                                    <a href="$data->link">
                                        ▶︎詳しく見る
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
        ?>
    </div>
</div>
