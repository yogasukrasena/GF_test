<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>

<html>
<head>
<SCRIPT LANGUAGE="JavaScript" src="calendar.js"></SCRIPT>
<title>ADD SAMPLE</title></head>
<link rel="stylesheet" type="text/css" href="../Includes/Style.css">
<body>
<script language="JavaScript">
var Nav4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) == 4))

var dialogWin = new Object()

function openDialog(url, width, height, returnFunc, args) {
	if (!dialogWin.win || (dialogWin.win && dialogWin.win.closed)) {
		dialogWin.returnFunc = returnFunc
		dialogWin.returnedValue_c_col_id = ""
		dialogWin.args = args
		dialogWin.url = url
		dialogWin.width = width
		dialogWin.height = height
		dialogWin.name = (new Date()).getSeconds().toString()

		if (Nav4) {
			dialogWin.left = window.screenX + 
			   ((window.outerWidth - dialogWin.width) / 2)
			dialogWin.top = window.screenY + 
			   ((window.outerHeight - dialogWin.height) / 2)
			var attr = "screenX=" + dialogWin.left + 
			   ",screenY=" + dialogWin.top + ",resizable=no,width=" + 
			   dialogWin.width + ",height=" + dialogWin.height
		} else {
			dialogWin.left = (screen.width - dialogWin.width) / 2
			dialogWin.top = (screen.height - dialogWin.height) / 2
			var attr = "left=" + dialogWin.left + ",top=" + 
			   dialogWin.top + ",resizable=no,width=" + dialogWin.width + 
			   ",height=" + dialogWin.height
		}
		
		dialogWin.win=window.open(dialogWin.url, dialogWin.name, attr)
		dialogWin.win.focus()
	} else {
		dialogWin.win.focus()
	}
}
</script>

  <table width="765" border="0" cellpadding="3" cellspacing="0">
    <tr>
		<td width="74%" height="39" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
      	<td width="26%" height="39" align="center" class="TopContentTitleRight">Sample Packaging </td>
    </tr>
    <tr>
      	<td colspan="2">&nbsp;</td>
    </tr>
	<tr>
      	<td colspan="2"><p>&nbsp;</p>
		<?php
			error_reporting(0);
			$id=$_GET['id'];
			$result = mysql_query("SELECT * FROM SamplePackaging WHERE ID = $id");
			$alldata = mysql_fetch_array($result);
			//$DmCode = $alldata['
			//$ResultDesMat = mysql_query("SELECT * FROM tblDesMaterial WHERE DmCode
		?>
		<FORM enctype="multipart/form-data" name="SampPackagingForm" method="POST" action="EditSampPackaging.php" >
			<table class="InLineFormTABLE" width="850" border="0" cellspacing="0" cellpadding="3">
  				<tr>
    				<td class="InLineDataTD" width="127">Code</td>
    				<td class="InLineDataTD" colspan="5"><?php echo $alldata['SampleCode'] ?></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Description</td>
    				<td class="InLineDataTD" colspan="5"><?php echo $alldata['Description'] ?></td>
  				</tr>
  				<tr>
  				<tr>
    				<td class="InLineDataTD">Date</td>
    				<td class="InLineDataTD" colspan="5"><input type="text" name="DateField" value="<?php echo $alldata['SampleDate']; ?>" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(SampPackagingForm.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></A> </td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Technical Draw </td>
    				<td class="InLineDataTD" colspan="5">
						<?php 
							if (empty($alldata['TechDraw'])){
								echo "<input type=\"file\" name=\"TechDraw\" value=\"\" />&nbsp;(600 x 750)";
							}
							else{
								echo substr($alldata['TechDraw'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelTechDraw\" value=\"$alldata[TechDraw]\" /> ";
							}
						?>
					</td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Photo 01 </td>
    				<td class="InLineDataTD" colspan="5">
						<?php 
							if (empty($alldata['Photo1'])){
								echo "<input type=\"file\" name=\"Photo1\" value=\"\" />&nbsp;(200 x 200)";
							}
							else{
								echo substr($alldata['Photo1'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto1\" value=\"$alldata[Photo1]\" /> ";
							}
						?>	
					</td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Photo 02 </td>
    				<td class="InLineDataTD" colspan="5">
						<?php 
							if (empty($alldata['Photo2'])){
								echo "<input type=\"file\" name=\"Photo2\" value=\"\" />&nbsp;(200 x 200)";
							}
							else{
								echo substr($alldata['Photo2'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto2\" value=\"$alldata[Photo2]\" /> ";
							}
						?>
					</td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Photo 03 </td>
    				<td class="InLineDataTD" colspan="5">
						<?php 
							if (empty($alldata['Photo3'])){
								echo "<input type=\"file\" name=\"Photo3\" value=\"\" />&nbsp;(200 x 200)";
							}
							else{
								echo substr($alldata['Photo3'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto3\" value=\"$alldata[Photo3]\" /> ";
							}
						?>
					</td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Photo 04 </td>
    				<td class="InLineDataTD" colspan="5">
						<?php 
							if (empty($alldata['Photo4'])){
								echo "<input type=\"file\" name=\"Photo4\" value=\"\" />&nbsp;(200 x 200)";
							}
							else{
								echo substr($alldata['Photo4'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto4\" value=\"$alldata[Photo4]\" /> ";
							}
						?>
					</td>
  				</tr>
  				<tr><!-- disini, suda pake inner join dengan tbldesmat -->
    				<td class="InLineDataTD" colspan="6"><strong>List of Design Material </strong></td>
  				</tr>
  				<tr>
  					<td class="InLineDataTD" colspan="6">
						<table width="850" border="0" cellpadding="0" cellspacing="0">
							<tr>
    							<th class="InLineDataTD" width="187" align="center">Design Material </th>
    							<th class="InLineDataTD" width="187" align="center">Supplier</th>
    							<th class="InLineDataTD" width="110" align="center">Qty</th>
    							<th class="InLineDataTD" width="110" align="center">Unit</th>
    							<th class="InLineDataTD" width="110" align="center">Unit Price </th>
    							<th class="InLineDataTD" width="110" align="center">Total</th>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="DesMat1" value="<?php echo $alldata['DesMat1']?>" />
									<?php
    									If (empty($alldata['DesMat1'])){
    										echo "<a href=\"DesMatPopup.php\">Add";
    									}
    								?>
								</td>
    							<td class="InLineDataTD" align="center"><?php echo"supplier1" ?></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="qty1" size="15" /></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitsup1"?></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitpricesup1" ?></td>
    							<td class="InLineDataTD" align="center"><?php echo"hasilkasi" ?></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="DesMat2" value="<?php echo $alldata['DesMat2']?>" />
									<?php
    									If (empty($alldata['DesMat2'])){
    										echo "<a href=\"DesMatPopup.php\">Add";
    									}
    								?>   							  </td>
    							<td class="InLineDataTD" align="center"><?php echo"sup2"?></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="qty2" size="15" /></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitsup2"?></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitpricesup2" ?></td>
    							<td class="InLineDataTD" align="center"><?php echo"hasilkasi" ?></td>
  							</tr>
		  					<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="DesMat3" value="<?php echo $alldata['DesMat3']?>" />
									<?php
    									If (empty($alldata['DesMat3'])){
    										echo "<a href=\"DesMatPopup.php\">Add";
    									}
    								?>   							  </td>
    							<td class="InLineDataTD" align="center"><?php echo"sup3"?></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="qty3" size="15" /></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitsup3"?></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitpricesup3" ?></td>
    							<td class="InLineDataTD" align="center"><?php echo"hasilkasi" ?></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="DesMat4" value="<?php echo $alldata['DesMat4']?>" />
									<?php
    									If (empty($alldata['DesMat4'])){
    										echo "<a href=\"DesMatPopup.php\">Add";
    									}
    								?>   							  </td>
    							<td class="InLineDataTD" align="center"><?php echo"sup4"?></td>
    							<td class="InLineDataTD" align="center"><input type="text" name="qty4" size="15" /></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitsup4"?></td>
    							<td class="InLineDataTD" align="center"><?php echo"unitpricesup4" ?></td>
    							<td class="InLineDataTD" align="center"><?php echo"hasilkasi" ?></td>
  							</tr>
    						<tr>
    							<td>
    								<input type="text" name="DesMat5" value="<?php echo $alldata['DesMat5']?>" />
									<?php
    									If (empty($alldata['DesMat5'])){
    										echo "<a href=\"DesMatPopup.php\">Add";
    									}
    								?>   							  </td>
    							<td align="center"><?php echo"sup5"?></td>
    							<td align="center"><input type="text" name="qty5" size="15" /></td>
    							<td align="center"><?php echo"unitsup5"?></td>
    							<td align="center"><?php echo"unitpricesup5" ?></td>
    							<td align="center"><?php echo"hasilkasi" ?></td>
  							</tr>
						</table>
					</td>
  				<tr>
    				<td class="InLineDataTD" colspan="6"><strong>List of Work Supplier </strong></td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD" colspan="6">
						<table width="850" border="0" cellpadding="1" cellspacing="0">
							<tr>
								<th class="InLineDataTD" width="194" align="center">Supplier</th>
    							<th class="InLineDataTD" colspan="2" align="center">Material</th>
    							<th class="InLineDataTD" colspan="2" align="center">Color</th>
    							<th class="InLineDataTD" width="185" align="center">Cost Price </th>
							</tr>
							<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="Supplier1" value="<?php echo $alldata['Supplier1']?>" />
							  		<?php
    									If (empty($alldata['Supplier1'])){
    										echo "<a href=\"SupplierPopup.php\">Add";
    									}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material1" value="<?php echo $alldata['Material1'] ?>" /></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color1" value="<?php echo $alldata['Color1']?>" /></td>
    							<td align="center" class="InLineDataTD"><input name="CostPrice1" value="<?php echo $alldata['CostPrice1']?>" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="Supplier2" value="<?php echo $alldata['Supplier2']?>" />
							  		<?php
    									If (empty($alldata['Supplier2'])){
    										echo "<a href=\"SupplierPopup.php\">Add";
    									}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material2" value="<?php echo $alldata['Material2'] ?>"/></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color2" value="<?php echo $alldata['Color2']?>" /></td>
    							<td align="center" class="InLineDataTD"><input name="CostPrice2" value="<?php echo $alldata['CostPrice2']?>" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="Supplier3" value="<?php echo $alldata['Supplier3']?>" />
							  		<?php
    									If (empty($alldata['Supplier3'])){
    										echo "<a href=\"SupplierPopup.php\">Add";
    									}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material3" value="<?php echo $alldata['Material3'] ?>"/></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color3" value="<?php echo $alldata['Color3']?>" /></td>
    							<td align="center" class="InLineDataTD"><input name="CostPrice3" value="<?php echo $alldata['CostPrice3']?>" /></td>
  							</tr>
  							<tr>
    							<td class="InLineDataTD">
    								<input type="text" name="Supplier4" value="<?php echo $alldata['Supplier4']?>" />
							  		<?php
    									If (empty($alldata['Supplier4'])){
    										echo "<a href=\"SupplierPopup.php\">Add";
    									}
    								?>
							  </td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Material4" value="<?php echo $alldata['Material4'] ?>" /></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color4" value="<?php echo $alldata['Color4']?>" /></td>
    							<td align="center" class="InLineDataTD"><input name="CostPrice4" value="<?php echo $alldata['CostPrice4']?>" /></td>
  							</tr>
  							<tr>
    							<td >
    								<input type="text" name="Supplier5" value="<?php echo $alldata['Supplier5']?>" />
							  <?php
    									If (empty($alldata['Supplier5'])){
    										echo "<a href=\"SupplierPopup.php\">Add";
    									}
    								?>
							  </td>
    							<td colspan="2" align="center"><input name="Material5" value="<?php echo $alldata['Material5'] ?>" /></td>
    							<td colspan="2" align="center" class="InLineDataTD"><input name="Color5" value="<?php echo $alldata['Color5']?>" /></td>
    							<td align="center" class="InLineDataTD"><input name="CostPrice5" value="<?php echo $alldata['CostPrice5']?>" /></td>
  							</tr>
						</table>
					</td>
  				</tr>
 	 			<tr>
    				<td class="InLineDataTD">Inner Quantity</td>
    				<td class="InLineDataTD" colspan="4">
						<input type="text" name="InnerQty" value="<?php echo $alldata['InnerQty']; ?>" size="10" />
					</td>
  				</tr>
  				<tr>
    				<td class="InLineDataTD">Final size </td>
    				<td width="175" class="InLineDataTD">
						?=<input type="text" name="Diameter" value="<?php echo $alldata['Diameter']; ?>" size="15" />
					</td>
    				<td width="177" class="InLineDataTD">
						W=<input type="text" name="Width" value="<?php echo $alldata['Width']; ?>" size="15" />
					</td>
    				<td width="164" class="InLineDataTD">
						L=<input type="text" name="Length" value="<?php echo $alldata['Length']; ?>" size="15" />
					</td>
    				<td width="183" class="InLineDataTD">
						H=<input type="text" name="Height" value="<?php echo $alldata['Height']; ?>" size="12" />
					</td>
  				</tr>
  				<tr>
  					<td class="InLineDataTD">Weight</td>
					<td class="InLineDataTD" colspan="5">
						<input type="text" name="Weight" value="<?php echo $alldata['Weight']; ?>" size="15" />
					</td>
  				</tr>	
  				<tr>
    				<td class="InLineDataTD">Notes</td>
    				<td class="InLineDataTD" colspan="4">
						<textarea name="Notes" cols="50" rows="5"><?php echo $alldata['Notes']; ?></textarea>
					</td>
  				</tr>
  				<tr>
    				<td class="InLineFooterTD" colspan="5" align="center">
						<input type="hidden" name="tabel" value="SamplePackaging">
						<input type="hidden" value="<?php echo $alldata['ID']; ?>" name="ID">
						<input type="submit" name="submit" value="SUBMIT" size="30" />&nbsp;
						<a href="javascript:history.back();"><input type="reset" name="cancel" value="CANCEL" size="30" /></a>
					</td>
  				</tr>
			</table>
		</form>
		</td>
	</tr>
</table>
</body>
</html>
