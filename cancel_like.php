<?php
// cancel_like.php
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

include("load.php");

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // 执行删除操作，例如：
    $result = Query("DELETE FROM ybc_like WHERE user_id = " . $user_id . " AND like_id = " . $userId);

    // 可以根据需要进行错误处理或其他逻辑

    // 返回响应给客户端
    echo "success";
}
