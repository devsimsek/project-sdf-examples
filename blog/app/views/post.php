<?php if ($id == '0000000000'): ?>
    <meta http-equiv="refresh" content="0;URL='/'"/>
<?php endif; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title><?= $app_title ?? "Example News Application" ?> <?= $app_version ?? SDF_VERSION ?>
        - <?= $post['title'] ?></title>
    <!-- Application stylesheet -->
    <link href='/assets/css/app.css' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&amp;display=swap"
          rel="stylesheet">
</head>
<body class="wrapper" id="application-wrapper">
    <?php $load->view('inc/nav', get_defined_vars()['params']) ?>
    <main class="post">
        <div class="post-information">
            <h1 class="post-title"><?= $post['title'] ?></h1>
            <span class="post-date"><?= date('D, d M Y', $id) ?> - <a href='/edit_post/<?= $id ?>'>Edit Post</a></span>
        </div>
        <br>
        <?= $post['body'] ?>
        <br>
        <i>- <?= $post['author'] ?></i>
    </main>
</body>
</html>
