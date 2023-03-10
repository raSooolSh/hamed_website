$(document).on("click", ".pagination a,.pagination button[type='submit']", function (e) {
    e.preventDefault();
     // show loading
     $("#pagination_data").html(`<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`)

    //get url and make final url for ajax
    let url;
    if ($(this).attr("href")) {
        url = $(this).attr("href");
    } else {
        url = window.location.href;
        if (url.indexOf('page') == -1) {
            url += url.indexOf('?') == -1 ? '?' : '&';
            url += 'page=';
        }
        url = url.replace(/page=\d*/g, "page=" + $(this).prev().val());
    }

    // add to history of browser
    window.history.pushState({}, null, url);

    // get data with ajax
    $.get(url, function (data) {
        $("#pagination_data").html(data);
    });
    return false;
});

$(document).on("click", "#search_form button[type='submit']", function (e) {
    e.preventDefault();

    // show loading
    $("#pagination_data").html(`<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`)

    //get url and make final url for ajax
    let url = window.location.origin + window.location.pathname + "?search=" +
        $("input[name='search']").val() ?? '';

    // add to history of browser
    window.history.pushState({}, null, url);

    // get data with ajax
    $.get(url, function (data) {
        $("#pagination_data").html(data);
    });
    return false;
});

window.addEventListener('popstate',function(){
    $("#pagination_data").html(`<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`);
    $.get(window.location.href, function (data) {
        $("#pagination_data").html(data);
    });
    return false;
});
