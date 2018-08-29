<h3>Комментарии</h3>
<?php if(isset($_SESSION['user'])): ?>
    <div class="comment-form">
        <form method="post" id="commentForm">
            <input type="text" name="message" placeholder="Оставьте свой комментарий">
            <input type="submit" name="submit_comment" class="btn">
        </form>
    </div>
<?php
else: echo "<div>Оставлять комментарии могут только зарегистрированные пользователи</div><br>";
endif; ?>
<?php foreach($comments as $comment): ?>
    <div class="comment-block">
        <div class="comment-author panel-title">
            <?php echo $comment['name'].' - '.$comment['publication_date'] ?>
            <?php if(isset($_SESSION['user']) && $_SESSION['user'] == $comment['user_id']): ?>
                <a href="" title="Удалить" data-comment-id="<?php echo $comment['comment_id'] ?>"><i class="fa fa-times"></i></a>
            <?php endif; ?>
        </div>
        <div><?php echo $comment['message']?></div>
    </div>
    <br/>
<?php endforeach; ?>