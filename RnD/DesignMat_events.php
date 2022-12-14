<?php
//BindEvents Method @1-9E8C1348
function BindEvents()
{
    global $tbldesignmatGrid;
    global $Panel1;
    global $CCSEvents;
    $tbldesignmatGrid->tbldesignmat_tblsupplier1_TotalRecords->CCSEvents["BeforeShow"] = "tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow";
    $tbldesignmatGrid->SupDesc->CCSEvents["BeforeShow"] = "tbldesignmatGrid_SupDesc_BeforeShow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow @18-803D91AE
function tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow(& $sender)
{
    $tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbldesignmatGrid; //Compatibility
//End tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow

//Retrieve number of records @19-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow @18-BCB9FB66
    return $tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow;
}
//End Close tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow

//tbldesignmatGrid_SupDesc_BeforeShow @93-2E5E3613
function tbldesignmatGrid_SupDesc_BeforeShow(& $sender)
{
    $tbldesignmatGrid_SupDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbldesignmatGrid; //Compatibility
//End tbldesignmatGrid_SupDesc_BeforeShow

//Custom Code @94-2A29BDB7
	global $tbldesignmatGrid;
	global $DBgayafusionall;
	$SupID = $tbldesignmatGrid->SupCompany->GetValue();
	$tbldesignmatGrid->SupDesc->SetValue(CCDLookUp("SupCompany","tblSupplier","ID = $SupID",$DBgayafusionall));
//End Custom Code

//Close tbldesignmatGrid_SupDesc_BeforeShow @93-212CC952
    return $tbldesignmatGrid_SupDesc_BeforeShow;
}
//End Close tbldesignmatGrid_SupDesc_BeforeShow

//Panel1_BeforeShow @47-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @85-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @47-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-CE49F3CC
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DesignMat; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @85-B4F71FC5
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-CFFD2B10
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DesignMat; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-743F0324
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DesignMat; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @85-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-22D9555A
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DesignMat; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @85-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-01BE209D
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DesignMat; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @85-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload
?>
