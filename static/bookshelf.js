function ajax(opts) {
    let method = opts.method || 'GET',
        url = opts.url || '',
        getData = opts.getData || {},
        postData = opts.postData || {},
        success = opts.success || function () { },
        error = opts.error || function () { };

    let getDataString = Object.keys(getData).map((name) => name + '=' + getData[name]).join('&');
    let postDataString = Object.keys(postData).map((name) => name + '=' + postData[name]).join('&');

    method = method.toUpperCase();
    url = getDataString ? url + '?' + getDataString : url;

    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);

    if (method === 'POST') {
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }

    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                success.call(xhr, xhr.responseText);
            } else {
                error.call(xhr);
            }
        }
    }, false);

    xhr.send(method == 'POST' ? postDataString : null);
    return xhr;
}

window.addEventListener('load', function () {
    ajax({
        method: 'POST',
        url: 'api.php?book-count',
        success: function (res) {
            loadBooks(res);
        }
    });
});

function loadBooks(count) {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let page = Number(url.searchParams.get('page'));
    page = page ? page : 1;
    const items = 5;
    const offset = (page-1)*items;
    ajax({
        method: 'POST',
        url: 'api.php?book-list&page=' + page,
        success: function (res) {
            res = JSON.parse(res);
            let table = document.getElementById('book-table').getElementsByTagName('tbody')[0];
            table.innerHTML = '';
            for(let i = 0; i < res.length; ++i) {
                let row   = table.insertRow();
                let cell0  = row.insertCell().innerHTML = res[i].author;
                let cell1  = row.insertCell().innerHTML = res[i].title;
                let cell2  = row.insertCell().innerHTML = res[i].category;
                let cell3  = row.insertCell().innerHTML = res[i].has_read ? 'Yes' : 'No';
                let cell4  = row.insertCell().innerHTML = '<a class="btn btn-secondary btn-sm" href="index.php?edit-book&id='+res[i].id+'" role="button">Edit</a>';
                let cell5  = row.insertCell().innerHTML = '<form action="index.php?remove-book" method="post"><input id="book" name="book" type="hidden" value="'+res[i].id+'" /><button type="submit" class="btn btn-secondary btn-sm">Remove</button></form>';
            }
        }
    });
    let ul = document.getElementById('pagination');
    ul.innerHTML = '';
    if(count > items && offset - items >= 0) {
        let li = document.createElement('li');
        li.className += ' page-item';
        let a = document.createElement('a');
        let text = document.createTextNode('<< Previous');
        a.appendChild(text);
        a.href = '#';
        a.className += ' page-link';
        a.addEventListener('click', previous);
        li.appendChild(a);
        ul.appendChild(li);
    }
    if(count > items && offset + items < count) {
        let li = document.createElement('li');
        li.className += ' page-item';
        let a = document.createElement('a');
        let text = document.createTextNode('Next >>');
        a.appendChild(text);
        a.href = '#';
        a.className += ' page-link';
        a.addEventListener('click', next);
        li.appendChild(a);
        ul.appendChild(li);
    }
}

function next() {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let page = Number(url.searchParams.get('page'));
    page = page ? page : 1;
    history.replaceState(null, null, 'index.php?list-books&page=' + (page+1));
    ajax({
        method: 'POST',
        url: 'api.php?book-count',
        success: function (res) {
            loadBooks(res);
        }
    });
}

function previous() {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let page = Number(url.searchParams.get('page'));
    page = page ? page : 1;
    history.replaceState(null, null, 'index.php?list-books&page=' + (page-1));
    ajax({
        method: 'POST',
        url: 'api.php?book-count',
        success: function (res) {
            loadBooks(res);
        }
    });
}