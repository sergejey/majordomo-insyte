<?php
/**
 * Insyte
 * @package project
 * @author Wizard <sergejey@gmail.com>
 * @copyright http://majordomo.smartliving.ru/ (c)
 * @version 0.1 (wizard, 13:07:39 [Jul 13, 2018])
 */
//
//
class insytedevices extends module
{

    var $modbus;

    /**
     * insytedevices
     *
     * Module class constructor
     *
     * @access private
     */
    function __construct()
    {
        $this->name = "insytedevices";
        $this->title = "Insyte";
        $this->module_category = "<#LANG_SECTION_DEVICES#>";
        $this->checkInstalled();
        $this->getConfig();
        require(DIR_MODULES . $this->name . '/structure.inc.php');
    }

    /**
     * saveParams
     *
     * Saving module parameters
     *
     * @access public
     */
    function saveParams($data = 1)
    {
        $p = array();
        if (IsSet($this->id)) {
            $p["id"] = $this->id;
        }
        if (IsSet($this->view_mode)) {
            $p["view_mode"] = $this->view_mode;
        }
        if (IsSet($this->edit_mode)) {
            $p["edit_mode"] = $this->edit_mode;
        }
        if (IsSet($this->data_source)) {
            $p["data_source"] = $this->data_source;
        }
        if (IsSet($this->tab)) {
            $p["tab"] = $this->tab;
        }
        return parent::saveParams($p);
    }

    /**
     * getParams
     *
     * Getting module parameters from query string
     *
     * @access public
     */
    function getParams()
    {
        global $id;
        global $mode;
        global $view_mode;
        global $edit_mode;
        global $data_source;
        global $tab;
        if (isset($id)) {
            $this->id = $id;
        }
        if (isset($mode)) {
            $this->mode = $mode;
        }
        if (isset($view_mode)) {
            $this->view_mode = $view_mode;
        }
        if (isset($edit_mode)) {
            $this->edit_mode = $edit_mode;
        }
        if (isset($data_source)) {
            $this->data_source = $data_source;
        }
        if (isset($tab)) {
            $this->tab = $tab;
        }
    }

    /**
     * Run
     *
     * Description
     *
     * @access public
     */
    function run()
    {
        global $session;
        $out = array();
        if ($this->action == 'admin') {
            $this->admin($out);
        } else {
            $this->usual($out);
        }
        if (IsSet($this->owner->action)) {
            $out['PARENT_ACTION'] = $this->owner->action;
        }
        if (IsSet($this->owner->name)) {
            $out['PARENT_NAME'] = $this->owner->name;
        }
        $out['VIEW_MODE'] = $this->view_mode;
        $out['EDIT_MODE'] = $this->edit_mode;
        $out['MODE'] = $this->mode;
        $out['ACTION'] = $this->action;
        $out['DATA_SOURCE'] = $this->data_source;
        $out['TAB'] = $this->tab;
        $this->data = $out;
        $p = new parser(DIR_TEMPLATES . $this->name . "/" . $this->name . ".html", $this->data, $this);
        $this->result = $p->result;
    }

    /**
     * BackEnd
     *
     * Module backend
     *
     * @access public
     */
    function admin(&$out)
    {
        $out['API_URL'] = $this->config['API_URL'];
        $out['API_PORT'] = $this->config['API_PORT'];
        if ($this->view_mode == 'update_settings') {
            $this->config['API_URL'] = gr('api_url');
            $this->config['API_PORT'] = gr('api_port');
            $this->saveConfig();
            $this->redirect("?");
        }
        if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
            $out['SET_DATASOURCE'] = 1;
        }
        if ($this->data_source == 'insytedevices' || $this->data_source == '') {
            if ($this->view_mode == '' || $this->view_mode == 'search_insytedevices') {
                $this->search_insytedevices($out);
            }
            if ($this->view_mode == 'edit_insytedevices') {
                $this->edit_insytedevices($out, $this->id);
            }
            if ($this->view_mode == 'delete_insytedevices') {
                $this->delete_insytedevices($this->id);
                $this->redirect("?data_source=insytedevices");
            }
        }
        if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
            $out['SET_DATASOURCE'] = 1;
        }
        if ($this->data_source == 'insytecommands') {
            if ($this->view_mode == '' || $this->view_mode == 'search_insytecommands') {
                $this->search_insytecommands($out);
            }
            if ($this->view_mode == 'edit_insytecommands') {
                $this->edit_insytecommands($out, $this->id);
            }
        }
    }

    /**
     * FrontEnd
     *
     * Module frontend
     *
     * @access public
     */
    function usual(&$out)
    {
        $this->admin($out);
    }

    /**
     * insytedevices search
     *
     * @access public
     */
    function search_insytedevices(&$out)
    {
        require(DIR_MODULES . $this->name . '/insytedevices_search.inc.php');
    }

    /**
     * insytedevices edit/add
     *
     * @access public
     */
    function edit_insytedevices(&$out, $id)
    {
        require(DIR_MODULES . $this->name . '/insytedevices_edit.inc.php');
    }

    /**
     * insytedevices delete record
     *
     * @access public
     */
    function delete_insytedevices($id)
    {
        $rec = SQLSelectOne("SELECT * FROM insytedevices WHERE ID='$id'");
        // some action for related tables
        SQLExec("DELETE FROM insytedevices WHERE ID='" . $rec['ID'] . "'");
    }

    /**
     * insytecommands search
     *
     * @access public
     */
    function search_insytecommands(&$out)
    {
        require(DIR_MODULES . $this->name . '/insytecommands_search.inc.php');
    }

    /**
     * insytecommands edit/add
     *
     * @access public
     */
    function edit_insytecommands(&$out, $id)
    {
        require(DIR_MODULES . $this->name . '/insytecommands_edit.inc.php');
    }

    function propertySetHandle($object, $property, $value)
    {
        $this->getConfig();
        $properties = SQLSelect("SELECT * FROM insytecommands WHERE LINKED_OBJECT LIKE '" . DBSafe($object) . "' AND LINKED_PROPERTY LIKE '" . DBSafe($property) . "'");
        $total = count($properties);
        if ($total) {
            for ($i = 0; $i < $total; $i++) {
                //to-do
                $device_record=SQLSelectOne("SELECT * FROM insytedevices WHERE ID=".$properties[$i]['DEVICE_ID']);
                $this->writeDeviceCommand($device_record,$properties[$i],$value);
            }
        }
    }

    function modbus_connect()
    {
        if (!$this->config['API_URL']) return false;
        require_once dirname(__FILE__) . '/modbus/ModbusMaster.php';
        try {
            $this->modbus = new ModbusMaster($this->config['API_URL'], 'TCP');
            $port = $this->config['API_PORT'];
            if ($port) {
                $this->modbus->port = $port;
            }
        } catch (Exception $e) {
            DebMes('Error connecting to '.$this->config['API_URL'].':'.$this->config['API_PORT'],'insyte');
        }
        //dprint($this->modbus);
    }

    function readDeviceCommand($device_rec, $command_rec)
    {
        if (!is_object($this->modbus)) {
            $this->modbus_connect();
        }

        $command = $this->device_types[$device_rec['DEVICE_TYPE']]['commands'][$command_rec['TITLE']];
        if (is_array($command)) {
            $request_type = 'FC' . $command['fread'];
            $recData = array();
            if (!$command['count']) {
                $command['count'] = 1;
            }
            $modbus_address=$command['address']-1;
            //dprint($command,false);
            if ($request_type == 'FC1') {
                try {
                 $recData = $this->modbus->readCoils($device_rec['ADDRESS'], $modbus_address, $command['count']);
                } catch (Exception $e) {
                    //todo: error processing
                }
                if (is_array($recData)) {
                    foreach($recData as $k=>$v)
                        $recData[$k]=(int)$v;
                }
            } elseif ($request_type == 'FC2') {
                try {
                    $recData = $this->modbus->readInputDiscretes($device_rec['ADDRESS'], $modbus_address, $command['count']);
                } catch (Exception $e) {
                    //todo: error processing
                }
                if (is_array($recData)) {
                    foreach ($recData as $k => $v)
                        $recData[$k] = (int)$v;
                }
            } elseif ($request_type == 'FC3') {
                //dprint('reading multiple registers from device '.$device_rec['ADDRESS'].' address '.$modbus_address.' count: '.$command['count'],false);
                try {
                    $recData = $this->modbus->readMultipleRegisters($device_rec['ADDRESS'], $modbus_address, $command['count']);
                } catch (Exception $e) {
                    //todo: error processing
                }
            }
            //dprint($recData,false);
            $raw_data = implode(',', $recData);
            $command_rec['VALUE_RAW'] = $raw_data;


            if ($command['response_convert'] == 'r2f') {
                //REAL to Float
                $values = array_chunk($recData, 4);
                $recData = array();
                foreach ($values as $bytes) echo $recData[] = PhpType::bytes2float($bytes, false);
            } elseif ($command['response_convert'] == 'r2fs') {
                //REAL to Float (swap regs)
                $values = array_chunk($recData, 4);
                $recData = array();
                foreach ($values as $bytes) echo $recData[] = PhpType::bytes2float($bytes, true);
            } elseif ($command['response_convert'] == 'd2i') {
                //DINT to integer
                $values = array_chunk($recData, 4);
                $recData = array();
                foreach ($values as $bytes) echo $recData[] = PhpType::bytes2signedInt($bytes, false);
            } elseif ($command['response_convert'] == 'd2is') {
                //DINT to integer (swap regs)
                $values = array_chunk($recData, 4);
                $recData = array();
                foreach ($values as $bytes) echo $recData[] = PhpType::bytes2signedInt($bytes, true);
            } elseif ($command['response_convert'] == 'dw2i') {
                //DWORD to integer
                $values = array_chunk($recData, 4);
                $recData = array();
                foreach ($values as $bytes) $recData[] = PhpType::bytes2unsignedInt($bytes, false);
            } elseif ($command['response_convert'] == 'dw2is') {
                //DWORD to integer (swap regs)
                $values = array_chunk($recData, 4);
                $recData = array();
                foreach ($values as $bytes) $recData[] = PhpType::bytes2unsignedInt($bytes, true);
            } elseif ($command['response_convert'] == 'i2i') {
                //INT to integer
                $values = array_chunk($recData, 2);
                $recData = array();
                foreach ($values as $bytes) $recData[] = PhpType::bytes2signedInt($bytes, false);
            } elseif ($command['response_convert'] == 'w2i') {
                //WORD to integer
                $values = array_chunk($recData, 2);
                $recData = array();
                foreach ($values as $bytes) $recData[] = PhpType::bytes2unsignedInt($bytes, false);
            } elseif ($command['response_convert'] == 's') {
                //String
                $recData = array(PhpType::bytes2string($recData));
            } else {
                //
            }
            $result = implode(',', $recData);
            $command_rec['VALUE'] = $result;
            $command_rec['UPDATED']=date('Y-m-d H:i:s');
            SQLUpdate('insytecommands', $command_rec);

            if ($command_rec['LINKED_OBJECT'] && $command_rec['LINKED_PROPERTY']) {
                setGlobal($command_rec['LINKED_OBJECT'].'.'.$command_rec['LINKED_PROPERTY'], $command_rec['VALUE'], array($this->name=>'0')); //
            }
            if ($command_rec['LINKED_OBJECT'] && $command_rec['LINKED_METHOD']) {
                $params=array();
                $params['VALUE']=$command_rec['VALUE'];
                callMethod($command_rec['LINKED_OBJECT'].'.'.$command_rec['LINKED_METHOD'], $params);
            }

        }

    }

    function writeDeviceCommand($device_rec, $command_rec, $value)
    {
        if (!$this->modbus) {
            $this->modbus_connect();
        }
        //dprint("writing ".json_encode($command_rec).' new value: '.$value,false);
        $command = $this->device_types[$device_rec['DEVICE_TYPE']]['commands'][$command_rec['TITLE']];
        if (is_array($command)) {
            $request_type = 'FC' . $command['fwrite'];
            $recData = array();
            if (!$command['count']) {
                $command['count'] = 1;
            }
            $modbus_address = $command['address'] - 1;
            if ($request_type=='FC5') {
                if ((int)$value) {
                    $data_set=array(TRUE);
                } else {
                    $data_set=array(FALSE);
                }
                try {
                    $recData = $this->modbus->writeSingleCoil($device_rec['ADDRESS'], $modbus_address, $data_set);
                } catch (Exception $e) {
                    //todo: error processing
                }
            }
            if ($request_type=='FC6') {
                $data_set=array($value);
                if ($command['response_convert']=='r2f') {
                    $dataTypes = array("REAL");
                    $swapregs = false;
                } elseif ($command['response_convert']=='r2fs') {
                    $dataTypes = array("REAL");
                    $swapregs = true;
                } elseif ($command['response_convert']=='d2i' || $command['response_convert']=='dw2i') {
                    $dataTypes = array("DINT");
                    $swapregs = false;
                } elseif ($command['response_convert']=='d2is' || $command['response_convert']=='dw2is') {
                    $dataTypes = array("DINT");
                    $swapregs = true;
                } else {
                    $dataTypes = array("INT");
                    $swapregs = false;
                }
                try {
                    $recData = $this->modbus->writeSingleRegister($device_rec['ADDRESS'], $modbus_address, $data_set, $dataTypes, $swapregs);
                } catch (Exception $e) {
                    //todo: error processing
                }
            }
            if ($request_type=='FC15') {
                $data_set=array($value);
                foreach($data_set as $k=>$v) {
                    $data_set[$k]=(bool)$v;
                }
                try {
                    $recData = $this->modbus->writeMultipleCoils($device_rec['ADDRESS'], $modbus_address, $data_set);
                } catch (Exception $e) {
                    //todo: error processing
                }
            }
            if ($request_type=='FC16') {
                $data_set=array($value);
                $dataTypes=array();
                $swapregs = false;
                foreach($data_set as $k=>$v) {
                    if ($command['response_convert']=='r2f') {
                        $dataTypes[] = "REAL";
                        $data_set[$k]=(float)$v;
                        $swapregs = false;
                    } elseif ($command['response_convert']=='r2fs') {
                        $dataTypes[] = "REAL";
                        $data_set[$k]=(float)$v;
                        $swapregs = true;
                    } elseif ($command['response_convert']=='d2i' || $command['response_convert']=='dw2i') {
                        $dataTypes[] = "DINT";
                        $data_set[$k]=(int)$v;
                        $swapregs = false;
                    } elseif ($command['response_convert']=='d2is' || $command['response_convert']=='dw2is') {
                        $dataTypes[] = "DINT";
                        $data_set[$k]=(int)$v;
                        $swapregs = true;
                    } else {
                        $data_set[$k]=(int)$v;
                        $dataTypes[] = "INT";
                        $swapregs = false;
                    }
                }
                try {
                    $recData = $this->modbus->writeMultipleRegister($device_rec['ADDRESS'], $modbus_address, $data_set, $dataTypes, $swapregs);
                } catch (Exception $e) {
                    //todo: error processing
                }
            }
        }
    }

    function refreshDevice($device_id, $include_config = true)
    {
        $rec = SQLSelectOne("SELECT * FROM insytedevices WHERE ID=" . (int)$device_id);
        if (!$rec['ID']) {
            return;
        }

        $commands = $this->device_types[$rec['DEVICE_TYPE']]['commands'];
        if (is_array($commands)) {
            foreach ($commands as $k => $v) {
                if (preg_match('/^_config/',$k) && !$include_config) continue;
                $command_rec = SQLSelectOne("SELECT * FROM insytecommands WHERE DEVICE_ID=" . $rec['ID'] . " AND TITLE LIKE '" . $k . "'");
                if (!$command_rec['ID']) {
                    $command_rec['DEVICE_ID'] = $rec['ID'];
                    $command_rec['TITLE'] = $k;
                    $command_rec['ID']=SQLInsert('insytecommands', $command_rec);
                }
                $this->readDeviceCommand($rec, $command_rec);
            }
        }

    }

    function processCycle()
    {
        $this->getConfig();
        //to-do
        $devices=SQLSelect("SELECT * FROM insytedevices WHERE NEXT_POLL<NOW()");
        $total=count($devices);
        for($i=0;$i<$total;$i++) {
            $period=$devices[$i]['POLL_PERIOD'];
            if (!$period) $period=5*60;
            $devices[$i]['NEXT_POLL']=date('Y-m-d H:i:s',time()+$period);
            SQLUpdate('insytedevices',$devices[$i]);
            $this->refreshDevice($devices[$i]['ID']);
        }
    }

    /**
     * Install
     *
     * Module installation routine
     *
     * @access private
     */
    function install($data = '')
    {
        parent::install();
    }

    /**
     * Uninstall
     *
     * Module uninstall routine
     *
     * @access public
     */
    function uninstall()
    {
        SQLExec('DROP TABLE IF EXISTS insytedevices');
        SQLExec('DROP TABLE IF EXISTS insytecommands');
        parent::uninstall();
    }

    /**
     * dbInstall
     *
     * Database installation routine
     *
     * @access private
     */
    function dbInstall($data)
    {
        /*
        insytedevices -
        insytecommands -
        */
        $data = <<<EOD
 insytedevices: ID int(10) unsigned NOT NULL auto_increment
 insytedevices: TITLE varchar(100) NOT NULL DEFAULT ''
 insytedevices: DEVICE_TYPE varchar(255) NOT NULL DEFAULT '' 
 insytedevices: ADDRESS varchar(255) NOT NULL DEFAULT ''
 insytedevices: POLL_PERIOD int(10) NOT NULL DEFAULT '0'
 insytedevices: NEXT_POLL datetime
 
 insytecommands: ID int(10) unsigned NOT NULL auto_increment
 insytecommands: TITLE varchar(100) NOT NULL DEFAULT ''
 insytecommands: VALUE varchar(255) NOT NULL DEFAULT ''
 insytecommands: VALUE_RAW varchar(255) NOT NULL DEFAULT ''
 insytecommands: DEVICE_ID int(10) NOT NULL DEFAULT '0'
 insytecommands: LINKED_OBJECT varchar(100) NOT NULL DEFAULT ''
 insytecommands: LINKED_PROPERTY varchar(100) NOT NULL DEFAULT ''
 insytecommands: LINKED_METHOD varchar(100) NOT NULL DEFAULT ''
 insytecommands: UPDATED datetime
EOD;
        parent::dbInstall($data);
    }
// --------------------------------------------------------------------
}
/*
*
* TW9kdWxlIGNyZWF0ZWQgSnVsIDEzLCAyMDE4IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
