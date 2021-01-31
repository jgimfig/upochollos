function postReply(commentId) {
    $('#commentId').val(commentId);
    $("#name").focus();
}

function listComment() {
    $.post("comment-list.php", function (data) {
        //console.log(data);
        data = JSON.parse(data);
        var comments = "";
        var replies = "";
        var item = "";
        var parent = -1;
        var results = new Array();

        var list = $("<ul class='outer-comment'>");
        var item = $("<li>").html(comments);

        for (var elemnt in data) {
            var element = data[elemnt];
            var commentId = element.id;
            parent = element.id_comentario_padre;
            if (parent == "0") {
                comments = "<div class='comment-row'>" +
                        "<div class='comment-info'><span class='commet-row-label'>De</span> <span class='posted-by'>" + element.usuario + " </span> <span class='commet-row-label'>el </span> <span class='posted-at'>" + element.fecha + "</span></div>" +
                        "<div class='comment-text'>" + element.texto + "</div>" +
//                        "<div><a class='btn-reply' onClick='postReply(" + element.id + ")'>Reply</a></div>" +
                        "</div>";
                var item = $("<li>").html(comments);
                list.append(item);
                var reply_list = $('<ul>');
                item.append(reply_list);
                listReplies(commentId, data, reply_list);
            }

            $("#output").html(list);
        }
    });
}

function listReplies(commentId, data, list) {
    for (var elemnt in data) {
        var element = data[elemnt];
        if (commentId == element.id_comentario_padre){
            var comments = "<div class='comment-row'>" +
                    " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + element.usuario + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + element.fecha + "</span></div>" +
                    "<div class='comment-text'>" + element.texto + "</div>" +
                    "<div><a class='btn-reply' onClick='postReply(" + element.id + ")'>Reply</a></div>" +
                    "</div>";
            var item = $("<li>").html(comments);
            var reply_list = $('<ul>');
            list.append(item);
            item.append(reply_list);
            listReplies(element.comment_id, data, reply_list);
        }
    }
}