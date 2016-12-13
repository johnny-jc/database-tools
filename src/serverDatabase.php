<?php

require_once('config.php');
require_once('DbPdo.class.php');

if (!empty($_POST['server'])) {
    $server= $_POST['server'];
    $serverPdos = DbPdo::getInstance($dbConf[$server]);
    $serverResault = $serverPdos->query('show databases');
    $serverResaultData = $serverResault->fetchAll();//取出所有结果
    $databaseArr = array_merge($serverResaultData,array(array('server'=>$server)));
    echo json_encode($databaseArr);
}

