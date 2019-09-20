

var displayContentComment = function(id) {
    element = document.querySelector('.post' + id);
    if (element.classList.contains('active')) {
        element.classList.remove('active');
    } else {
        element.classList.add('active');
    };
};

var callAjax = function(element, script) {

    document.getElementById(element).addEventListener('submit', function(e) {
        e.preventDefault();
        var xhr = new XMLHttpRequest();
        var data = new FormData(this);
        xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
console.log(this.response);
            if (this.response.sucess) {
                if (script === 'Like') {
                    like(this.response.data);
                } else if (script === 'Comment') {
                    comment(this.response.data);
                    document.getElementById(element).reset();
                } else if (script === 'Report') {
                    report(this.response.data);
                }
            } else {
                alert(this.response.msg);
            }
        } else if (this.readyState == 4 && this.status == 404) {
            alert('une erreur est survenue ...');
        };
        e.stopImmediatePropagation();
    };

    xhr.open("POST", '../Async/' + script + '.php', true);
    xhr.responseType = "json";
    xhr.send(data);

    return false;
    });
};

var comment = function(data) {
    var comment = data;

    var container = document.getElementById('container_comment' + comment.pictureId);

    container.innerHTML += '<div class="comment_picture_post">\
                                <figure class="comment_user">\
                                    <img src="../Public/img/upload/avatar/avatar' + comment.userId + '.jpg" alt="avatar" class="picture_comment" />\
                                    <p>' + comment.userName + '</p>\
                                </figure>\
                                <div class="comment_content">\
                                    <div class="arrow-left"></div>\
                                    <p>Le ' + comment.published + '</p>\
                                    <p id="comment_post' + comment.commentId + '">' + comment.comment + '</p>\
                                </div>\
                            </div>';
};

var like = function(data) {
    var like = data;
    var contentLike = document.querySelector('#content_like' +  like.elementId);
    contentLike.innerHTML = like.likeNumber + ' personnes aiment cette photo.';
};

var report = function(data) {
    var report = data;
    var contentReport = document.querySelector('#content_report' +  report.post.elementIdReport);
    if (report.reportsNumber != 0) {
        contentReport.innerHTML = report.reportsNumber + ' personnes ont signalées cette photo.';
    } else {
        contentReport.innerHTML = "";
    }


};