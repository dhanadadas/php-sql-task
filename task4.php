<?php
/**
 * Отладачная функция
 */
function dump($what){
	echo '<pre>';print_r($what);
	echo '</pre>';
};
/**
 * Функция загрузки пользовательских данных
 *
 * Выводит список имен изходя из завленных в $_GET строкой ID пользователей
 * Недочеты и опасности исходного примера и их исправления:
 * 1. основная уязвимость предложенного в примере кода это непредсказуемые GET данные.
 * А значит возможность SQL инъекций. Допустим приходят данные 1,2,3,4,5,6,7,8,9; TRANCATE `users`
 * использована техника подготовленных запросов.
 * 2. так же подключение к базе данных было не оптимально. внутри foreach. Вынесено за пределы foreach
 * 3. ещё одной непредсказуемостью является возможность получить другой тип данных, допустим массив.
 * поэтому добавлена проверка на string
 * 4. Доступ по руту для пользователя не корректен.
 * 5. Можно переделать для получение данных одним запросом к БД. Не считаю это критичной проблемой.
 * XSS CSRF опасности в данном примере не актуальны, потому что не чего не записывается.
 *
 * @param string $user_ids
 * @return array key value (id => name) users
 */
Function load_users_data($user_ids) {
    $data=[];
    if (!is_string($user_ids)) return $data;
    $user_ids = explode(',', $user_ids);
    $db = mysqli_connect("localhost", "user", "qwerty", "db");// конечно конфиги в "рабочем" примере лучше хранить отдельно.
    foreach ($user_ids as $user_id) {
        $query = sprintf("SELECT * FROM `users` WHERE id= %d;",$user_id);
        $sql = mysqli_query($db, $query );
        while($obj = $sql->fetch_object()){
            $data[(int)$user_id] = $obj->name;
        }
    }
    mysqli_close($db);
    return $data;
};

$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id=>$name) {
    echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}

