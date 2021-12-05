<html>
<body bgcolor="blue">

<?php

require 'database.php';
$db = new Database;
$conn = $db->getConnection();

$sql = "SELECT * FROM USER";
$res = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($res);



echo "Hello World";
?>

</body>
</html>