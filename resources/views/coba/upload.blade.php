<!DOCTYPE html>
<html>
    <head>
        <title>Tutorial Upload dan Resize Image</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
    <form method="POST" action="{{url('/upload')}}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="gambar" />
            <input type="submit" name="upload_image" value="Upload" />
        </form>
    </body>
</html>