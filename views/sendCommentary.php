<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="main">
    <h1>Commentaires :</h1>

    <div id="contend">

    </div>
    <form action="../controllers/backend.php" method="post">
        <label for="title"></label>
        <input type="text" name="title" id="title" placeholder="Entrez le titre de votre article !">

        <label for="contend"></label>
        <input type="text" name="contend" id="contend" placeholder="Entrez le contenu de votre article !">

        <input type="hidden" name="page" value="sendCommentary">
        <input type="submit" id="submit">
    </form>
    <?php getArticles();?>
</div>
</body>
</html>
