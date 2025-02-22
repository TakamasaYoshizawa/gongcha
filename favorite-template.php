<!-- <div class="col-sm-6 d-flex">
    <div class="shop-list-search">
        <div class="shop-list-inner">
            <a href="<?php echo esc_url($data->link); ?>">
                <h3 class="shop-list-name"><?php echo esc_html($data->name); ?></h3>
                <div class="shop-list-image">
                    <div class="row">
                        <div class="col-xs-4">
                            <img src="<?php echo esc_url($data->img); ?>">
                        </div>
                        <div class="col-xs-8">
                            <p><?php echo esc_html($data->description); ?></p>
                        </div>
                    </div>
                </div>
                <table class="s-l-t">
                    <tbody>
                        <tr>
                            <th>業種</th>
                            <td><?php echo esc_html($data->business); ?></td>
                        </tr>
                        <tr>
                            <th>時給</th>
                            <td><?php echo esc_html($data->salary); ?></td>
                        </tr>
                        <tr>
                            <th>エリア</th>
                            <td><?php echo esc_html($data->area); ?></td>
                        </tr>
                        <tr>
                            <th>アクセス</th>
                            <td><?php echo esc_html($data->access); ?></td>
                        </tr>
                        <tr>
                            <th>勤務時間</th>
                            <td><?php echo esc_html($data->op_time); ?></td>
                        </tr>
                        <tr>
                            <th>職種</th>
                            <td><?php echo esc_html($data->occupation); ?></td>
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
                        <button class="favorite-button" data-shop-id="<?php echo esc_attr($data->id); ?>">お気に入りから削除</button>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="keep_btn_a">
                        <a href="<?php echo esc_url($data->link); ?>">
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
</div> -->

<!-- 追加 -->
<div class="col-sm-6 d-flex">
                <div class="shop-list-search">
                    <div class="shop-list-inner">
                        <h3 class="shop-list-name" style="font-family: Arial, sans-serif !important;"><?php echo esc_html($data->name); ?><span class="shop-id" style="display:none;">($data->id)</span></h3>
                        <div class="shop-list-image">
                            <div class="row">
                                <div class="col-5">
                                    <img src="<?php echo esc_url($data->img); ?>">
                                </div>
                                <div class="col-7 shop-detail">
                                    <p><?php echo esc_html($data->description); ?></p>
                                </div>
                            </div>
                        </div>
                        <table class="s-l-t">
                            <tbody>
                                <tr>
                                    <th>業種</th>
                                    <td><?php echo esc_html($data->business); ?></td>
                                </tr>
                                <tr>
                                    <th>エリア</th>
                                    <td><?php echo esc_html($data->area); ?></td>
                                </tr>
                                <tr>
                                    <th>平均時給</th>
                                    <td><?php echo esc_html($data->salary); ?></th>
                                </tr>
                                <tr>
                                    <th>営業時間</th>
                                    <td><?php echo esc_html($data->business_time); ?></td>
                                </tr>
                                <tr>
                                    <th>定休日</th>
                                    <td><?php echo esc_html($data->holiday); ?></td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <!-- タグのリストを追加 -->
            <?php
            $post_id = intval($data->post_id);  // 投稿IDを整数として取得

            $tags = get_the_tags($post_id);
            if ($tags) {
                echo '<div class="m_tag_list"><ul>';
                foreach ($tags as $tag) {
                    echo '<li>' . esc_html($tag->name) . '</li>';  // タグ名をリストアイテムとして表示
                }
                echo '</ul></div>';
            } else {
                echo '<div class="m_tag_list"><ul><li>タグはありません。</li></ul></div>';
            }
            ?>
                        <div class="row">
                            <div class="col-6 keepbtn">
                            <div class="keep_btn_a">
                                <button class="favorite-button" data-shop-id="<?php echo esc_attr($data->id); ?>">お気に入りから削除</button>
                            </div>
                        </div>
                        <div class="col-6 detailbtn">
                            <div class="detail_btn_a">
                                <a href="<?php echo esc_url($data->link); ?>">
                                    ▶︎詳しく見る
                                </a>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>

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