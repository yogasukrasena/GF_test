<?php
//BindEvents Method @1-F605E622
function BindEvents()
{
    global $tblcollect_master;
    $tblcollect_master->CCSEvents["BeforeUpdate"] = "tblcollect_master_BeforeUpdate";
}
//End BindEvents Method

//tblcollect_master_BeforeUpdate @2-32CF570F
function tblcollect_master_BeforeUpdate(& $sender)
{
    $tblcollect_master_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblcollect_master; //Compatibility
//End tblcollect_master_BeforeUpdate

//Custom Code @9-2A29BDB7
$db = new clsDBgayafusionall();
$id = $Container->ID->GetValue();
$LastUpdate = $Container->LastUpdate->GetValue();
$db->query("UPDATE SampleCeramic SET LastUpdate = ".$db->ToSQL($LastUpdate,ccsDate)." WHERE sID = ".$db->ToSQL($id,ccsInteger));
$db->close();
//End Custom Code

//Close tblcollect_master_BeforeUpdate @2-996E2AD0
    return $tblcollect_master_BeforeUpdate;
}
//End Close tblcollect_master_BeforeUpdate


?>
