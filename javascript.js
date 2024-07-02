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
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function addToFavorites(shopId) {
    let favorites = getCookie('favorites');
    favorites = favorites ? favorites.split(',') : [];
    if (!favorites.includes(shopId.toString())) {
        favorites.push(shopId);
        setCookie('favorites', favorites.join(','), 7); // 7日間保持
    }
}

function removeFromFavorites(shopId) {
    let favorites = getCookie('favorites');
    if (favorites) {
        favorites = favorites.split(',');
        const index = favorites.indexOf(shopId.toString());
        if (index !== -1) {
            favorites.splice(index, 1);
            setCookie('favorites', favorites.join(','), 7); // 7日間保持
        }
    }
}

function toggleFavorite(shopId) {
    let favorites = getCookie('favorites');
    favorites = favorites ? favorites.split(',') : [];
    if (favorites.includes(shopId.toString())) {
        removeFromFavorites(shopId);
        document.querySelector(`[data-shop-id="${shopId}"] .favorite-button`).innerText = 'Add to Favorites';
    } else {
        addToFavorites(shopId);
        document.querySelector(`[data-shop-id="${shopId}"] .favorite-button`).innerText = 'Remove from Favorites';
    }
}

function initializeFavoriteButtons() {
    const buttons = document.querySelectorAll('.favorite-button');
    buttons.forEach(button => {
        const shopId = button.dataset.shopId;
        const favorites = getCookie('favorites');
        const favoritesArray = favorites ? favorites.split(',') : [];
        if (favoritesArray.includes(shopId)) {
            button.innerText = 'Remove from Favorites';
        } else {
            button.innerText = 'Add to Favorites';
        }
        button.addEventListener('click', () => toggleFavorite(shopId));
    });
}

document.addEventListener('DOMContentLoaded', initializeFavoriteButtons);

console.log("ぽりんちんぽ");
