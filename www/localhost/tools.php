<?php

error_reporting(E_ALL ^ E_DEPRECATED);
define("DB_HOST","mysql");
define("DB_USER","root");
define("DB_PWD","123456");
define("DB_DBNAME","jingchengvote");
define("DB_CHARSET","utf8");

insertPro();
function insertPro()
{
    $ret = array(
        'dw' => 1,
        'ps' => 2,
        'fl' => 3,
    );
    $dir = dirname(__FILE__) . '/works';
    if (!is_dir($dir))
    {
        print('not dir' . $dir);
        return false;
    }
    //打开目录
    $handle = opendir($dir);
    $works = [];
    while (($file = readdir($handle)) !== false)
    {
        //排除掉当前目录和上一个目录
        if ($file == "." || $file == "..")
        {
            continue;
        }
        printf($file . "\n");
        //如果是文件就打印出来，否则递归调用
        if (is_dir(getCompleteFile($dir, $file)) && isset($ret[$file]))
        {
            $sun_dir = getCompleteFile($dir, $file);
            $sun_handle = opendir($sun_dir);
            while (($sun_file = readdir($sun_handle)) !== false)
            {
                if ($sun_file == "." || $sun_file == "..")
                {
                    continue;
                }
                printf($sun_file . "\n");
                $need_info = is_file(getCompleteFile($sun_dir, $sun_file));
                if ($need_info)
                {
                    $format = array('.png', '.jpg', '.gif', '.mp4');
                    $file_info = str_replace($format, '', $sun_file);
                    $info = explode('_', $file_info);
                    $count = count($info);
                    if ($count == 4)
                    {
                        $info[] = 1;
                        $info[] = $ret[$file];
                        $info[] = time();
                        $path = $file . DIRECTORY_SEPARATOR . $sun_file;
                        $info[] = $path;
                        if ($file == 'fl')
                        {
                            $path = 'default.jpg';
                        }
                        $info[] = $path;
                        $item = [];
                        foreach ($info as $value)
                        {
                            if (is_string($value))
                            {
                                $item[] = "'" . $value . "'";
                            }
                            else
                            {
                                $item[] = $value;
                            }
                        }
                        $works[] = $item;
                    }
                    else
                    {
                        $str = sprintf("%s input error: % input data only count: %s, this file: %s\n", $file, $info[0], $count, $sun_file);
                        print($str);
                    }
                }
            }
        }
    }
    var_dump($works);
    foreach ($works as $item)
    {
        $sql = sprintf("insert into vote_pro(pSn, aName, college, pName, cId, sunId, pubTime, path, albumPath) values (%s)", implode(', ', $item));
        print($sql . "\n");
        query($sql);
    }
}

function getCompleteFile($dir, $file)
{
    return $dir . DIRECTORY_SEPARATOR . $file;
}

function query($sql)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DBNAME) or die("数据库连接失败Error: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
    return mysqli_query($link, $sql);
}
