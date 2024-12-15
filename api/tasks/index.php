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
$reference = $_REQUEST['reference'];
$get_user = mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT * FROM `users` WHERE `id` = '{$user_id}' AND `hash` = '{$reference}' LIMIT 1"));

if(!$get_user){
    http_response_code(300);
    echo json_encode(['ok' => false, 'message' => 'user not found'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}


$get_user_tasks = mysqli_fetch_all(mysqli_query($MySQLi, "SELECT `task_name` FROM `user_tasks` WHERE `user_id` = '{$user_id}'"), MYSQLI_ASSOC);
$task_names = array_column($get_user_tasks, 'task_name');





$tasks = [];

$tasks[0]['id'] = 1;
$tasks[0]['slug'] = "invite-frens";
$tasks[0]['reward'] = 5000;
$tasks[0]['complete'] = false;

$tasks[1]['id'] = 2;
$tasks[1]['slug'] = "follow-age-x";
$tasks[1]['reward'] = 1000;
$tasks[1]['complete'] = false;

$tasks[2]['id'] = 3;
$tasks[2]['slug'] = "add-time-telegram";
$tasks[2]['reward'] = 2500;
$tasks[2]['complete'] = false;

$tasks[3]['id'] = 4;
$tasks[3]['slug'] = "good-age";
$tasks[3]['reward'] = 500;
$tasks[3]['complete'] = false;

$tasks[4]['id'] = 5;
$tasks[4]['slug'] = "subscribe-age-telegram";
$tasks[4]['reward'] = 1000;
$tasks[4]['complete'] = false;


$tasks[5]['id'] = 6;
$tasks[5]['slug'] = "boost";
$tasks[5]['reward'] = 2000;
$tasks[5]['complete'] = false;


$tasks[6]['id'] = 7;
$tasks[6]['slug'] = "insta";
$tasks[6]['reward'] = 1000;
$tasks[6]['complete'] = false;

$tasks[7]['id'] = 8;
$tasks[7]['slug'] = "invite10-frens";
$tasks[7]['reward'] = 10000;
$tasks[7]['complete'] = false;

$tasks[8]['id'] = 9;
$tasks[8]['slug'] = "invite20-frens";
$tasks[8]['reward'] = 20000;
$tasks[8]['complete'] = false;

$tasks[9]['id'] = 10;
$tasks[9]['slug'] = "invite50-frens";
$tasks[9]['reward'] = 50000;
$tasks[9]['complete'] = false;

$tasks[10]['id'] = 11;
$tasks[10]['slug'] = "roadmap";
$tasks[10]['reward'] = 2000;
$tasks[10]['complete'] = false;




//          check tasks complete            //
$c = 0;
foreach($tasks as $item){
    if(in_array($item['slug'], $task_names)){
        $tasks[$c]['complete'] = true;
    }
    $c++;
}

$MySQLi->close();

echo json_encode($tasks);









// echo '[
//     {
//         "id": 3,
//         "slug": "invite-frens",
//         "reward": 20000,
//         "complete": false
//     },
//     {
//         "id": 2,
//         "slug": "follow-age-x",
//         "reward": 1000,
//         "complete": false
//     },
//     {
//         "id": 4,
//         "slug": "add-time-telegram",
//         "reward": 2500,
//         "complete": false
//     },
//     {
//         "id": 12,
//         "slug": "good-age",
//         "reward": 50,
//         "complete": false
//     },
//     {
//         "id": 16,
//         "slug": "subscribe-age-telegram",
//         "reward": 50,
//         "complete": false
//     }
// ]';