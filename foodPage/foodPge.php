
<?php
require '../frontPages/includes/db.php';
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->Role === 'User') {

        echo '<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css">
    <title>RESTORANT restorant</title>
</head>

<body>

<a class=\'btn logOut btn-warning\' href=\'../frontPages/frontPage.php\'>Log Out</a>
    <h1 class=\'logo text-center\'><i class="fas fa-utensils"></i> IM@N RESTO <i class="fas fa-utensils"></i></h1>
    </div>
    <div class=\'container site\'>
        <div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">';
        $db = database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $row = $statement->fetchAll();
        foreach ($row as $category) {
            //var_dump($category);
            if ($category['id'] == '1') {
                echo '<li class="nav-item" role="presentation">
<button class="nav-link active" id="' . $category['name'] . '-tab" data-bs-toggle="tab" data-bs-target="#' . $category['name'] . '" type="button" role="tab" aria-controls="' . $category['name'] . '" aria-selected="true">' . $category['name'] . '</button></li>';
            } else {
                echo '<li class="nav-item" role="presentation">
            <button class="nav-link" id="' . $category['name'] . '-tab" data-bs-toggle="tab" data-bs-target="#' . $category['name'] . '" type="button" role="tab" aria-controls="' . $category['name'] . '" aria-selected="false">' . $category['name'] . '</button>
        </li>';
            }
        }
        echo '</ul> </div>';
        echo '<div class="tab-content" id="myTabContent">';
        foreach ($row as $key => $category) {
            //echo '<pre>';
            //var_dump($category);
            //echo '</pre>';
            if ($key == 0) {
                echo '<div class="tab-pane fade show active" id="' . $category['name'] . '" role="tabpanel" aria-labelledby="' . $category['name'] . '-tab">';
            } else {
                echo '<div class="tab-pane fade" id="' . $category['name'] . '" role="tabpanel" aria-labelledby="' . $category['name'] . '-tab">';
            }
            echo '<div class="row g-2">';
            $statement = $db->prepare('SELECT * FROM products WHERE products.category = ?');
            $statement->execute(array($category['id']));
            while ($row = $statement->fetch()) {
                echo ' <div class="col-sm-6 col-md-4">
                        <div class="img-thumbnail ctn">
                            <img src="../img/' . $row['image'] . '" class="img-thumbnail">
                            <div class="price">' . number_format((float)$row['price'], 2, '.', '') . ' €' . '</div>
                            <div class="caption">
                                <h4>' . $row['name'] . '</h4>
                                <p>' . $row['descreption'] . '</p>
                                <a htef="#" class="btn btn-order"><i class="fas fa-shopping-cart"></i> Order</a>
                            </div>
                        </div>
                    </div>';
            }
            echo '</div> </div>';
        }

        echo '</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>';
    } else {
        header('Location:/project-restaurant/frontPages/frontPage.php', true);
        die('');
    }
} else {
    header('Location:/project-restaurant/frontPages/frontPage.php', true);
    die('');
}
if (isset($_GET['logOut'])) {
    session_unset();
    session_destroy();
    header('Location:/project-restaurant/frontPages/loginPge.php');
}
?>
    