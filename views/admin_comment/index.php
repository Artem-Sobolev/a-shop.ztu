<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление комментариями</li>
                </ol>
            </div>

            <h4>Список комментариев</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID комментария</th>
                    <th>ID пользователя</th>
                    <th>ID продукта</th>
                    <th>Текст комментария</th>
                    <th>Время публикации</th>
                    <th></th>
                </tr>
                <?php foreach ($commentsList as $comment): ?>
                    <tr>
                        <td><?php echo $comment['id']; ?></td>
                        <td><?php echo $comment['userId']; ?></td>
                        <td><?php echo $comment['productId']; ?></td>
                        <td><?php echo $comment['message']; ?></td>
                        <td><?php echo $comment['publication_date']; ?></td>
                        <td><a href="/admin/comment/delete/<?php echo $comment['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

