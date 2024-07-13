document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.favorite-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const postId = this.dataset.shopId;
            const button = this;
            const action = button.innerText.includes('削除') ? 'remove_favorite' : 'add_favorite';

            console.log('Post ID:', postId);
            console.log('Action:', action);

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: action,
                    post_id: postId
                })
            })
            .then(response => {
                if (!response.ok) {
                    console.error('Response not ok:', response);
                    throw new Error('ネットワークの問題で操作が失敗しました。');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    if (action === 'remove_favorite') {
                        button.closest('.col-sm-6.d-flex').remove();
                    } else {
                        alert('お気に入りに追加されました。');
                        button.innerText = 'お気に入りから削除';
                    }
                } else {
                    console.error('Data error:', data);
                    alert('操作が失敗しました。: ' + data.data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('AJAXリクエストが失敗しました。');
            });
        });
    });
});
