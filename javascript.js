function setCookie(name, value, days) {
    let expires = "";
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

function addTokeeps(postId) {
    let keeps = getCookie('keeps');
    keeps = keeps ? keeps.split(',') : [];
    if (!keeps.includes(postId.toString())) {
        keeps.push(postId);
        setCookie('keeps', keeps.join(','), 7); // 7日間保持
    }
}

function removeFromkeeps(postId) {
    let keeps = getCookie('keeps');
    if (keeps) {
        keeps = keeps.split(',');
        const index = keeps.indexOf(postId.toString());
        if (index !== -1) {
            keeps.splice(index, 1);
            setCookie('keeps', keeps.join(','), 7); // 7日間保持
        }
    }
}

function toggleFavorite(postId) {
    const keeps = getCookie('keeps');
    keeps = keeps ? keeps.split(',') : [];
    if (keeps.includes(postId.toString())) {
        removeFromkeeps(postId);
        // お気に入りから削除された時の処理
    } else {
        addTokeeps(postId);
        // お気に入りに追加された時の処理
    }
}

console.log("ちんこ");