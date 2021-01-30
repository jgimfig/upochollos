function postReply(commentId) {
    $('#commentId').val(commentId);
    $("#name").focus();
}

function listComment() {
    $.post("comment-list.php",
            function (data) {
                var data = JSON.parse(data);
                var comments = "";
                var replies = "";
                var item = "";
                var parent = -1;
                var results = new Array();

                var list = $("<ul class='outer-comment'>");
                var item = $("<li>").html(comments);

                for (var i = 0; (i < data.length); i++)
                {
                    var commentId = data[i]['id'];
                    parent = data[i]['id_comentario_padre'];

                    if (parent == "0")
                    {
                        comments = "<div class='comment-row'>" +
                                "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['usuario'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['fecha'] + "</span></div>" +
                                "<div class='comment-text'>" + data[i]['texto'] + "</div>" +
                                "<div><a class='btn-reply' onClick='postReply(" + id + ")'>Reply</a></div>" +
                                "</div>";

                        var item = $("<li>").html(comments);
                        list.append(item);
                        var reply_list = $('<ul>');
                        item.append(reply_list);
                        listReplies(commentId, data, reply_list);
                    }
                }
                $("#output").html(list);
            });
}

function listReplies(commentId, data, list) {
    for (var i = 0; (i < data.length); i++)
    {
        if (commentId == data[i].id_comentario_padre)
        {
            var comments = "<div class='comment-row'>" +
                    " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['usuario'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['fecha'] + "</span></div>" +
                    "<div class='comment-text'>" + data[i]['texto'] + "</div>" +
                    "<div><a class='btn-reply' onClick='postReply(" + data[i]['id'] + ")'>Reply</a></div>" +
                    "</div>";
            var item = $("<li>").html(comments);
            var reply_list = $('<ul>');
            list.append(item);
            item.append(reply_list);
            listReplies(data[i].comment_id, data, reply_list);
        }
    }
}