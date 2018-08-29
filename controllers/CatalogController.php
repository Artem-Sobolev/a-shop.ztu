<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class CatalogController
{

    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex($page = 1)
    {
        $title = 'A-Shop.ztu | Каталог товаров';
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        $products = Product::getProductsListByPage($page);
        $total = Product::getTotalProducts();
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     */
    public function actionCategory($categoryId, $page = 1)
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();
        $title = 'A-Shop.ztu | ' . Category::getCategoryById($categoryId)['name'];

        // Список товаров в категории
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

    public function actionSearch()
    {
        $title = 'A-Shop.ztu | Поиск';
        $text = $_POST['search_text'];
        $products = Product::getSearchProducts($text);
        $categories = Category::getCategoriesList();
        require_once(ROOT . '/views/catalog/search.php');
        return true;
    }
}
