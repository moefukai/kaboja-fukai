document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.menu-item').forEach(function(item) {
        item.addEventListener('click', function() {
            const noticeMenuId = this.getAttribute('data-notice-menu-id');
            window.location.href = `/order/detail/${noticeMenuId}`;
        });
    });
});
