<?php
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'RnD',$lang);


if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}

//Include Common Files @1-B0251269
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "TexturePopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbltextureSearch { //tbltextureSearch Class @2-9ABD6149

//Variables @2-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @2-E325BB73
    function clsRecordtbltextureSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbltextureSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbltextureSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_TextureCode = new clsControl(ccsTextBox, "s_TextureCode", "s_TextureCode", ccsText, "", CCGetRequestParam("s_TextureCode", $Method, NULL), $this);
            $this->s_TextureDescription = new clsControl(ccsTextBox, "s_TextureDescription", "s_TextureDescription", ccsText, "", CCGetRequestParam("s_TextureDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-91B180E3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_TextureCode->Validate() && $Validation);
        $Validation = ($this->s_TextureDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_TextureCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_TextureDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-F138F0ED
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_TextureCode->Errors->Count());
        $errors = ($errors || $this->s_TextureDescription->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @2-73F774ED
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "TexturePopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "TexturePopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_TextureCode", "s_TextureDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-5C091D29
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_TextureCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_TextureDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_TextureCode->Show();
        $this->s_TextureDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tbltextureSearch Class @2-FCB6E20C

class clsGridtbltexture { //tbltexture class @6-E94E1606

//Variables @6-F895C378

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_TextureCode;
    public $Sorter_TextureDescription;
//End Variables

//Class_Initialize Event @6-E66F40F2
    function clsGridtbltexture($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tbltexture";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tbltexture";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstbltextureDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("tbltextureOrder", "");
        $this->SorterDirection = CCGetParam("tbltextureDir", "");

        $this->TextureCode = new clsControl(ccsLabel, "TextureCode", "TextureCode", ccsText, "", CCGetRequestParam("TextureCode", ccsGet, NULL), $this);
        $this->TextureDescription = new clsControl(ccsLink, "TextureDescription", "TextureDescription", ccsText, "", CCGetRequestParam("TextureDescription", ccsGet, NULL), $this);
        $this->TextureDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->TextureDescription->Page = "";
        $this->TexturePhoto1 = new clsControl(ccsImage, "TexturePhoto1", "TexturePhoto1", ccsText, "", CCGetRequestParam("TexturePhoto1", ccsGet, NULL), $this);
        $this->TextureID = new clsControl(ccsHidden, "TextureID", "TextureID", ccsText, "", CCGetRequestParam("TextureID", ccsGet, NULL), $this);
        $this->tbltexture_TotalRecords = new clsControl(ccsLabel, "tbltexture_TotalRecords", "tbltexture_TotalRecords", ccsText, "", CCGetRequestParam("tbltexture_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_TextureCode = new clsSorter($this->ComponentName, "Sorter_TextureCode", $FileName, $this);
        $this->Sorter_TextureDescription = new clsSorter($this->ComponentName, "Sorter_TextureDescription", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @6-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @6-C21C598A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_TextureCode"] = CCGetFromGet("s_TextureCode", NULL);
        $this->DataSource->Parameters["urls_TextureDescription"] = CCGetFromGet("s_TextureDescription", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["TextureCode"] = $this->TextureCode->Visible;
            $this->ControlsVisible["TextureDescription"] = $this->TextureDescription->Visible;
            $this->ControlsVisible["TexturePhoto1"] = $this->TexturePhoto1->Visible;
            $this->ControlsVisible["TextureID"] = $this->TextureID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->TextureCode->SetValue($this->DataSource->TextureCode->GetValue());
                $this->TextureDescription->SetValue($this->DataSource->TextureDescription->GetValue());
                $this->TexturePhoto1->SetValue($this->DataSource->TexturePhoto1->GetValue());
                $this->TextureID->SetValue($this->DataSource->TextureID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->TextureCode->Show();
                $this->TextureDescription->Show();
                $this->TexturePhoto1->Show();
                $this->TextureID->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->tbltexture_TotalRecords->Show();
        $this->Sorter_TextureCode->Show();
        $this->Sorter_TextureDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-497BBEE6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->TextureCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TexturePhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tbltexture Class @6-FCB6E20C

class clstbltextureDataSource extends clsDBgayafusionall {  //tbltextureDataSource Class @6-FDAEB799

//DataSource Variables @6-7C5FB612
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $TextureCode;
    public $TextureDescription;
    public $TexturePhoto1;
    public $TextureID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-16C5DBD6
    function clstbltextureDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tbltexture";
        $this->Initialize();
        $this->TextureCode = new clsField("TextureCode", ccsText, "");
        
        $this->TextureDescription = new clsField("TextureDescription", ccsText, "");
        
        $this->TexturePhoto1 = new clsField("TexturePhoto1", ccsText, "");
        
        $this->TextureID = new clsField("TextureID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-8C4E0C32
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_TextureCode" => array("TextureCode", ""), 
            "Sorter_TextureDescription" => array("TextureDescription", "")));
    }
//End SetOrder Method

//Prepare Method @6-E0C0D5F2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_TextureCode", ccsText, "", "", $this->Parameters["urls_TextureCode"], "", false);
        $this->wp->AddParameter("2", "urls_TextureDescription", ccsText, "", "", $this->Parameters["urls_TextureDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "TextureCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "TextureDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-EC3A5406
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbltexture";
        $this->SQL = "SELECT ID, TextureCode, TextureDescription, TexturePhoto1 \n\n" .
        "FROM tbltexture {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-7206EDCB
    function SetValues()
    {
        $this->TextureCode->SetDBValue($this->f("TextureCode"));
        $this->TextureDescription->SetDBValue($this->f("TextureDescription"));
        $this->TexturePhoto1->SetDBValue($this->f("TexturePhoto1"));
        $this->TextureID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End tbltextureDataSource Class @6-FCB6E20C

//Initialize Page @1-A135CF9E
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "TexturePopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C71F36D5
include_once("./TexturePopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-432658B8
$DBgayafusionall = new clsDBgayafusionall();
$MainPage->Connections["gayafusionall"] = & $DBgayafusionall;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbltextureSearch = new clsRecordtbltextureSearch("", $MainPage);
$tbltexture = new clsGridtbltexture("", $MainPage);
$MainPage->tbltextureSearch = & $tbltextureSearch;
$MainPage->tbltexture = & $tbltexture;
$tbltexture->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-4BE163CB
$tbltextureSearch->Operation();
//End Execute Components

//Go to destination page @1-08FEC9E9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBgayafusionall->close();
    header("Location: " . $Redirect);
    unset($tbltextureSearch);
    unset($tbltexture);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E31DD67E
$tbltextureSearch->Show();
$tbltexture->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-02CBA108
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBgayafusionall->close();
unset($tbltextureSearch);
unset($tbltexture);
unset($Tpl);
//End Unload Page


?>
