
/*$("#text").cleditor(); // CLE Editor WYSIWYG*/

$("#cancel").on('click', function () {
    location.reload();
});

var id_article = $('#id_article').attr('id_articles');

$("#save").on('click', function () {
    id_article = $('#id_article').attr('id_articles');
    var title_send = $('#title').val();

   /* var text_send = $("#text").val();*/
    var text_send = CKEDITOR.instances.text.getData();

   // var text_send2=(text_send.replace("/&mdash;/g", "-"));
    console.log(text_send);
    String.prototype.replaceArray = function(find, replace) {
        var replaceString = this;
        var regex;
        for (var i = 0; i < find.length; i++) {
            regex = new RegExp(find[i], "g");
            replaceString = replaceString.replace(regex, replace[i]);
        }
        return replaceString;
    };
    var find = ["&mdash;", "&#39;", "&quot;", "&pound;", "&nbsp;","&rsquo;","&ldquo;","&rdquo;","&ccedil;","&agrave;"];
    var replace = [" - ", "\'", "\"", "\£", " ", "\'", "\"", "\"", "ç", "à"];
    var text_send2 = text_send.replaceArray(find, replace);
    console.log(text_send2);


    var send_post = "title=" + title_send + "&text=" + text_send2 + "&id_article=" + id_article;
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