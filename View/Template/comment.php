<div class="comment_content_form">
    <form class="comment_form_post" id="form_comment<?= $picture->getId(); ?>" method="POST">
        <textarea class="comment_form_print" name="comment" placeholder="Commentaires..." alt="commentaires"></textarea>
        <label for="pictureId<?= $picture->getId(); ?>"></label>
        <input type="texte" value="<?= $picture->getId(); ?>" id="pictureId<?= $picture->getId(); ?>" class="hidden_input" name="pictureId" />
        <label for="userId<?= $_SESSION['id']; ?>"></label>
        <input type="texte" value="<?= $_SESSION['id']; ?>" id="userId<?= $picture->getId(); ?>" class="hidden_input" name="userId" />
        <button type="submit" onclick="callAjax('form_comment<?= $picture->getId(); ?>', 'Comment')" class="comment_button btn btn-primary">Envoyer</button>
    </form>
</div>