<!-- Design by (C)devsimsek. Design taken from project sdl.-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $app_title ?? "Example News Application" ?> <?= $app_version ?? SDF_VERSION ?> - Edit Post</title>
    <!-- Application stylesheet -->
    <link rel='stylesheet' href='/assets/css/app.css'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&amp;display=swap"
          rel="stylesheet">
</head>
<body class='wrapper'>
    <?php $load->view('inc/nav', get_defined_vars()['params']) ?>
    <main>
        <form method="post" action="/submit_post">
            <input hidden name='edit'>
            <input hidden name='id' value='<?= $post['id'] ?>'>
            <label>
                <span>Title</span>
                <input type="text" name="title" placeholder="Post Title" value='<?= $post['title'] ?>'>
            </label>

            <label>
                <span>Author</span>
                <input type="text" name="author" placeholder="Post Author" value='<?= $post['author'] ?>'>
            </label>

            <label>
                <span>Post Body</span>
                <textarea name="body" cols="30" rows="10"><?= $post['body'] ?></textarea>
            </label>

            <input type="submit" value="Submit">
        </form>
    </main>
</body>
</html>

