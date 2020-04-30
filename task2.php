<?php
/**
 * Отладачная функция
 */
function dump($what){
	echo '<pre>';print_r($what);
	echo '</pre>';
};
/**
 * Функиция изменяющая URL
 *
 * Что делает?
 * удалит параметры со значением “3”
 * отсортирует параметры по значению
 * добавит параметр url со значением из переданной ссылки без параметров (в примере: /test/index.html);
 * сформирует и вернёт валидный URL на корень указанного в ссылке хоста.
 *
 * @param string $url
 * @return string
 */
function changeUrlQuery($url) {
    /**
     * проверка наличия параметров и выход если таковых нет
     */
    if (!isset(parse_url($url)[query])){
        return false;
	};
    $params = array();
    /**
     * query url в ассоциативный массив
     */
    foreach (explode('&', parse_url($url)[query]) as $param) {
        $item = explode('=', $param);
        $params[$item[0]] = $item[1];
	};
    /**
     * удалем все элементы с параметром "3". Можно было как вариант на
     * предыдущем этапе просто игнорировать элементы со значением "3"
     * примерно таким условием if($item[1]!=="3"))
     */
    while(($key = array_search('3',$params)) !== FALSE) unset($params[$key]);
    /**
     * сортируем по значению
     */
    asort($params);
    /**
     * добавляем параметр url со значением из переданной
     * ссылки без параметров, если он есть (в примере: /test/index.html);
     */
    if (isset(parse_url($url)[path])){
	    $params["url"] = parse_url($url)[path];
		};
	$resultUrl=parse_url($url)[scheme]."://".parse_url($url)[host]."/?".http_build_query($params, '', '&amp;');// генерируем изменённую ссылку
	return $resultUrl;
};

/**
 * Таже самая функиция только короче
 *
 * Данная версия функции не имеет проверок существования необходимых частей в URL
 * Что делает?
 * удалит параметры со значением “3”
 * отсортирует параметры по значению
 * добавит параметр url со значением из переданной ссылки без параметров (в примере: /test/index.html);
 * сформирует и вернёт валидный URL на корень указанного в ссылке хоста.
 *
 * @param string $url
 * @return string
 */
function changeUrlQueryDV($url) {
    $params = array();
    foreach (explode('&', parse_url($url)[query]) as $param) {
        $item = explode('=', $param);
        $params[$item[0]] = $item[1];
    };
    while(($key = array_search('3',$params)) !== FALSE) unset($params[$key]);
    asort($params);
    $params["url"] = parse_url($url)[path];
    $resultUrl=parse_url($url)[scheme]."://".parse_url($url)[host]."/?".http_build_query($params, '', '&amp;');
    return $resultUrl;
};

$url="https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3";
dump(changeUrlQuery($url));
