<?php

class Comment
{
    public static function getCommentsListForProduct($productId)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $sql = 'SELECT c.id as comment_id,u.id as user_id,u.name,c.message,c.publication_date FROM comment as c join user as u on c.userId = u.id '
            .'WHERE productId = :productId ORDER BY c.publication_date DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':productId', $productId, PDO::PARAM_INT);
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $commentsList = array();
        while ($row = $result->fetch()) {
            $commentsList[$i]['comment_id'] = $row['comment_id'];
            $commentsList[$i]['user_id'] = $row['user_id'];
            $commentsList[$i]['name'] = $row['name'];
            $commentsList[$i]['message'] = $row['message'];
            $commentsList[$i]['publication_date'] = $row['publication_date'];
            $i++;
        }
        return $commentsList;
    }

    public static function leaveComment($userId, $productId, $message)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO comment (userId, productId, message) VALUES (:userId, :productId, :message)';

        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':productId', $productId, PDO::PARAM_INT);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getCommentsList(){
        $db = Db::getConnection();

        // Запрос к БД
        $sql = 'SELECT * FROM comment ORDER BY publication_date DESC';

        $result = $db->query($sql);

        // Получение и возврат результатов
        $i = 0;
        $commentsList = array();
        while ($row = $result->fetch()) {
            $commentsList[$i]['id'] = $row['id'];
            $commentsList[$i]['userId'] = $row['userId'];
            $commentsList[$i]['productId'] = $row['productId'];
            $commentsList[$i]['message'] = $row['message'];
            $commentsList[$i]['publication_date'] = $row['publication_date'];
            $i++;
        }
        return $commentsList;
    }

    public static function deleteCommentById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM comment WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getProductIdByComment($id){
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT productId FROM comment WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch()['productId'];
    }
}