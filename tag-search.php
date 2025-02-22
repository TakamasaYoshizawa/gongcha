<?php
/*
Template Name: Tag Search Results
*/

get_header(); // ヘッダーを読み込む（WordPressの標準テンプレートタグ）

global $wpdb;

// クエリパラメータからタグを取得
$tag = isset($_GET['tag']) ? sanitize_text_field($_GET['tag']) : '';

if ($tag) {
    // "私服勤務" タグがついた投稿を取得
    $args = array(
        'tag' => $tag,
        'post_type' => 'post',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<h3>タグ「' . esc_html($tag) . '」に該当する店舗</h3>';
        echo '<div class="container shop-one"><div class="row">';

        $count = 0;

        // 投稿をループして処理
        while ($query->have_posts()) {
            $query->the_post();
            $post_link = get_permalink();  // 投稿のリンクを取得

            // wp_gongchaテーブルから一致するリンクを持つデータを取得
            $gongcha_data = $wpdb->get_results($wpdb->prepare("
                SELECT * FROM wp_gongcha WHERE link = %s
            ", $post_link));

            // 一致するデータがあれば表示
            if ($gongcha_data) {
                foreach ($gongcha_data as $data) {
                    if ($count > 0 && $count % 2 == 0) {
                        echo '</div><div class="row">';
                    }

                    // 店舗情報を表示するHTML
                    echo <<<EOT
                        <div class="col-sm-6 d-flex">
                            <div class="shop-list-search">
                                <div class="shop-list-inner">
                                    <h3 class="shop-list-name" style="font-family: Arial, sans-serif !important;">{$data->name}<span class="shop-id" style="display:none;">({$data->id})</span></h3>
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
                                                <td>{$data->business}</td>
                                            </tr>
                                            <tr>
                                                <th>エリア</th>
                                                <td>{$data->area}</td>
                                            </tr>
                                            <tr>
                                                <th>平均時給</th>
                                                <td>{$data->salary}</td>
                                            </tr>
                                            <tr>
                                                <th>営業時間</th>
                                                <td>{$data->business_time}</td>
                                            </tr>
                                            <tr>
                                                <th>定休日</th>
                                                <td>{$data->holiday}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-6 keepbtn">
                                            <div class="keep_btn_a">
                                                <button class="favorite-button" data-shop-id="{$data->id}">▶︎キープする</button>
                                            </div>
                                        </div>
                                        <div class="col-6 detailbtn">
                                            <div class="detail_btn_a">
                                                <a href="{$data->link}">
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
            }
        }

        echo '</div></div>';
    } else {
        echo '<p>タグ「' . esc_html($tag) . '」に該当する店舗はありませんでした。</p>';
    }
} else {
    echo '<p>タグが指定されていません。</p>';
}

wp_reset_postdata(); // 投稿データのリセット

get_footer(); // フッターを読み込む（WordPressの標準テンプレートタグ）
?>

<script>
// ID番号の表示切り替え
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
