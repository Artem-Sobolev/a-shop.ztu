<?php

/**
 * Контроллер AdminCommentController
 * Управление комментариями в админпанели
 */
class AdminCommentController extends AdminBase
{
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список комментариев
        $commentsList = Comment::getCommentsList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_comment/index.php');
        return true;
    }

    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем комментарий
            Comment::deleteCommentById($id);

            // Перенаправляем пользователя на страницу управлениями комментариями
            header("Location: /admin/comment");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_comment/delete.php');
        return true;
    }
}