function setCookie(name, value, days) {
    const expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (const i = 0; i < ca.length; i++) {
        const c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function addToFavorites(postId) {
    const favorites = getCookie('favorites');
    favorites = favorites ? favorites.split(',') : [];
    if (!favorites.includes(postId.toString())) {
        favorites.push(postId);
        setCookie('favorites', favorites.join(','), 7); // 7日間保持
    }
}

function removeFromFavorites(postId) {
    const favorites = getCookie('favorites');
    if (favorites) {
        favorites = favorites.split(',');
        const index = favorites.indexOf(postId.toString());
        if (index !== -1) {
            favorites.splice(index, 1);
            setCookie('favorites', favorites.join(','), 7); // 7日間保持
        }
    }
}

function toggleFavorite(postId) {
    const favorites = getCookie('favorites');
    favorites = favorites ? favorites.split(',') : [];
    if (favorites.includes(postId.toString())) {
        removeFromFavorites(postId);
        // お気に入りから削除された時の処理
    } else {
        addToFavorites(postId);
        // お気に入りに追加された時の処理
    }
}

console.log("ちんこ");