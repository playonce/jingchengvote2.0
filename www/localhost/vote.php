<?php
require_once 'include.php';
@$id=$_REQUEST['id'];
function getIPaddress()

{

    $IPaddress='';

    if (isset($_SERVER)){

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];

        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {

            $IPaddress = $_SERVER["HTTP_CLIENT_IP"];

        } else {

            $IPaddress = $_SERVER["REMOTE_ADDR"];

        }

    } else {

        if (getenv("HTTP_X_FORWARDED_FOR")){

            $IPaddress = getenv("HTTP_X_FORWARDED_FOR");

        } else if (getenv("HTTP_CLIENT_IP")) {

            $IPaddress = getenv("HTTP_CLIENT_IP");

        } else {

            $IPaddress = getenv("REMOTE_ADDR");

        }

    }

    return $IPaddress;

}

$IPaddress=getIPaddress();
$sql="select * from vote_pro where id={$id} ORDER BY pSn ASC ";
$cateId=fetchOne($sql);
$sql="insert into vote_ip(id,ip) VALUES({$cateId['sunId']},'{$IPaddress}') ";
$result=mysql_query($sql);
$ipid=mysql_insert_id();
$sql="select * from vote_iptime where iid='{$ipid}'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result,MYSQL_ASSOC);
$mess;
if($row)
{
    $sql="update vote_pro set pVote=pVote+1 WHERE id={$id}";
    mysql_query($sql);
    $mess=alertMes("投票成功！","voteMain.php?id={$id}");
}
else $mess=alertMes("您已经投过票！","voteMain.php?id={$id}");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>投票</title>
</head>
<body>
<?php
if(@$mess){
    echo $mess;
}
?>
</body>
</html>



