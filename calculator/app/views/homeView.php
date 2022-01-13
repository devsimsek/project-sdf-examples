<html>
<head><title><?= $app_title ?? 'Error. Page Title Not Found.' ?></title></head>
<body>

<h1>Welcome to <?= $app_title ?? 'My Calculator.' ?></h1>
<p>Use this page to calculate your problems :)</p>

<?php if (isset($result)): ?>
<span>Result: <?= $result ?></span>
<br>
<a href='/'>Homepage</a>
<?php endif; ?>

<form method='post' action='/calculate'>
<label>
Enter equation: 
<input type='text' name='equation'>
<button type='submit'>Calculate!</button>
</label>
</form>

<span style='color:grey;font-style:italic;'>Copyright (C)devsimsek. Powered by SDF.</span>

</body>
</html>
