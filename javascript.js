function setCookie(name, value, days) {
    let expires = "";
    const date = new Date();
    if (days) {
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
    console.log("Cookie set: " + name + "=" + value + "; expires=" + date.toUTCString() + "; path=/");
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
    console.log("Added to favorites: " + shopId);
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
    console.log("Removed from favorites: " + shopId);
}

function toggleFavorite(shopId) {
    let favorites = getCookie('favorites');
    favorites = favorites ? favorites.split(',') : [];
    const button = document.querySelector(`[data-shop-id="${shopId}"]`);
    
    if (favorites.includes(shopId.toString())) {
        removeFromFavorites(shopId);
        button.textContent = '▶︎キープする';
        button.classList.remove('hello');
    } else {
        addToFavorites(shopId);
        button.textContent = '▶︎キープを外す';
        button.classList.add('hello');
    }

    // ページがキープページの場合は、要素を削除
    const isKeepPage = window.location.pathname.includes("keep-page"); // キープページのURLに適宜変更
    if (isKeepPage && button.textContent === '▶︎キープする') {
        button.closest('.col-sm-6').remove();
    }
}

function initializeFavoriteButtons() {
    const buttons = document.querySelectorAll('.favorite-button');
    buttons.forEach(button => {
        const shopId = button.dataset.shopId;
        const favorites = getCookie('favorites');
        const favoritesArray = favorites ? favorites.split(',') : [];
        
        if (favoritesArray.includes(shopId)) {
            button.textContent = '▶︎キープを外す';
            button.classList.add('hello');
        } else {
            button.textContent = '▶︎キープする';
        }

        button.addEventListener('click', (event) => {
            event.preventDefault(); // デフォルトの動作を防ぐ（リロードを防ぐ）
            toggleFavorite(shopId);
        });
    });

    // Remove favorite buttons on the favorites list page
    const removeButtons = document.querySelectorAll('.remove-favorite-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // デフォルトの動作を防ぐ（リロードを防ぐ）
            const shopId = this.getAttribute('data-shop-id');
            removeFromFavorites(shopId);
            this.parentElement.remove();
        });
    });
}

document.addEventListener('DOMContentLoaded', initializeFavoriteButtons);
