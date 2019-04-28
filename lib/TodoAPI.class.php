<?php
require_once('MysqlDB.class.php');

class TodoAPI {

    const TBL = 'todo_lists';
    const STATUS_PENDING = 'NEW';
    const STATUS_STARRED = 'STARRED';
    const STATUS_DELAYED = 'DELAYED';
    const STATUS_DONE    = 'DONE';

    private $db = '';

    function __construct($host, $user, $pswd, $database, $debug) {
        $this->db = new MysqlDB($host, $user, $pswd, $database, $debug);
    }


    function upload($data) {
        foreach ($data as $v){
            $sql = "INSERT IGNORE INTO ".self::TBL." (user_id, source, source_id, begin_date, due_date, raw_data, created) VALUES ('{$v['user_id']}','{$v['source']}','{$v['source_id']}','{$v['begin_date']}','{$v['due_date']}','".json_encode($v['raw_data'])."', NOW())";
            $this->db->query($sql);
        }
        return true;
    } 


    function genDoBTask($userid) {
        $sql = "select b.CID, b.DOB,  concat(LName, ' ', FName) as ClientName from client_course a, client_info b where a.CID = b.CID  AND date_format(b.DOB, '%Y-%m-%d') >= Date(NOW()) and date_format(b.DOB, '%Y-%m-%d') < Date(NOW()) + INTERVAL 7 Day AND a.ConsultantID = {$userid}";

        $this->db->query($sql);
        $data = array();
        while ($this->db->fetch()) {
            array_push($data, array('user_id'=>$userid, 
                                     'source'=>'dob', 
                                     'source_id'=>$this->db->CID, 
                                     'begin_date'=>$this->db->DOB, 
                                     'due_date'=>$this->db->DOB, 
                                     'raw_data'=>array('client'=>$this->db->ClientName, 
                                                        'subject'=>'Send happy birthday message on '.$this->db->DOB,
                                                        'cid'=>$this->db->CID
                                                    )
                                 )
                        );
        }

        return $this->upload($data);         
    }


    function genVisaTask($userid){
        $sql = "select a.ID, concat(LName, ' ', FName) as ClientName, VisaName, ClassName, IF(a.ItemID > 0, Item, ExItem) as Item, DueDate, BeginDate, f.CID, CVID from client_visa_process a left join visa_rs_item c on(a.ItemID = c.ItemID) ,  client_visa  b, visa_category d,  visa_subclass e, client_info f where a.Done = 0 and a.CVID = b.ID and b.CID = f.CID and b.CateID = d.CateID and b.SubClassID = e.SubClassID AND (a.DueDate >= '2018-05-01' and a.DueDate < Date(NOW()) + INTERVAL 7 Day)  AND b.VUserID = {$userid} ";

        $this->db->query($sql);
        $data = array();
        while ($this->db->fetch()) {
            array_push($data, array('user_id'=>$userid, 
                                     'source'=>'visa', 
                                     'source_id'=>$this->db->ID, 
                                     'begin_date'=>$this->db->BeginDate, 
                                     'due_date'=>$this->db->DueDate, 
                                     'raw_data'=>array('client'=>$this->db->ClientName, 
                                                        'visa'=>$this->db->VisaName, 
                                                        'subclass'=>$this->db->ClassName, 
                                                        'subject'=>$this->db->Item,
                                                        'cid'=>$this->db->CID,
                                                        'cvid'=>$this->db->CVID
                                                    )
                                 )
                        );
        }

        return $this->upload($data);
    }

    function genMainVisaExpire($userid) {
        $file_lck = dirname(__FILE__).'/mainvisa.lck';
        if (file_exists($file_lck))
            return false;
        touch($file_lck);

        $sql = "select CID, concat(LName, ' ', FName) as ClientName, c.VisaName, d.ClassName, ExpirDate as Epd from client_info a left join visa_category c on(a.VisaID = c.CateID) left join visa_subclass d on(a.VisaClassID = d.SubClassID) where ExpirDate >= '2018-05-04' AND ExpirDate < Date(NOW()) + INTERVAL 1 Month";
        $this->db->query($sql);
        $data = $visa_student = $visa_other = array();
        $i = 0;
        while ($this->db->fetch()) {
            $data[$i] = array('user_id'=>3, // grace is default 
                                     'source'=>'expire_main', 
                                     'source_id'=>$this->db->CID, 
                                     'begin_date'=> '0000-00-00',
                                     'due_date'=>$this->db->Epd, 
                                     'raw_data'=>array('client'=>$this->db->ClientName, 
                                                        'visa'=>$this->db->VisaName, 
                                                        'subclass'=>$this->db->ClassName,
                                                        'cid'=>$this->db->CID,
                                                    )
                                 );
            $i++;

            if (stripos($this->db->VisaName, 'student') !== false) {
                if (isset($visa_student[$this->db->CID])) {
                    array_push($visa_student[$this->db->CID], $i);
                }
                else
                    $visa_student[$this->db->CID] = array($i);   
            }
            else {
                if (isset($visa_other[$this->db->CID])) {
                    array_push($visa_other[$this->db->CID], $i);
                }
                else
                    $visa_other[$this->db->CID] = array($i);                
            }
        }

        if (count($visa_student) > 0) {
            $sql = "SELECT CID, ConsultantID, MAX(ID) FROM client_course WHERE CID IN (".implode(',', array_keys($visa_student)).") group by CID";
            $this->db->query($sql);
            while($this->db->fetch()) {
                foreach ($visa_student[$this->db->CID] as $k) {
                    $data[$k]['user_id'] = $this->db->ConsultantID;
                }
            }
        }
        

        if (count($visa_other) > 0) {
            $sql = "SELECT CID, AUserID, MAX(ID) FROM client_visa WHERE CID IN (".implode(',', array_keys($visa_student)).") group by CID";
            $this->db->query($sql);
            while($this->db->fetch()) {
                foreach ($visa_other[$this->db->CID] as $k) {
                    $data[$k]['user_id'] = $this->db->AUserID;
                }
            }
        }

        $this->upload($data);
        unlink($file_lck);
        return true;        
    }


    function genApplyVisaExpire($userid) {
        $sql = "select a.ID as VID, a.CID, a.ExpireDate as Epd, concat(b.LName, ' ', b.FName) as ClientName, c.VisaName, d.ClassName, 0 as main from client_visa a left join visa_category c on(a.CateID = c.CateID) left join visa_subclass d on(a.SubClassID = d.SubClassID), client_info b where a.CID = b.CID and a.r_Status = 'active' and a.OnShore = 1 and (a.ADate <> '' and a.ADate <> '0000-00-00') AND a.ExpireDate >= '2018-05-04' AND ExpireDate < Date(NOW()) + INTERVAL 6 Month AND (a.AUserID = {$userid} or a.VUserID = {$userid}) ";
        
        $this->db->query($sql);
        $data = array();
        while ($this->db->fetch()) {
            array_push($data, array('user_id'=>$userid, 
                                     'source'=>'expire_apply', 
                                     'source_id'=>$this->db->CID, 
                                     'begin_date'=> '0000-00-00',
                                     'due_date'=>$this->db->Epd, 
                                     'raw_data'=>array('client'=>$this->db->ClientName, 
                                                        'visa'=>$this->db->VisaName, 
                                                        'subclass'=>$this->db->ClassName,
                                                        'cid'=>$this->db->CID,
                                                        'vid' => $this->db->VID
                                                    )
                                 )
                        );
        }

        return $this->upload($data);        
    }

    function genCourseTask($userid) {
        $sql = "select a.ID, concat(LName, ' ', FName) as ClientName, Qual, Major, e.Name, DueDate, BeginDate, if(p.ID is not null, p.Process, ExItem) as ProcessName, f.CID, CCID, if(p.ID > 0, p.ID, 0) AS ProcessID  from client_course_process a left join course_process p on (a.ProcessID = p.ID), client_course  b,  institute_qual c,  institute_major d, institute e, client_info f where b.CID = f.CID and a.Done = 0 and a.CCID = b.ID and b.QualID = c.ID and b.MajorID = d.ID and b.IID = e.ID AND a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day AND b.ConsultantID = {$userid}";
    
        $this->db->query($sql);
        $data = array();
        while ($this->db->fetch()) {
            array_push($data, array('user_id'=>$userid, 
                                     'source'=>'course', 
                                     'source_id'=>$this->db->ProcessID, 
                                     'begin_date'=>$this->db->BeginDate, 
                                     'due_date'=>$this->db->DueDate, 
                                     'raw_data'=>array('client'=>$this->db->ClientName, 
                                                        'subject'=>$this->db->ProcessName,
                                                        'cid'=>$this->db->CID,
                                                        'ccid'=>$this->db->CCID,
                                                        'qual'=>$this->db->Qual,
                                                        'major'=>$this->db->Major,
                                                        'school'=>$this->db->Name,
                                                        'processid'=>$this->db->ProcessID,
                                                    )
                                 )
                        );
        }

        return $this->upload($data);
    }

    function formatSource($source) {
        switch($source) {
            case 'visa':
                return 'Visa Process';
                break;
            case 'course':
                return 'Course Process';
                break;
            case 'expire_main':
                return 'Main Visa Expired';
                break;
            case 'expire_apply':
                return 'Apply Visa Expired';
                break;
            case 'dob':
                return 'Date of Birthday';
                break;
            default:
                return $source;
        }
    }

    function formatTitle($source, $data) {
        switch($source) {
            case 'expire_main':
            case 'expire_apply':
            case 'visa':
            case 'dob':
                return $data['client'];
                break;
            case 'course':
                return "{$data['client']} ({$data['school']})";
                break;
            default:
                return $source;
        }
    }
    
    function formatDescription($source, $data, $due_date) {
        switch($source) {
            case 'visa':
                return $data['visa'].' '.$data['subclass'].' '.$data['subject'];
                break;
            case 'expire_main':
            case 'expire_apply':    
                return $data['visa'].'-'.$data['subclass'].' expired on '.$due_date;
                break;
            case 'course':
                return "{$data['qual']} {$data['major']} {$data['qual']} {$data['subject']} ";
                break;
            case 'dob':
                return 'Birthday: '.$data['dob'];
                break;
            default:
                return $source;
        }
    }

    function formatOpenUrl($source, $source_id, $data) {
        switch($source) {
            case 'expire_main':
                return "/scripts/client_detail.php?cid={$data['cid']}";
                break;
            case 'expire_apply':
                return "/scripts/client_visa_detail.php?cid={$data['cid']}&vid={$data['vid']}";
                break;
            case 'visa':
                return "/scripts/client_visa_detail.php?cid={$data['cid']}&vid={$data['cvid']}";
                break;
            case 'course':
                return "/scripts/client_course_detail.php?cid={$data['cid']}&courseid={$data['ccid']}";
                break;
            case 'dob':
                return '#';
                break;
        }
        return '#';
    }

    function getUndoneList($userid,$src='',$limit=false) {
        $rtn = array();
        $sql = "SELECT *, IF(REMIND_TIME IS NOT NULL, REMIND_TIME, '9999-99-99 99:99:99') as alert FROM ".self::TBL. " WHERE STATUS <> '".self::STATUS_DONE."' AND (REMIND_TIME IS NULL OR REMIND_TIME < NOW()) ";
        if ($src != '')
            $sql .= " AND SOURCE = '{$src}' ";

        if ($userid > 0)
            $sql .= " AND USER_ID = '{$userid}' ";

        $sql .= " ORDER BY alert, due_date ";
        if ($limit) 
            $sql .= " LIMIT {$limit} ";
        $this->db->query($sql);
        while ($this->db->fetch()) {
            $json = json_decode($this->db->raw_data, true);
            array_push($rtn, array( 'due_date' => $this->db->due_date, 
                                    'begin_date' => $this->db->begin_date, 
                                    'source' => $this->formatSource($this->db->source), 
                                    'remind' => $this->db->remind_time, 
                                    'title' => $this->formatTitle($this->db->source, $json), 
                                    'descrption'=>$this->formatDescription($this->db->source, $json, $this->db->due_date), 
                                    'openurl'=> $this->formatOpenUrl($this->db->source, $this->db->source_id, $json),
                                    'id'=>$this->db->id
                                )
            );
        }
        return $rtn;
    }

    function getUndoneReport($userid) {
        $rtn = array();
        $sql = "SELECT SOURCE, COUNT(*) AS CNT FROM ".self::TBL. " WHERE STATUS <> '".self::STATUS_DONE."' AND user_id = {$userid} GROUP BY SOURCE";
        $this->db->query($sql);
        $a = 0;
        while ($this->db->fetch()) {
            $rtn[$this->db->SOURCE] = $this->db->CNT;
            $a += $this->db->CNT;
        }
        if ($a > 0)
            $rtn['ALL'] = $a;
        return $rtn;
    }

    function done($id) {
        if (!$id)
            return false;

        $sql = "UPDATE ".self::TBL." SET STATUS = '".self::STATUS_DONE."' WHERE ID = {$id}";
        return $this->db->query($sql);
    }

    function doneBySourceId($source, $id) {
        if (!$source || !$id)
            return false;

        $sql = "UPDATE ".self::TBL." SET STATUS = '".self::STATUS_DONE."' WHERE source = '{$source}' AND source_id = {$id}";
        return $this->db->query($sql);
    }

    
    function setDueDate($source, $id, $due_date) {
        if ($due_date == '0000-00-00')
            return false;

        $sql = "UPDATE ".self::TBL." SET DUE_DATE = '{$due_date}' WHERE source = '{$source}' AND source_id = {$id}";
        return $this->db->query($sql);
    }

    function remind($id, $delay_time){
        if (!$id)
            return false;

        $sql = "UPDATE ".self::TBL." SET STATUS = '".self::STATUS_DELAYED."', REMIND_TIME = '{$delay_time}' WHERE ID = {$id}";
        return $this->db->query($sql);
    }


}