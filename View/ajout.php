<div class="container" id="content_upload_picture">
    <div class="row" id="container_upload_picture_form">
        <div class="col-lg-5">
            <form action="PictureController" method="POST" enctype="multipart/form-data" id="form_upload_picture">
                <label for="title_picture">Titre</label>
                <input type="text" name="title" id="title_picture" required />
                <label for="upload_picture">Ajouter une photo: </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                <input type="file" id="upload_picture" name="upload_picture" onchange="showMyImage(this)" />
                <input type="submit" class="btn btn-primary" id="button_upload_picture" />
            </form>
        </div>
        <div class="col-lg-7" id="upload_picture">
            <img id="thumbnil" src="" alt="image" />
        </div>
    </div>
</div>
<script type="application/javascript" src="./js/callPictures.js"></script>
