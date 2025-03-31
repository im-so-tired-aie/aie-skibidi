<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset("/css/create.css") }}" />
</head>
<body>
    <header>
        TrevWorld lol
    </header>

    <form method="POST" action="/store" class="container" enctype="multipart/form-data">
        @csrf

        <h1>Add New Package</h1>

        <h2>Markdown Editor</h2>
        <div class="flex-row main-content">
            <textarea name="content">
<!-- Front matter -->
**Title**:

**Highlights**:

**Departure Dates**:

**Duration**:

**Cost**:
<!-- End of front matter -->

            </textarea>

            <div class="left-bar">
                <div>
                    <h2>Cover Photo</h2>
                    <input name="cover" type="file" placeholder="Choose File" accept="image/*" required />
                </div>

                <div>
                    <h2>Image 1</h2>
                    <input name="img1" type="file" placeholder="Choose File" accept="image/*" />
                </div>

                <div>
                    <h2>Image 2</h2>
                    <input name="img2" type="file" placeholder="Choose File" accept="image/*" />
                </div>

                <div>
                    <h2>Image 3</h2>
                    <input name="img3" type="file" placeholder="Choose File" accept="image/*" />
                </div>

                <div>
                    <h2>Country</h2>
                    <select name="country">
                        <option value="singapore">Singapore</option>
                        <option value="malaysia">Malaysia</option>
                        <option value="thailand">Thailand</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex-row">
            <button type="submit">Create Package</button>
            <button>Cancel</button>
        </div>
    </form>
</body>
</html>
