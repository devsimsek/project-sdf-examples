<!-- Design by (C)devsimsek. Design taken from project sdl.-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $app_title ?? "Example News Application" ?> <?= $app_version ?? SDF_VERSION ?></title>
    <!-- Application stylesheet -->
    <link rel='stylesheet' href='/assets/css/app.css'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&amp;display=swap"
          rel="stylesheet">
</head>
<body class='wrapper'>
    <?php $load->view('inc/nav', get_defined_vars()['params']) ?>
    <main>
        <h2>Posts</h2>
        <ul class="list">
        <?php foreach ($posts as $date => $post): ?>
            <li>
                <i><?= date('D, d M Y', $date) ?></i><a href="/post/<?= $date ?>"><?= $post['title'] ?></a>
                <p>
                    <?= createDescription($post['body']) ?> 
                </p>
            </li>
        <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>
