// height of container field
var height = +window.screen.availHeight;
height3 = height - Math.ceil(height * 0.30);
$("#container").height(+height3);

// delete article
$('.delete').on('click', function () {
    if(confirm("Delete article ?")) {
    var delete_id = $(this).attr("id");
    var row_delete = '#row-' + delete_id;
    $(row_delete).css('display', 'none');

    var send_post = "delete=delete&id_article=" + delete_id;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "change_article.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(send_post);

    xhr.onreadystatechange = function () {
        if (this.statusText === "OK" && this.status === 200 && this.readyState === 4) {
            $('#delete-success').text(" Deleted successfully.");
            return true;
        } else {
            $('#delete-success').text(" Couldn't delete.");
        }
    }
}
});

