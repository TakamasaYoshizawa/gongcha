<?php
/*
Template Name: Store Search Results2
*/

get_header(); // ヘッダーを読み込む（WordPressの標準テンプレートタグ）
?>
<?php
global $wpdb;


// クエリパラメーターを取得
$search_term = isset($_GET['shop']) ? $_GET['shop'] : '';

?>

<h3><?php echo esc_html($search_term); ?>に該当する店舗</h3>
<?php
// 検索条件を満たすかどうかをチェック
if ($search_term) {
    // クエリの準備
    $query = "SELECT * FROM wp_gongcha WHERE 1=1";

    // 店舗名での検索条件を追加
    if ($search_term) {
        $query .= $wpdb->prepare(" AND name LIKE %s", '%' . $wpdb->esc_like($search_term) . '%');
    }

    // クエリ実行
    $query .= " ORDER BY id ASC";
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

            // 店舗情報の表示処理
            $post_id = intval($data->post_id);

            // タグを取得して表示する処理
            $tags = get_the_tags($post_id);
            $tag_list = '<div class="m_tag_list"><ul>';
            if ($tags && !is_wp_error($tags)) {
                foreach ($tags as $tag) {
                    $tag_list .= '<li>' . esc_html($tag->name) . '</li>';
                }
            } else {
                $tag_list .= '<li>タグはありません。</li>';
            }
            $tag_list .= '</ul></div>';

            echo <<<EOT
                <div class="col-sm-6 d-flex">
                    <div class="shop-list-search">
                        <div class="shop-list-inner">
                            <h3 class="shop-list-name" style="font-family: Arial, sans-serif !important;">$data->name<span class="shop-id" style="display:none;">({$data->id})</span></h3>
                            <div class="shop-list-image">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{$data->img}" alt="{$data->name}">
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
    echo '<p>検索条件を入力してください！</p>';
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
