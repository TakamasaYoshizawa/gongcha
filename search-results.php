<?php
/*
Template Name: Store Search Results
*/

get_header(); // ヘッダーを読み込む（WordPressの標準テンプレートタグ）
?>
<?php
global $wpdb;

// クエリパラメーターを取得
$area = isset($_GET['area']) ? $_GET['area'] : '';
$business = isset($_GET['business']) ? $_GET['business'] : '';

// 業種ごとの件数を取得
$counts = array();
if ($area) {
    // キャバクラの件数を部分一致で取得（キャバクラ（ガールズラウンジ）も含む）
    $counts['キャバクラ'] = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM wp_gongcha WHERE area = %s AND (business = %s OR business LIKE %s)", $area, 'キャバクラ', 'キャバクラ（%'
    ));
    // キャバクラの件数を部分一致で取得（キャバクラ（ガールズラウンジ）も含む）
    $counts['クラブ'] = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM wp_gongcha WHERE area = %s AND (business = %s OR business LIKE %s)", $area, 'クラブ', 'クラブ（%'
    ));

    // ラウンジの件数を完全一致で取得（ラウンジに完全一致するもののみ）
    $counts['ラウンジ'] = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM wp_gongcha WHERE area = %s AND business = %s", $area, 'ラウンジ'
    ));

    // ガールズバーの件数を完全一致で取得
    $counts['ガールズバー'] = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM wp_gongcha WHERE area = %s AND business = %s", $area, 'ガールズバー'
    ));
}
?>

<!-- エリア内に登録されているデータの総数を見出しとして表示 -->
<h3><?php echo esc_html($area); ?>に登録されている店舗数: <?php echo array_sum($counts); ?>件</h3>

<!-- 業種ごとのボタンを作成し、該当件数を表示 -->
<div class="business-buttons">
    <a href="?business=ラウンジ<?php echo $area ? '&area=' . urlencode($area) : ''; ?>">
        <button>ラウンジ (<?php echo isset($counts['ラウンジ']) ? $counts['ラウンジ'] : 0; ?>)</button>
    </a>
    <a href="?business=クラブ<?php echo $area ? '&area=' . urlencode($area) : ''; ?>">
        <button>クラブ (<?php echo isset($counts['クラブ']) ? $counts['クラブ'] : 0; ?>)</button>
    </a>
    <a href="?business=キャバクラ<?php echo $area ? '&area=' . urlencode($area) : ''; ?>">
        <button>キャバクラ (<?php echo isset($counts['キャバクラ']) ? $counts['キャバクラ'] : 0; ?>)</button>
    </a>
    <a href="?business=ガールズバー<?php echo $area ? '&area=' . urlencode($area) : ''; ?>">
        <button>ガールズバー (<?php echo isset($counts['ガールズバー']) ? $counts['ガールズバー'] : 0; ?>)</button>
    </a>
</div>

<?php
// 検索条件を満たすかどうかをチェック
if ($area) {
    // クエリの準備
    $query = "SELECT * FROM wp_gongcha WHERE area = %s";

    // 業種が選択されていない場合はすべてのデータを表示
    if ($business == '') {
        $query = $wpdb->prepare($query, $area);
    } else {
        // 業種の条件を追加（キャバクラや複合業種を部分一致で検索）
        if ($business == 'キャバクラ') {
            $query = $wpdb->prepare($query . " AND (business = %s OR business LIKE %s)", $area, 'キャバクラ', 'キャバクラ（%');
        } else {
            // ラウンジやガールズバーは完全一致で検索
            $query = $wpdb->prepare($query . " AND business = %s", $area, $business);
        }
    }

    // クエリ実行
    $get_data = $wpdb->get_results($query);

    // 結果があれば表示、なければメッセージを表示
    if ($get_data) {
        echo '<div class="container shop-one">';
        echo '<div class="row">';

        $count = 0;

        foreach ($get_data as $data) {
            if ($count > 0 && $count % 2 == 0) {
                echo '</div><div class="row">';
            }

            $post_id = intval($data->post_id);

            // タグを取得して表示する処理
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
                                    <div class="col-12">
                                        <img src="$data->img">
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

        echo '</div>'; // .rowの閉じタグ
        echo '</div>'; // .containerの閉じタグ

        echo '<footer>';
        echo '<button id="toggle-ids">ID番号を表示する</button>';
        echo '</footer>';
    } else {
        echo '<p>一致する結果が見つかりませんでした。</p>';
    }
} else {
    echo '<p>検索条件を入力してくださいね！</p>';
}

get_footer(); // フッターを読み込む（WordPressの標準テンプレートタグ）
?>
<script>
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
