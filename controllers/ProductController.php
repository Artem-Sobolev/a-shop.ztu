<?php

/**
 * Контроллер ProductController
 * Товар
 */
class ProductController
{

    /**
     * Action для страницы просмотра товара
     * @param integer $productId <p>id товара</p>
     */
    public function actionView($productId)
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Получаем информацию о товаре
        $product = Product::getProductById($productId);
        $title = 'A-Shop.ztu | ' . $product['name'];

        /*if (isset($_POST['submit_comment'])){
            $message = $_POST['message'];
            $comment_result = Comment::leaveComment($_SESSION['user'], $productId, $message);
            header("Location: /product/".$productId);
        }*/

        // Получаем комментарии
        $comments = Comment::getCommentsListForProduct($productId);

        // Подключаем вид
        require_once(ROOT . '/views/product/view.php');
        return true;
    }

}
