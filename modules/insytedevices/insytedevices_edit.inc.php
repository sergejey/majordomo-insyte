<?php
/*
* @version 0.1 (wizard)
*/
  if ($this->owner->name=='panel') {
   $out['CONTROLPANEL']=1;
  }
  $table_name='insytedevices';
  $rec=SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");

  if ($this->tab=='data' && gr('refresh')) {
      $this->refreshDevice($rec['ID']);
      $this->redirect("?view_mode=".$this->view_mode."&id=".$rec['ID']."&tab=".$this->tab);
  }

  if ($this->mode=='update') {
   $ok=1;
  // step: default
  if ($this->tab=='') {
  //updating '<%LANG_TITLE%>' (varchar, required)
   $rec['TITLE']=gr('title');
   if ($rec['TITLE']=='') {
    $out['ERR_TITLE']=1;
    $ok=0;
   }

      $rec['POLL_PERIOD']=gr('poll_period','int');
      if ($rec['POLL_PERIOD']>0) {
          $rec['NEXT_POLL']=date('Y-m-d H:i:s',time()+$rec['POLL_PERIOD']);
      } else {
          $rec['NEXT_POLL']=date('Y-m-d H:i:s',time()+5*60);
      }

   $rec['DEVICE_TYPE']=gr('device_type');
      if (!$rec['DEVICE_TYPE']) {
          $ok=0;
          $out['ERR_DEVICE_TYPE']=1;
      }

  //updating 'ADDRESS' (varchar)
   $rec['ADDRESS']=gr('address');
  }
  // step: data
  if ($this->tab=='data') {
  }
  //UPDATING RECORD
   if ($ok) {
    if ($rec['ID']) {
     SQLUpdate($table_name, $rec); // update
    } else {
     $new_rec=1;
     $rec['ID']=SQLInsert($table_name, $rec); // adding new record
    }
    $out['OK']=1;
    if ($new_rec) {
        $this->redirect("?id=".$rec['ID']."&view_mode=".$this->view_mode."&tab=data&refresh=1");
    }
   } else {
    $out['ERR']=1;
   }
  }
  // step: default
  if ($this->tab=='') {
  }
  // step: data
  if ($this->tab=='data') {
  }
  if ($this->tab=='data') {
   //dataset2
   $new_id=0;
   global $delete_id;
   if ($delete_id) {
    SQLExec("DELETE FROM insytecommands WHERE ID='".(int)$delete_id."'");
   }
   $properties=SQLSelect("SELECT * FROM insytecommands WHERE DEVICE_ID='".$rec['ID']."' ORDER BY ID");
   $total=count($properties);
   $to_set=array();
   for($i=0;$i<$total;$i++) {
    if ($properties[$i]['ID']==$new_id) continue;
    if ($this->mode=='update') {
      global ${'linked_object'.$properties[$i]['ID']};
      $properties[$i]['LINKED_OBJECT']=trim(${'linked_object'.$properties[$i]['ID']});
      global ${'linked_property'.$properties[$i]['ID']};
      $properties[$i]['LINKED_PROPERTY']=trim(${'linked_property'.$properties[$i]['ID']});
      global ${'linked_method'.$properties[$i]['ID']};
      $properties[$i]['LINKED_METHOD']=trim(${'linked_method'.$properties[$i]['ID']});
      SQLUpdate('insytecommands', $properties[$i]);
      $old_linked_object=$properties[$i]['LINKED_OBJECT'];
      $old_linked_property=$properties[$i]['LINKED_PROPERTY'];
      if ($old_linked_object && $old_linked_object!=$properties[$i]['LINKED_OBJECT'] && $old_linked_property && $old_linked_property!=$properties[$i]['LINKED_PROPERTY']) {
       removeLinkedProperty($old_linked_object, $old_linked_property, $this->name);
      }
      global ${'set'.$properties[$i]['ID']};
        if (${'set'.$properties[$i]['ID']}!='') {
            $to_set[$properties[$i]['ID']]=${'set'.$properties[$i]['ID']};
        }
     }

       if ($properties[$i]['LINKED_OBJECT'] && $properties[$i]['LINKED_PROPERTY']) {
           addLinkedProperty($properties[$i]['LINKED_OBJECT'], $properties[$i]['LINKED_PROPERTY'], $this->name);
       }
       $command = $this->device_types[$rec['DEVICE_TYPE']]['commands'][$properties[$i]['TITLE']];
       if ($command['sdevice']) {
           $properties[$i]['SDEVICE_TYPE']=$command['sdevice'];
       }
       if ($command['fwrite']) {
           $properties[$i]['CANSET']=1;
       }

   }
   $out['PROPERTIES']=$properties;

      if (count($to_set)>0) {
          foreach($to_set as $k=>$v) {
              $property=SQLSelectOne("SELECT * FROM insytecommands WHERE DEVICE_ID=".$rec['ID']." AND ID=".$k);
              $this->writeDeviceCommand($rec,$property,$v);
          }
          $this->redirect("?view_mode=".$this->view_mode."&id=".$rec['ID']."&tab=".$this->tab."&refresh=1");
      }

  }
  if (is_array($rec)) {
   foreach($rec as $k=>$v) {
    if (!is_array($v)) {
     $rec[$k]=htmlspecialchars($v);
    }
   }
  }
  outHash($rec, $out);

foreach($this->device_types as $k=>$v) {
    $out['DEVICE_TYPES'][]=array('NAME'=>$k,'TITLE'=>$v['TITLE']);
}