
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <script src="https://cdn.tiny.cloud/1/41clib5q80b3skysme8id5wsyipgta4zk3tadg4kewnlpb8s/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Document</title>
</head>
<style>
    .list-selected-color {
    min-height: 50px;
    background: #f1f1f1;
    display: flex;
}
.border {
    border: 1px solid #dee2e6!important;
}
</style>
<body>

    <?php
        foreach($_SESSION['cat']['buy'] as $value){
            ?>
            <div class="list-selected-color fa-border">
            <span data-code="" style="border: 1px solid #bcc1c5;"><?php echo $value['name_color'] ?></span>

            </div>
    <?php
        }
    ?>





</span>
</body>
</html>
