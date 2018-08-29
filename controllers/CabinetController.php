<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        $title = 'A-Shop.ztu | Кабинет пользователя';
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
    {
        $title = 'A-Shop.ztu | Редактирование данных';
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Заполняем переменные для полей формы
        $name = $user['name'];
        $phone = $user['phone'];

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['name'];
            $phone = $_POST['phone'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if(!User::checkPhone($phone)) {
                $errors[] = 'Неверный номер телефона. Возможно введен в неполной форме';
            }
            if(User::checkPhoneExists($phone)) {
                $errors[] = 'Пользователь с таким номером телефона уже существует';
            }


            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = User::edit($userId, $name, $phone);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

    public function actionEditPassword()
    {
        $title = 'A-Shop.ztu | Смена пароля';
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!password_verify($old_password, $user['password'])) {
                $errors[] = 'Неверный старый пароль';
            }
            if (!User::checkPassword($new_password)) {
                $errors[] = 'Новый пароль не должен быть короче 6-ти символов';
            }
            if($errors == false && password_verify($old_password, $user['password'])) {
                // Если ошибок нет, сохраняем изменения пароля
                $hash = password_hash($new_password, PASSWORD_BCRYPT);
                $result = User::editPassword($userId, $hash);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/editPassword.php');
        return true;
    }

}
