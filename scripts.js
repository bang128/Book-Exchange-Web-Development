function go(page) {
    window.location.href=page;
}

function sort(books, desc) {
    books.sort(function(a,b){return a[1].localeCompare(b[1]);});
    if (desc) {return books.reverse;}
    return books;
}