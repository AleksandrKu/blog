
$("#text").cleditor(); // CLE Editor WYSIWYG

$("#cancel").on('click', function () {
    location.reload();
});

var id_article = $('#id_article').attr('id_articles');

$("#save").on('click', function () {
    id_article = $('#id_article').attr('id_articles');
    var title_send = $('#title').val();
    var text_send = $("#text").val();
    var send_post = "title=" + title_send + "&text=" + text_send + "&id_article=" + id_article;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "change_article.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(send_post);

    xhr.onreadystatechange = function () {
        if (this.statusText === "OK" && this.status === 200 && this.readyState === 4) {
            $('#success').text(" Saved successfully.");
            return true;
        } else {
            $('#success').text(" Didn't save.");
        }
    };
});