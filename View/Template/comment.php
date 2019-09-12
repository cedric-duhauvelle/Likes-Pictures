<div class="comment_content_form">
    <form action="CommentController" method="POST" class="comment_form_post">
        <textarea class="comment_form_print" name="comment" placeholder="Commentaires..." alt="commentaires" required></textarea>
        <label for="PictureId<?= $picture->getId(); ?>"></label>
        <input type="texte" value="<?= $picture->getId(); ?>" id="pictureId<?= $picture->getId(); ?>" class="hidden_input" name="pictureId" />
        <input type="submit"class="comment_button btn btn-primary" name="button_comment" id="button_comment<?= $picture->getId(); ?>" value="Envoyer" />
    </form>
</div>