<div id="content_upload_picture" class="content">
    <div id="container_upload_picture_form">
        <div id="upload_picture">
            <img id="thumbnil" src="" alt="" />
        </div>
        <form action="PictureController" method="POST" enctype="multipart/form-data" id="form_upload_picture">
            <label for="title_picture">Titre</label>
            <input type="text" name="title" id="title_picture" required />
            <label for="upload_picture">Ajouter une photo: </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
            <input type="file" id="upload_picture" name="upload_picture" onchange="showMyImage(this)" />
            <input type="submit" class="btn btn-primary" id="button_upload_picture" title="Ajouter photo" />
        </form>

    </div>
</div>
<script src="./js/displayPictures.js"></script>
