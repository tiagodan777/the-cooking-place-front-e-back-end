<?php
require_once '../src/bootstrap.php';

$id = 1;
$category = $cms->getCategory()->delete($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
        <?php
            var_dump($category);
        ?>
    </pre>
</body>
</html>