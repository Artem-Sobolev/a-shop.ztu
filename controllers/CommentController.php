<?php

class CommentController
{
    public function actionDelete($id)
    {
        $productId = Comment::getProductIdByComment($id);
        Comment::deleteCommentById($id);
        // Получаем комментарии
        $comments = Comment::getCommentsListForProduct($productId);
        return include_once ROOT . '/views/comment/comment_block.php';
    }

    public function actionAdd(){
        $message = $_POST['message'];
        $userId = $_POST['userId'];
        $productId = $_POST['productId'];
        Comment::leaveComment($userId, $productId, $message);
        $comments = Comment::getCommentsListForProduct($productId);
        return include_once ROOT . '/views/comment/comment_block.php';
    }
}