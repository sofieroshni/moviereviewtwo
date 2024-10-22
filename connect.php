<?php
const CONFIG = [
    'db' => 'mysql:dbname=sofieroshni_dk_db_moviereviewtwo;host=mysql18.unoeuro.com;port=3306',
    'db_user' => 'sofieroshni_dk',
    'db_password' => 'R4FA35tEDcgk2xe6fGbd',
];

//*const CONFIG = [
  //  'db' => 'mysql:host=localhost;dbname=moviereview;port=3306',
    //'db_user' => 'root',
    //'db_password' => '',
//];

global $pdo;
try {
    $pdo = new PDO(CONFIG['db'], CONFIG['db_user'], CONFIG['db_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Forbindelsen mislykkedes: " . $e->getMessage();
    exit;
}

function sql($query, $params = []) {
    global $pdo;

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "Forespørgslen mislykkedes: " . $e->getMessage();
        return [];
    }
}
?>

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>

</div>
<script>

</script>
</body>
</html>
