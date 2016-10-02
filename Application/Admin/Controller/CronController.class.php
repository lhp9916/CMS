<?php
namespace Admin\Controller;

use \Think\Controller;

class CronController
{
    public function dumpMysql()
    {
        //mysqldump -uroot -proot cms > /tmp/cms.sql
        $shell = "mysqldump ".C('DB_NAME')." >/tmp/cms/cms-".date('Ymd').".sql";
        exec($shell);
        //在crontab中这样写,凌晨一点执行
        // 0 1 * * * php /vagrant/cron.php admin cron dumpMysql
    }

}