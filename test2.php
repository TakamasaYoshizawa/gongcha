<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店舗名で探す</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        h3 {
            text-align: center;
            font-weight: 100;
        }

        .input-container {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 2px solid #000;
            padding: 0 10px 0 0;
            position: relative;
            height: 45px;
            width: 100%;
            margin: 4px auto;
        }

        .input-container span {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ffdaf2;
            border-radius: 5px;
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

        .search-button-container {
            width: 60%;
            margin: 5% auto;
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

    </style>
</head>
<body>
<div class="container">
    <h3>店舗名で探す</h3>
    <form id="search-form" action="店舗検索" method="get">
        <div class="input-container">
            <span><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" name="shop" id="search-input" placeholder="店舗名で探す（カタカナ）">
        </div>
        <div class="search-button-container">
            <button type="submit" class="search-button montserrat">検索する</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('search-form').addEventListener('submit', function(event) {
        var searchInput = document.getElementById('search-input').value.trim();
        if (!searchInput) {
            event.preventDefault();
            alert('店舗名を入力してください。');
        }
    });
</script>
</body>
</html>
