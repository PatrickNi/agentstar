<?php
$type = isset($_GET['t'])? $_GET['t'] : "";
$width = "screen.width*4/5";
$height = "screen.height*4/5";

switch ($type){
	case 'comm':
		$semid = isset($_GET['semid'])? $_GET['semid'] : 0;
		$ccid = isset($_GET['ccid'])? $_GET['ccid'] : 0;
		$cid = isset($_GET['cid'])? $_GET['cid'] : 0;
		$url2 = "client_course_sem.php?semid={$semid}&courseid={$ccid}&cid={$cid}";
		$url1 = "client_course.php?cid={$cid}";
		break;
	case 'vsr':	
	case 'vtl':
		$cid = isset($_GET['cid'])? $_GET['cid'] : 0;
		$vid = isset($_GET['vid'])? $_GET['vid'] : 0;
		$pid = isset($_GET['pid'])? $_GET['pid'] : 0;
		$width = "screen.width*5/9";
		$height = "screen.height*2/3";
		$url2 = "client_visa_process.php?pid={$pid}&vid={$vid}&cid={$cid}";
		$url1 = "client_visa_detail.php?vid={$vid}&cid={$cid}";
		break;
	case 'vs':
		$cid = isset($_GET['cid'])? $_GET['cid'] : 0;
		$vid = isset($_GET['vid'])? $_GET['vid'] : 0;
		$url2 = "client_visa_detail.php?vid={$vid}&cid={$cid}";
		$url1 = "client_detail.php?cid={$cid}";
		break;
	case 'os':
		$cid = isset($_GET['cid'])? $_GET['cid'] : 0;
		$url2 = "client_service.php?cid={$cid}";
		$url1 = "client_detail.php?cid={$cid}";
		break;
	case 'ctl':
		$cid = isset($_GET['cid'])? $_GET['cid'] : 0;
		$ccid = isset($_GET['ccid'])? $_GET['ccid'] : 0;
		$pid = isset($_GET['pid'])? $_GET['pid'] : 0;
		$width = "screen.width*5/9";
		$height = "screen.height*2/3";		
		$url2 = "client_course_process.php?pid={$pid}&cid={$cid}&courseid={$ccid}";
		$url1 = "client_course_detail.php?courseid={$ccid}&cid={$cid}";
		break;	
	case 'ins':
		$sid = isset($_GET['sid'])? $_GET['sid'] : 0;
		$pid = isset($_GET['pid'])? $_GET['pid'] : 0;
		$width = "screen.width*5/9";
		$height = "screen.height*2/3";		
		$url1 = "institute_process.php?sid={$sid}";
		$url2 = "institute_proc_dt.php?pid={$pid}&sid={$sid}";
		break;	
	case 'agt':
		$aid = isset($_GET['aid'])? $_GET['aid'] : 0;
		$pid = isset($_GET['pid'])? $_GET['pid'] : 0;
		$width = "screen.width*5/9";
		$height = "screen.height*2/3";		
		$url1 = "agent_process.php?aid={$aid}";
		$url2 = "agent_process_dt.php?pid={$pid}&aid={$aid}";
		break;		
	case 'ser':
		$cid = isset($_GET['cid'])? $_GET['cid'] : 0;
		$pid = isset($_GET['pid'])? $_GET['pid'] : 0;
		$width = "screen.width*5/9";
		$height = "screen.height*2/3";		
		$url1 = "client_service.php?cid={$cid}";
		$url2 = "client_service_dt.php?sid={$pid}&cid={$cid}";
		break;	
	case 'va':
		$vid = isset($_GET['vid'])? $_GET['vid'] : 0;
		$cid = isset($_GET['cid'])? $_GET['cid'] : 0;
		$width = "screen.width*5/9";
		$height = "screen.height*2/3";		
		$url1 = "client_visa_detail.php?vid={$vid}&cid={$cid}";
		$url2 = "client_account.php?vid={$vid}&cid={$cid}";	
		break;									
	default:
		echo "<script language='javascript'>alert('Unknown Location');self.close();</script>";
		break;		
}

?>
<html>
<iframe id="internalFrame" src="<?php echo $url1;?>" width="100%" height="100%" align="top"></iframe>
<script language="javascript" src="../js/audit.js"></script>
<script language="javascript" >openModelFrame('<?php echo $url2;?>',<?php echo $width;?>,<?php echo $height;?>,'NO', 'internalFrame');</script>
</html>
