<?php 
if (isset($g_user_grants) && is_array($g_user_grants)) {
    array_push($g_user_grants, 'a_delambassador');
    array_push($g_user_grants, 'a_delpartner');
    array_push($g_user_grants, 'a_emailambassador');
    array_push($g_user_grants, 'a_emailpartner');
    array_push($g_user_grants, 'ap_d');
    array_push($g_user_grants, 'ap_pa');
    array_push($g_user_grants, 'ap_st');
    array_push($g_user_grants, 'ap_ppc');
    array_push($g_user_grants, 'aa_d');
    array_push($g_user_grants, 'aa_pa');
    array_push($g_user_grants, 'aa_st');
    array_push($g_user_grants, 'aa_ppc');
    array_push($g_user_grants, 'todo_alert');
    array_push($g_user_grants, 'visa_expire');

}

?>