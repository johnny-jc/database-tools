<?php

require_once('config.php');
require_once('DbPdo.class.php');


if (!empty($_POST['showTable'])) {
	$data = explode(',',$_POST['showTable']);
    $serverPdos = DbPdo::getInstance($dbConf[$data[0]]);
    $tablesResault = $serverPdos->query('use '.$data['1']);
    $tables = $serverPdos->query('show tables');
    $data = $tables->fetchAll();//取出所有结果

    foreach ($data as $item){
        $tableData[] = $item[0];
    }

    echo json_encode($tableData);
}