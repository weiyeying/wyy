<?php

/**
 * 父类
 * @author    <weiyeying@163.com> 
 * @since        1.0 
 */
class Controller {


    /**
     * some_func  
     * 函数的含义说明 
     * @access public 
     * @param mixed $arg1 参数一的说明 
     * @since 1.0 
     * @return array 
     */
    //重新定义构造函数
    public function __construct() {
        if (method_exists($this, 'init')) {
            $this->init();
        }

        !C('CHECK_POST') || $this->check_post();
    }

    /*     * 渲染视图* */

    public function render($view, $data = array()) {
        $path = APP_VIEW . '/' . CONTROLLER_URL . "/" . $view . ".php";
        if (!is_file($path)) {
            halt($path . "模板文件不存在");
        }
        is_array($data) || halt($data . "..请传个数组好吗");
        include $path;
    }

    /*     * 静态化判断* */

    public function isCache($view, $time = 300) {
        $html = APP_VIEW . '/' . CONTROLLER_URL . "/" . $view . ".html";
        if (file_exists($html) && filemtime($html) + $time > time()) {
            return true;
        } else {
            return false;
        }
    }

    /*     * 渲染静态化
     * $view视图文件名称
     * $data数据
     * $time 缓存时间（秒）
     * * */

    public function renderCache($view, $data = array(), $time = 300) {
        $path = APP_VIEW . '/' . CONTROLLER_URL . "/" . $view . ".php";
        $html = APP_VIEW . '/' . CONTROLLER_URL . "/" . $view . ".html";
        if (file_exists($html) && filemtime($html) + $time > time()) {
            include ($html);
        } else {
            if (!is_file($path)) {
                halt($path . "模板文件不存在");
            }
            is_array($data) || halt($data . "..请传个数组好吗");
            $ob = ob_start();
            include $path;
            $contents = ob_get_contents();
            file_put_contents($html, $contents);
        }
    }

    public function db($sql) {
        return new DB($sql);
    }

    public function success($title, $msg, $url) {
        echo include APP_PUBLIC . "/success.php";
        die;
    }

    public function error($title, $msg, $url) {
        echo include APP_PUBLIC . "/error.php";
        die;
    }

    //检测参数 
    public function check_post() {
        if (isset($_POST) && is_array($_POST)) {
            $this->_strsp($_POST);
        }
    }

    //执行过滤
    private function _strsp($arr) {
        $clean_data = array();
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $_data = array();
                foreach ($v as $key => $value) {
                    $_data[$key] = $this->clean_xss($value);
                    $_data[$key] = stripslashes($value);
                    $_data[$key] = $this->dowith_sql($value);
                    $_data[$key] = addslashes($value);
                }
                $clean_data[$k] = $_data;
            } else {
                $clean_data[$k] = $this->clean_xss($v);

                $clean_data[$k] = stripslashes($v); //过滤 \
                $clean_data[$k] = $this->dowith_sql($v);
                $clean_data[$k] = addslashes($v);
            }
        }
        return $clean_data;
    }

    private function dowith_sql($str) {
        $str = str_replace("and", "", $str);
        $str = str_replace("execute", "", $str);
        $str = str_replace("update", "", $str);
        $str = str_replace("count", "", $str);
        $str = str_replace("chr", "", $str);
        $str = str_replace("mid", "", $str);
        $str = str_replace("master", "", $str);
        $str = str_replace("truncate", "", $str);
        $str = str_replace("char", "", $str);
        $str = str_replace("declare", "", $str);
        $str = str_replace("SELECT", "", $str);
        $str = str_replace("UNION", "", $str);
        $str = str_replace("ALL", "", $str);
        $str = str_replace("all", "", $str);
        $str = str_replace("select", "", $str);
        $str = str_replace("create", "", $str);
        $str = str_replace("delete", "", $str);
        $str = str_replace("insert", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("\"", "", $str);
        $str = str_replace(" ", "", $str);
        $str = str_replace("or", "", $str);
        $str = str_replace("=", "", $str);
        $str = str_replace("%20", "", $str);
        return $str;
    }

    private function clean_xss(&$string, $low = False) {
        if (!is_array($string)) {
            $string = trim($string);
            $string = strip_tags($string);
            $string = htmlspecialchars($string);
            if ($low) {
                return True;
            }
            $string = str_replace(array('"', "\\", "'", "/", "..", "../", "./", "//"), '', $string);
            $no = '/%0[0-8bcef]/';
            $string = preg_replace($no, '', $string);
            $no = '/%1[0-9a-f]/';
            $string = preg_replace($no, '', $string);
            $no = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';
            $string = preg_replace($no, '', $string);
            return True;
        }
        $keys = array_keys($string);
        foreach ($keys as $key) {
            clean_xss($string [$key]);
        }
    }

}

?>