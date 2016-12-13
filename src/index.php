<?php
session_start();
require_once('DbPdo.class.php');
require_once('config.php');


//打开
$pdo = DbPdo::getInstance($dbConf[1]);
/*************数据查询***************************/
$sql = 'SHOW TABLE STATUS';
$rs = $pdo->query($sql);

$data = $rs->fetchAll();//取出所有结果


if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    $resault = $pdo->query('TRUNCATE TABLE ' . $name);
    return $resault;
}

if (!empty($_POST['nameDel'])) {
    $nameDel = $_POST['nameDel'];
    $resault = $pdo->query('DROP TABLE ' . $nameDel);
    return $resault;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="jquery-1.8.2.min.js"></script>
    <title>数据库操作</title>
    <style>
        body {
            background-color: #1c2d3f;
        }

        h1 {
            color: #fff0ff;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            border: 1px #1b6d85;
        }

        a:link, a:visited {
            text-decoration: none; /*超链接无下划线*/
            color: #001f3f;
        }

    </style>
</head>
<body>
<h1>
    <center>数据库</center>
</h1>

<select onchange="serverQok(this.options[this.options.selectedIndex].value)"
        style="position: absolute; background-color: #1c2d3f; color: #fff0ff; left: 30%; padding-bottom: 5px; padding-top: 5px; width: 267px; text-align: center; font-size: 20px;">
    <option value="" style="color: #fff0ff">----请选择服务器----</option>
    <?php foreach ($serverList as $key => $itemServer) : ?>
     <option style="color: #fff0ff" value='<?php echo $key; ?>'><?php echo $itemServer['name'] ?></option>
    <?php endforeach; ?>
</select>
<span class="databases"></span>
<span class="showtables"></span>
</body>

<script type="text/javascript">
    function truncate(name) {
        $.ajax({
            type: 'POST',
            url: "<?php echo 'index.php'?>",
            data: {name: name},
            dataType: "json",
            success: function (data) {
                alert('执行成功!');
            }
        });
    }

    function deletes(name) {
        $.ajax({
            type: 'POST',
            url: "<?php echo 'index.php'?>",
            data: {nameDel: name},
            dataType: "json",
            success: function (data) {
                alert('执行成功!');
                document.location.href = '<?php echo 'index.php' ?>';
            }
        });
    }


    function serverQok(server) {
        $.ajax({
            type: 'POST',
            url: "<?php echo 'serverDatabase.php'?>",
            data: {server: server},
            dataType: "json",
            success: function (data) {
                var databases = '<select onchange="showTable(this.options[this.options.selectedIndex].value)" name="server" style="position: absolute; background-color: #1c2d3f; color: #fff0ff; left: 45%; padding-bottom: 8px; padding-top: 6px; width: 247px; text-align: center; font-size: 20px;">';
                var server = '';

                var len = data.length;
                $.each(data, function (key, item) {
                    if (key === len - 1) {
                        server = item.server;
                    }
                });


                $.each(data, function (key, item) {
                    databases += '<option style="color: #fff0ff;" value="'+server+ ','+ item.Database+'">' + item.Database + '</option>';
                });


                $('.databases').html(databases);
            }
        });
    }

    function showTable(table) {
        $.ajax({
            type: 'POST',
            url: "<?php echo 'tables.php'?>",
            data: {showTable: table},
            dataType: "json",
            success: function (data) {
                $('.tables').remove();
                var tableData = '';


                tableData += '<table width="800" border="1" style="position: absolute; background-color: #1c2d3f; margin-top: 48px; left: 30%;"><thead><tr style="color:#fffffc">'
                    + '<th>数据库名称</th>'
                    + '<th colspan="2">操作</th>'
                    + '</tr></thead>';


                $.each(data, function (key, tableItem) {
                    tableData += '<tbody><tr style="color: #fff0ff"><td><center>' + tableItem + '</center></td>'
                        +'<td><a style="color: #00a7d0" href="javascript:void(0)" onclick = "truncate('+"'"+tableItem+"'"+')">'+'<center>清空</center></a></td>'
                        +'<td><a style="color: #00a7d0" href="javascript:void(0)" onclick = "deletes('+"'"+tableItem+"'"+')">' +'<center>删除</center></a></td>'
                        + '</tr></tbody>';
                });

                $('.showtables').html(tableData);

            }
        });
    }

</script>
</html>