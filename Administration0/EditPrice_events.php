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

//Custom Code @16-2A29BDB7
global $DBGayaFusionAll;
$id = $tblcollect_master->ID->GetValue();
$LastUpdate = $tblcollect_master->LastUpdate->GetValue();
$DBGayaFusionAll->query("UPDATE tblCollect_master SET LastUpdate = ".$DBGayaFusionAll->ToSQL($LastUpdate,ccsDate)." WHERE ID = ".$DBGayaFusionAll->ToSQL($id,ccsInteger));
//End Custom Code

//Close tblcollect_master_BeforeUpdate @2-996E2AD0
    return $tblcollect_master_BeforeUpdate;
}
//End Close tblcollect_master_BeforeUpdate


?>