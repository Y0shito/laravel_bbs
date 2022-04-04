'use strict';

const articleDelete = () => {
    if (window.confirm('本当に削除しますか？')) {
        document.articleDelete.submit();
    } else {
        return false;
    }
}
