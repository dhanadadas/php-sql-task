<?php
/**
 * Class User
 */
class User {
    /**
     * @var string Имя пользователя
     */
    var $name;
    /**
     * construct User
     *
     * @param $name string
     */
    public function __construct($name) {}
    /**
     * Возможность получения имени пользователя
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    /**
     * @param $name string
     */
    public function setName($name) {}

    /**
     * Возможность создания новой статьи для пользователя
     *
     * @param $name string
     * @param $text string
     * @return Сlause
     */
    public function newСlause($name, $text) {
        return new Сlause();
    }
    /**
     * Возможность получения списка статей пользователя
     *
     * @return array
     */
    public function getСlauses() {
        return array();
    }
}
/**
 * Class Сlause
 */
class Сlause {
    /**
     * @var string Имя статьи
     * @var string Текст статьи
     * @var User Автор статьи
     */
    var $name;
    var $text;
    var $user;
    /**
     * construct Сlause
     *
     * @param $name string
     * @param $text string
     * @param $user User
     */
    public function __construct($name, $text, $user){}
    /**
     * Задать имя статьи
     *
     * @param $name
     */
    public function setName($name){}
    /**
     * Получить имя статьи
     *
     * @return string
     */
    public function getName(){}
    /**
     * Задать текст статьи
     *
     * @param $text string
     */
    public function setText($text){}
    /**
     * Получить текст статьи
     *
     * @return string
     */
    public function getText(){}
    /**
     * Задать автора статьи
     *
     * @param $user User
     */
    public function setUser($user){}
    /**
     * возможность сменить автора статьи.
     *
     * @param User $user
     * @return void
     */
    public function changeUser($user){}
    /**
     * Получить автора статьи
     *
     * @return User
     */
    public function getUser(){}
    /**
     * Получить имя автора статьи
     *
     * @return string
     */
    public function getUserName(){}
}