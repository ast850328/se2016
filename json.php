<?php 
require "dbconnect.php";
$aid=$_POST["aid"];
$name=$_POST["name"];
$cName=$_POST["cName"];
$num=$_POST["num"];
$hName=$_POST["hName"];
$price=$_POST["price"];
$deadline=$_POST["deadline"];
$cards = array("A","B","C","D","E","F","G","H");
$f=$_POST['first'];
$s=$_POST['second'];
$t=$_POST['third'];
global $conn;
//�Y���H�v�� -> �s�Wrecord �o�Ъ̥[�w�s ���̥[��
if($hName != ""){
    $sql="INSERT INTO `record` (`rid`, `auc`, `bidder`, `cName`, `price`, `deadline`) VALUES (NULL, '$name', '$hName', '$cName', '$price', '$deadline');";
    $result = mysqli_query($conn,$sql);
    if($name=='npc'){
        $sql="update inventory,player set $cards[$f]=$cards[$f]+1 where name='$hName' and player.uid = inventory.uid;";
        $result = mysqli_query($conn,$sql);
        $sql="update inventory,player set $cards[$s]=$cards[$s]+1 where name='$hName' and player.uid = inventory.uid;";
        $result = mysqli_query($conn,$sql);
        $sql="update inventory,player set $cards[$t]=$cards[$t]+1 where name='$hName' and player.uid = inventory.uid;"; 
    }else
        $sql="update inventory,player set $cName=$cName+$num where name='$hName' and player.uid = inventory.uid;";
    $result = mysqli_query($conn,$sql);

    $sql="update player set money=money+$price where name='$name';";
    $result = mysqli_query($conn,$sql);
}else{//���̥[�w�s
    $sql="update inventory,player set $cName=$cName+$num where name='$name' and player.uid = inventory.uid;";
    $result = mysqli_query($conn,$sql);
}

$sql="delete from auction where aid = '$aid';";
$result = mysqli_query($conn,$sql);
?>
