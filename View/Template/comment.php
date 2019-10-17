<div class="comment_content_form">
    <form class="comment_form_post" id="form_comment<?= $picture->getPictureId(); ?>" method="POST">
        <textarea class="comment_form_print" name="comment" placeholder="Commentaires..." alt="commentaires"></textarea>
        <input type="hidden" value="<?= $picture->getPictureId(); ?>" id="pictureId<?= $picture->getPictureId(); ?>" name="pictureId" />
        <input type="hidden" value="<?= $_SESSION['id']; ?>" id="userId<?= $picture->getPictureId(); ?>" name="userId" />
        <button type="submit" onclick="callAjax('form_comment<?= $picture->getPictureId(); ?>', 'Comment')" class="comment_button btn btn-primary" title="Envoyer commentaire">Envoyer</button>
    </form>
</div>