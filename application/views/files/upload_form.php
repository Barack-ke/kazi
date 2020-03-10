<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <h3>Select an image to upload it  the cloud</h3>
        <?php
                if (isset($error)){
                    echo $error;
                }
            ?>
            <form method="post" action="<?=base_url('ImageUploadController/store')?>" enctype="multipart/form-data">
                <input type="file"  name="profile_image" size="33" />
                <input type="submit" value="Upload Image" />
            </form>
    </div>
</body>
</html>