<div class="container" id="content_upload_picture">
    <div class="row">
        <div class="col-lg-5">
            <form action="PictureController" method="POST" enctype="multipart/form-data" id="form_upload_picture">
                <label for="title_picture">Titre</label>
                <input type="text" name="title" id="title_picture" />
                <label for="upload_picture">Ajouter une photo: </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /> 
                <input type="file" id="upload_picture" name="upload_picture" onchange="showMyImage(this)" />
                <input type="submit" />
            </form> 
        </div>
        <div class="col-lg-7" id="upload_picture">
            <img id="thumbnil" src="" alt="image" />
        </div>
    </div>   
</div>
<script src="../Public/js/callPictures.js"></script>
