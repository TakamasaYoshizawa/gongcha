<?php
// これはコメントです！
$json_file_path = './stores.json';
$stores_json = file_get_contents($json_file_path);

// if ($stores_json === false) {
//     die('Error: Unable to read the JSON file.');
// }

$stores = json_decode($stores_json, true);

// if ($stores === null && json_last_error() !== JSON_ERROR_NONE) {
//     die('Error: JSON decoding failed. ' . json_last_error_msg());
// }

if (is_array($stores)){
for($i = 0; $i < count($stores); $i++){
    print<<<EOT

     <div class="col-sm-6">
            <div class="shop-list-search">
                <div class="shop-list-inner">
                    <a href="">
                        <h3 class="shop-list-name">{$stores[$i]["name"]}</h3>
                        <div class="shop-list-image">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="{$stores[$i]["thmunail_url"]}">
                                </div>
                                <div class="col-xs-8">
                                    <p>{$stores[$i]["description"]}</p>
                                    "とっても素晴らしい銀座のお店！"
                                </div>
                            </div>
                        </div>
                        <table class="s-l-t">
                            <tbody>
                                <tr>
                                    <th>業種</th>
                                    <td>キャバクラ</td>
                                </tr>
                                <tr>
                                    <th>時給</th>
                                    <td>時給8,000円〜12,000円</td>
                                </tr>
                                <tr>
                                    <th>エリア</th>
                                    <td>銀座</td>
                                </tr>
                                <tr>
                                    <th>アクセス</th>
                                    <td>銀座線「新橋駅」５番出口徒歩5分</td>
                                </tr>
                                <tr>
                                    <th>勤務時間</th>
                                    <td>20:00〜1:00</td>
                                </tr>
                                <tr>
                                    <th>職種</th>
                                    <td>日払いOKのフロアレディー</td>
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
}
}




// foreach($stores as $store){
//     print<<<EOT
//         <div class="col-sm-6">
//             <div class="shop-list-search">
//                 <div class="shop-list-inner">
//                     <a href="">
//                         <h3 class="shop-list-name">{$store["name"]}</h3>
//                         <div class="shop-list-image">
//                             <div class="row">
//                                 <div class="col-xs-4">
//                                     <img src="{$store["thmunail_url"]}">
//                                 </div>
//                                 <div class="col-xs-8">
//                                     <p>{$store["description"]}</p>
//                                     "とっても素晴らしい銀座のお店！"
//                                 </div>
//                             </div>
//                         </div>
//                         <table class="s-l-t">
//                             <tbody>
//                                 <tr>
//                                     <th>業種</th>
//                                     <td>キャバクラ</td>
//                                 </tr>
//                                 <tr>
//                                     <th>時給</th>
//                                     <td>時給8,000円〜12,000円</td>
//                                 </tr>
//                                 <tr>
//                                     <th>エリア</th>
//                                     <td>銀座</td>
//                                 </tr>
//                                 <tr>
//                                     <th>アクセス</th>
//                                     <td>銀座線「新橋駅」５番出口徒歩5分</td>
//                                 </tr>
//                                 <tr>
//                                     <th>勤務時間</th>
//                                     <td>20:00〜1:00</td>
//                                 </tr>
//                                 <tr>
//                                     <th>職種</th>
//                                     <td>日払いOKのフロアレディー</td>
//                                 </tr>
//                             </tbody>
//                         </table>
//                         <h4 class="t_list">メリット</h4>
//                         <div class="m_tag_list">
//                             <ul>
//                                 <li>未経験者大歓迎</li>
//                                 <li>終電上がり</li>
//                                 <li>送り有り</li>
//                                 <li>土曜も営業</li>
//                             </ul>
//                         </div>
//                     </a>
//                     <div class="row">
//                         <div class="col-xs-6 keepbtn">
//                             <div class="keep_btn_a">
//                                 <a href="">
//                                     <!-- キープの星の画像の箇所 -->
//                                     <img src="">
//                                     ▶︎キープする
//                                 </a>
//                             </div>
//                         </div>
//                         <div class="col-xs-6">
//                             <div class="keep_btn_a">
//                                 <a href="">
//                                     ▶︎詳しく見る
//                                     <picture>
//                                         <source type="">
//                                         <img src="">
//                                     </picture>
//                                 </a>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         </div>

//     EOT;

// }



