<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エリアの選択フォーム</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container-modal {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .container-modal h3 {
            text-align: center;
            font-weight: 100;
        }
        
        .input-container {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            border: 2px solid #000;
            border-radius: 5px;
            padding: 0 10px 0 0;
            position: relative;
            height: 45px;
            width: 75%;
            margin: 4px auto;
        }

        .input-container span {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ffdaf2;
            border-radius: 4px;
            font-size: 1.2rem;
            width: 20%;
            height: 100%;
            padding: 5px;
            color: #f300a1;
        }

        .input-container input {
            border: none;
            padding: 10px;
            margin: 0px !important;
            width: 100%;
            height: 100%;
        }

        .input-container input:focus {
            outline: none;
        }

        .search-button {
            display: block;
            width: 100%;
            background-color: #f300a1;
            border-radius: 5px;
            color: #fff;
            border: none;
            padding: 5px;
            font-size: 0.9rem;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #ffdaf2;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            height: 100%;
            overflow-y: auto;
            position: relative; /* または absolute, fixed, sticky */
            z-index: 9999; /* 高い値を指定 */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .accordion {
            text-align: center;
        }

        .accordion-header {
            font-family: 'Arial', sans-serif;
            font-size: 1.5rem;
            border: 2px solid #cdcdcd !important;
            margin-top: 0px !important;
            margin-bottom: 5px !important;
            border-radius: 4px;
            background-color: #fff;
            color: #000;
            cursor: pointer;
        }
        
        .accordion-content {
            display: none;
            max-height: 0; /* 初期状態では閉じる */
            overflow: hidden;
            transition: max-height 0.3s ease-out; /* スムーズに開閉する */
        }

        .accordion-content ul {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        .accordion-content ul li {
            padding: 8px; /* パディングを少し減らす */
            width: calc(50% - 16px); /* 2列にするための幅調整 */
            margin: 4px 8px; /* 縦の隙間を少し減らす */
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 4px;
            text-align: center;
            list-style-type: none;
            border: 2px solid #cdcdcd;
        }

        .accordion-header.open + .accordion-content {
            display: block;
        }
    </style>
</head>
<body>

<?php
$unique_id = uniqid('modal_');
?>

<div class="container-modal">
    <h3>エリアで探す</h3>
    <form id="area-form" action="エリア検索" method="get">
        <div class="input-container" data-modal-id="<?php echo $unique_id; ?>">
            <span><i class="fa-solid fa-location-dot"></i></span>
            <input type="text" name="area-display" id="area-input" placeholder="エリアを選択" readonly>
        </div>
        <div class="search-button-container">
            <button type="submit" class="search-button">検索する</button>
        </div>
        <input type="hidden" name="area" id="hidden-area-input">
    </form>
</div>

<!-- モーダル -->
<div id="<?php echo $unique_id; ?>" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <!-- アコーディオンメニュー -->
        <div class="accordion">
            <h4 class="accordion-header">【東京】</h4>
            <div class="accordion-content">
                <h4 class="accordion-header">中央区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>銀座</li>
                    </ul>
                </div>

                <h4 class="accordion-header">千代田区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>秋葉原</li>
                        <li>神田</li>
                    </ul>
                </div>

                <h4 class="accordion-header">港区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>六本木</li>
                        <li>新橋</li>
                        <li>西麻布</li>
                        <li>赤坂</li>
                        <li>麻布十番</li>
                        <li>青山</li>
                        <li>広尾</li>
                    </ul>
                </div>

                <h4 class="accordion-header">新宿区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>歌舞伎町</li>
                        <li>西新宿</li>
                        <li>神楽坂</li>
                        <li>高田馬場</li>
                    </ul>
                </div>

                <h4 class="accordion-header">渋谷区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>渋谷</li>
                        <li>恵比寿</li>
                        <li>幡ヶ谷・西永福</li>
                        <li>下北沢</li>
                    </ul>
                </div>

                <h4 class="accordion-header">豊島区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>池袋</li>
                    </ul>
                </div>

                <h4 class="accordion-header">台東区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>上野</li>
                    </ul>
                </div>

                <h4 class="accordion-header">荒川区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>日暮里・西日暮里</li>
                    </ul>
                </div>

                <h4 class="accordion-header">墨田区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>錦糸町・門前仲町</li>
                    </ul>
                </div>

                <h4 class="accordion-header">江東区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>錦糸町・門前仲町</li>
                    </ul>
                </div>

                <h4 class="accordion-header">目黒区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>目黒</li>
                        <li>中目黒</li>
                    </ul>
                </div>

                <h4 class="accordion-header">世田谷区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>三軒茶屋</li>
                        <li>経堂・千歳烏山</li>
                        <li>祖師ヶ谷大蔵</li>
                    </ul>
                </div>

                <h4 class="accordion-header">練馬区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>練馬・成増・大山</li>
                    </ul>
                </div>

                <h4 class="accordion-header">北区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>巣鴨・赤羽</li>
                    </ul>
                </div>

                <h4 class="accordion-header">板橋区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>練馬・成増・大山</li>
                    </ul>
                </div>

                <h4 class="accordion-header">大田区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>蒲田・大森</li>
                    </ul>
                </div>

                <h4 class="accordion-header">品川区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>五反田</li>
                    </ul>
                </div>

                <h4 class="accordion-header">中野区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>中野・高円寺</li>
                    </ul>
                </div>

                <h4 class="accordion-header">杉並区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>荻窪</li>
                        <li>幡ヶ谷・西永福</li>
                    </ul>
                </div>

                <h4 class="accordion-header">足立区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>綾瀬</li>
                    </ul>
                </div>

                <h4 class="accordion-header">江戸川区</h4>
                <div class="accordion-content">
                    <ul>
                        <li>小岩・新小岩</li>
                    </ul>
                </div>

                <h4 class="accordion-header">23区外</h4>
                <div class="accordion-content">
                    <ul>
                        <li>町田</li>
                        <li>八王子</li>
                        <li>吉祥寺・三鷹</li>
                        <li>立川</li>
                        <li>調布</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="accordion">
            <h4 class="accordion-header">【埼玉】</h4>
                <div class="accordion-content">
                    <ul>
                        <li>大宮</li>
                        <li>川口・蕨</li>
                        <li>浦和・南浦和・北浦和</li>
                        <li>越谷</li>
                        <li>志木</li>
                    </ul>
                </div>
        </div>

        <div class="accordion">
            <h4 class="accordion-header">【千葉】</h4>
                <div class="accordion-content">
                    <ul>
                        <li>船橋</li>
                        <li>松戸・柏</li>
                        <li>西船橋・津田沼</li>
                        <li>千葉</li>
                        <li>市川</li>
                        <li>南行徳</li>
                        <li>木更津・君津</li>
                    </ul>
                </div>
        </div>

        <div class="accordion">
            <h4 class="accordion-header">【神奈川】</h4>
                <div class="accordion-content">
                    <ul>
                        <li>横浜</li>
                        <li>関内</li>
                        <li>川崎</li>
                        <li>新横浜</li>
                        <li>藤沢</li>
                        <li>相模原</li>
                        <li>溝の口</li>
                        <li>橋本</li>
                        <li>本厚木</li>
                    </ul>
                </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    console.log("JSが読み込まれました");

    // `.input-container` と `#area-input` のクリックでモーダルを開く
    document.querySelectorAll(".input-container, #area-input").forEach(function (inputContainer) {
        inputContainer.addEventListener("click", function () {
            let container = this.closest(".input-container");
            let modalId = container.getAttribute("data-modal-id");
            let modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = "block";
            } else {
                console.error("モーダルが見つからない: " + modalId);
            }
        });
    });

    // モーダルを閉じる処理
    document.querySelectorAll(".modal .close").forEach(function (closeBtn) {
        closeBtn.addEventListener("click", function () {
            this.closest(".modal").style.display = "none";
        });
    });

    window.addEventListener("click", function (event) {
        document.querySelectorAll(".modal").forEach(function (modal) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });

    // **アコーディオンの開閉処理**
    document.querySelectorAll(".accordion-header").forEach(function (header) {
        header.addEventListener("click", function () {
            let content = this.nextElementSibling;

            // `.accordion-content` でない場合は次の要素を探す
            while (content && !content.classList.contains("accordion-content")) {
                content = content.nextElementSibling;
            }

            if (!content) {
                console.error("アコーディオンのコンテンツが見つからない:", this);
                return;
            }

            let isOpen = this.classList.contains("open");

            if (isOpen) {
                // **閉じる処理**
                content.style.maxHeight = content.scrollHeight + "px"; // 高さを一度固定
                setTimeout(() => {
                    content.style.maxHeight = "0";
                }, 10);
                this.classList.remove("open");

                content.addEventListener("transitionend", function handleTransitionEnd() {
                    if (!content.style.maxHeight || content.style.maxHeight === "0px") {
                        content.style.display = "none";
                    }
                    content.removeEventListener("transitionend", handleTransitionEnd);
                });

            } else {
                // **開く処理**
                content.style.display = "block"; // すぐ表示
                content.style.maxHeight = "0"; // 一度リセット
                setTimeout(() => {
                    content.style.maxHeight = content.scrollHeight + "px"; // スムーズに開く
                }, 10);
                this.classList.add("open");
            }
        });
    });
});


</script>
</body>
</html>
