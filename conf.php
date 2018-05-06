<?php
//echo file_get_contents('d:/immi/etc/const.php');
if (copy('d:/immi/etc/const.php', 'd:/immi/etc/const.php.bak')) {
    echo "Backup const sucess \n";
    if (copy('d:/immi/scripts/const_www.php', 'd:/immi/etc/const.php'))
        echo "New const generated\n";
}
