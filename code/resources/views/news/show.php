<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="max-width: 1100px; margin: 0px auto;">
    <header style="display: flex; justify-content: space-between; margin: 16px auto 52px; border-radius: 10px; box-shadow: 0px 0px 20px gray; padding: 6px 26px;">
        <a href="/">
            <h4 style="border: 1px solid gray; border-radius: 10px; padding: 26px; min-width: max-content; width: 150px; text-align:center">Home</h4>
        </a>
        <a href="<?= route('news.index', ['id' => $news['category_id']]) ?>">
            <h4 style="border: 1px solid gray; border-radius: 10px; padding: 26px; min-width: max-content; width: 150px; text-align:center">News</h4>
        </a>
        <a href="<?= route('info.show') ?>">
            <h4 style="border: 1px solid gray; border-radius: 10px; padding: 26px; min-width: max-content; width: 150px; text-align:center">Info</h4>
        </a>
    </header>
    <h2 style="border: 1px solid gray; border-radius: 10px; padding: 26px; width: max-content;">Category of news: <?= $news['category'] ?></h2>
    <div style="border: 1px solid green; border-radius: 10px; padding: 26px; max-width: 800px;">
        <h2><?= $news['title'] ?></h2>
        <p><?= $news['author'] ?> - <?= $news['created_at']->format('d-m-Y H:i') ?></p>
        <p><?= $news['description'] ?></p>

    </div>
</body>

</html>