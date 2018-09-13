<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'TodoAPI.class.php');


try {


    # db connect
    $todo = new TodoAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

    # check valid user
    $user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

    # get last reload time
    $last_reload_time = isset($_COOKIE['last_reload'])? $_COOKIE['last_reload'] : 0;

    $task_id = isset($_REQUEST['id'])? $_REQUEST['id'] : 0;
    $delay_time = isset($_REQUEST['dt'])? $_REQUEST['dt'] : 0;
    $action = isset($_REQUEST['act'])? $_REQUEST['act'] : '';
    switch ($action) {
        case 'reload':
            $todo->genVisaTask($_REQUEST['uid']);
            $todo->genMinVisaExpire($_REQUEST['uid']);
            $todo->genApplyVisaExpire($_REQUEST['uid']);
            $todo->genCourseTask($_REQUEST['uid']);
            echo "reload OK";
            exit;
            break;
        case 'done':
            $todo->done($task_id);
            echo json_encode(array('succ'=>1));
            exit;
            break;

        case 'remind':
            $todo->remind($task_id, $delay_time);
            echo json_encode(array('succ'=>1));
            exit;
            break;
        
        default:

            if ((time() - $last_reload_time) > 4*3600) {
                $todo->genVisaTask($user_id);
                $todo->genMinVisaExpire($user_id);
                $todo->genApplyVisaExpire($user_id);
                $todo->genCourseTask($user_id);    
                setCookie('last_reload', time(), time()+24*3600);            
            }

            $source = isset($_REQUEST['src'])? $_REQUEST['src'] : '';
            # get todo list
            $o_tpl = new Template;
            $o_tpl->assign('todos', $todo->getUndoneList($user_id, $source));
            $o_tpl->assign('filters', $todo->getUndoneReport($user_id));
            $o_tpl->assign('source', $source);
            $o_tpl->display('todo_v2.tpl');        
            break;
    }   

}
catch (Exception $e){
    echo $e->getMessage()."\n";
    exit(1);
}