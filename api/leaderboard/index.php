<?php

include '../../bot/config.php';
include '../../bot/functions.php';

$MySQLi = new mysqli('localhost',$DB['username'],$DB['password'],$DB['dbname']);
$MySQLi->query("SET NAMES 'utf8'");
$MySQLi->set_charset('utf8mb4');
if ($MySQLi->connect_error) die;
function ToDie($MySQLi){
$MySQLi->close();
die;
}


$user_id = $_REQUEST['user_id'];
$get_user = mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT * FROM `users` WHERE `id` = '{$user_id}' LIMIT 1"));

if(!$get_user){
    http_response_code(300);
    echo json_encode(['ok' => false, 'message' => 'user not found'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}

$users_list = mysqli_fetch_all(mysqli_query($MySQLi, "SELECT `id`, `username`, `score` FROM users ORDER BY score DESC LIMIT 200"), MYSQLI_ASSOC);
$user_rank = mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT ID, score, (SELECT COUNT(*) + 1 FROM users AS u2 WHERE u2.score > u1.score) AS user_rank FROM users AS u1 WHERE ID = '{$user_id}'"))['user_rank'] - 1;
@$totalPlayers = $MySQLi->query("SELECT `id` FROM `users`")->num_rows?:0;

$list = array();
$list['me']['position'] = (int) $user_rank;
$list['me']['score'] = $get_user['score'];


$c = 0;
foreach($users_list as $item){
    if ($c == 200) break;
    $list['board'][$c]["position"] = $c + 1;
    $list['board'][$c]["score"] = (int) $item['score'];
    $list['board'][$c]["telegram_id"] = $item['id'];
    $list['board'][$c]["username"] = $item['username'];
    $c++;
}
$list['count'] = $totalPlayers;

$MySQLi->close();

echo json_encode($list);



// echo '{
//     "me": {
//         "position": 2,
//         "score": 3075
//     },
//     "board": [
//         {
//             "position": 0,
//             "score": 2846134,
//             "telegram_id": 6597594922,
//             "username": "crptanec"
//         },
//         {
//             "position": 1,
//             "score": 2035452,
//             "telegram_id": 6806722811,
//             "username": "DictatorImperium"
//         },
//         {
//             "position": 2,
//             "score": 1983350,
//             "telegram_id": 305094295,
//             "username": "ladesov"
//         },
//         {
//             "position": 3,
//             "score": 1788298,
//             "telegram_id": 1855193262,
//             "username": "MamelekatSup"
//         }
//     ],
//     "count": 4
// }';