<div class="comment_content_form">
    <form class="comment_form_post" id="form_comment<?= $picture->getPictureId(); ?>" method="POST">
        <textarea class="comment_form_print" name="comment" placeholder="Commentaires..." alt="commentaires"></textarea>
        <label for="pictureId<?= $picture->getPictureId(); ?>"></label>
        <input type="texte" value="<?= $picture->getPictureId(); ?>" id="pictureId<?= $picture->getPictureId(); ?>" class="hidden_input" name="pictureId" />
        <label for="userId<?= $_SESSION['id']; ?>"></label>
        <input type="texte" value="<?= $_SESSION['id']; ?>" id="userId<?= $picture->getPictureId(); ?>" class="hidden_input" name="userId" />
        <button type="submit" onclick="callAjax('form_comment<?= $picture->getPictureId(); ?>', 'Comment')" class="comment_button btn btn-primary">Envoyer</button>
    </form>
</div>