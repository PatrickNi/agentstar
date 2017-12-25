<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');



$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

# get country
$country_arr = array();
$country_arr = $o_c->getCountry();
foreach ($country_arr as $id => $name) {
	echo '$AS_COUNTRY['.$id.'] = \''.ucwords($name).'\';'."<br/>";
}

?>
