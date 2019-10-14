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
                if (this.response.sucess) {
                    messageFlash(this.response.message);
                    if (script === 'pictureLike' || script === 'commentLike') {
                        like(this.response.data);
                    } else if (script === 'Comment') {
                        comment(this.response.data);
                        document.getElementById(element).reset();
                    } else if (script === 'pictureReport' || script === 'commentReport') {
                        report(this.response.data);
                    } else if (script === 'Profil') {
                        profil(this.response);
                    } else if (script === 'Admin') {
                        admin(this.response.data);
                    }
                } else {
                    messageFlash(this.response.message);
                }
            } else if (this.readyState == 4 && this.status == 404) {
                messageFlash('Une erreur est survenue ...');
            };
            e.stopImmediatePropagation();
        };

        xhr.open("POST", '' + script + '', true);
        xhr.responseType = "json";
        xhr.send(data);

        return false;
    });
};

var profil = function(data) {
    var picture = data;
    var containerPicture = document.getElementById('container_picture_profil' + picture.postClean.pictureId);
    containerPicture.style.display = "none";
};

var admin = function(data) {
    var report = data;
    if (report.post.element === 'comment') {
        var containerReport = document.getElementById('report_comment_admin' + report.post.comment_report_id);
        containerReport.style.display = "none";
    } else if (report.post.element === 'picture') {
        var containerReport = document.getElementById('picture_admin' +  report.post.report_id_admin);
        containerReport.style.display = "none";
    } else if (report.post.element === 'user') {
        var containerUser = document.getElementById('container_user_info' + report.post.user_id_admin);
        containerUser.style.display = "none";
    }
};

var comment = function(data) {
    var comment = data;
    var container = document.getElementById('container_comment' + comment.pictureId);
    container.innerHTML += '<div class="comment_picture_post">\
                                <figure class="comment_user">\
                                    <img src="' + comment.userAvatar + '" alt="avatar" class="picture_comment" />\
                                    <p>' + comment.userName + '</p>\
                                </figure>\
                                <div class="comment_content">\
                                    <div class="arrow-left"></div>\
                                    <p>Le ' + comment.published + '</p>\
                                    <p id="comment_post' + comment.commentId + '">' + comment.comment + '</p>\
                                    <div class="content_form_like_report_comment">\
                                        <form method="POST" id="like_form_comment' + comment.commentId + '">\
                                            <label for="elementComment' + comment.commentId + '"></label>\
                                            <input type="text" name="element" id="elementComment' + comment.commentId + '" value="comment" class="hidden_input" />\
                                            <label for="elementIdComment' + comment.commentId + '"></label>\
                                            <input type="text" name="elementId" id="elementIdComment' + comment.commentId + '" value="' + comment.commentId + '" class="hidden_input" />\
                                            <label for="userIdComment' + comment.commentId + '"></label>\
                                            <input type="text" name="userId" id="userIdComment' + comment.commentId + '" value="' + comment.userId + '" class="hidden_input" />\
                                            <button type="submit" class="button_icone" onclick="callAjax(\'like_form_comment' + comment.commentId +'\', \'commentLike\')"><span id="icone_like' + comment.commentId + '" class="far fa-thumbs-up icone_like"></span></button>\
                                        </form>\
                                        <p id="like_comment_content' + comment.commentId + '"></p>\
                                        <form method="POST" id="report_form_comment' + comment.commentId + '">\
                                            <label for="elementReportComment' + comment.commentId + '"></label>\
                                            <input type="text" name="elementReport" id="elementReportComment' + comment.commentId + '" value="comment" class="hidden_input" />\
                                            <label for="elementIdReportComment' + comment.commentId + '"></label>\
                                            <input type="text" name="elementIdReport" id="elementIdReportComment' + comment.commentId + '" value="' + comment.commentId + '" class="hidden_input" />\
                                            <label for="userIdReportComment' + comment.commentId + '"></label>\
                                            <input type="text" name="userIdReport" id="userIdReportComment' + comment.commentId + '" value="' + comment.userId + '" class="hidden_input" />\
                                            <button type="submit" class="button_icone" onclick="callAjax(\'report_form_comment' + comment.commentId + '\', \'commentReport\')"><span id="icone_report' + comment.commentId + '" class="far fa-flag icone_report"></span></button>\
                                        </form>\
                                        <p id="report_comment_content' + comment.commentId + '"></p>\
                                    </div>\
                                </div>\
                            </div>';
};

var like = function(data) {
    var like = data;
    var likeElement = like.element;
    if (likeElement == 'picture') {
        var contentLike = document.querySelector('#content_like' +  like.elementId);
        contentLike.innerHTML = like.likeNumber + ' personnes aiment cette photo.';
    } else if (likeElement == 'comment') {
        var contentLike = document.querySelector('#like_comment_content' + like.elementId);
        contentLike.innerHTML = like.likeNumber;
    }
    if (like.likeNumber != 0) {
        document.getElementById('icone_like' + like.elementId).classList.add('active');
    } else {
        document.getElementById('icone_like' + like.elementId).classList.remove('active');
    }
};

var report = function(data) {
    var report = data;
    if (report.post.elementReport == 'picture') {
        var contentReport = document.querySelector('#content_report' +  report.post.elementIdReport);
        if (report.reportsNumber != 0) {
            contentReport.innerHTML = report.reportsNumber + ' personnes ont signalées cette photo.';
        } else {
            contentReport.innerHTML = "";
        }
    } else if (report.post.elementReport == 'comment') {
        var contentReport = document.querySelector('#report_comment_content' + report.post.elementIdReport);
        if (report.reportsNumber != 0) {
            contentReport.innerHTML = report.reportsNumber;
        } else {
            contentReport.innerHTML = "";
        }
    }
    if (report.reportsNumber != 0) {
        document.getElementById('icone_report' + report.post.elementIdReport).classList.add('active');
    } else {
        document.getElementById('icone_report' + report.post.elementIdReport).classList.remove('active');
    }
};

var timer;
var messageFlash = function(message) {
    var container = document.getElementById('container_message_flash');
    clearInterval(timer);
    container.style.display ="block";
    container.innerHTML = "";
    container.innerHTML += message;
    timer = setInterval(() => {
        container.style.display ="none";
    }, 5000);
};