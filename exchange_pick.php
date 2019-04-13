<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
include 'koneksi.php';
mysql_select_db('gdb0101');
echo "<td colspan='3'  height='330' width='100%'>
<table border='0' width='100%'><td align='center'>Item Exchange</td><tr></table>";
?>
<script>
$(document).ready(function(e){
	$(".imgcheck").click(function(){
		$(this).toggleClass("check");
	});
});
	
function asd(id){
	var username = $("#nick").val();//Get the value in the username textbox
	//var username = document.getElementById('iduser');
	$.ajax({  //Make the Ajax Request
		type: "GET",  
		url: "getitem.php",  //file name
		data: "iduserr="+ username + "&iditem="+id,  //data
		success: function(server_response){  
		document.getElementById('myModal').style.display = "block";
		var att = $("#item").attr("data-content");
		//$att.html(server_response);
		
		$("#asu").html(server_response);
		} 
	}); 
};
</script>

<style>
.check
{
    //opacity:0.5;
	background-color:aqua;
	
}

.hidden {
	display : none;
}

.imgcheck{
	width:32px;
	height:32px;
}

* {
	font-family: GulimChe, serif;
}
/* The Modal (background) 
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
*/

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 20%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
table, th, td, tr {
	padding : 0px 2.5px 0px 0px;
}
td {
	padding-bottom : 3.5px;
}

</style>

<form action='' method='POST'>
<center>Pengecekan Bank dari ID User : <br><input type=text name=nick>
<input type='submit' value='Go!' class='buttonbig' name='hehe'></center>
</form>
<?php
function get_value_of($name)
{
     $lines = file('data.txt');
     foreach (array_values($lines) AS $line)
     {
          //list($key, $val) = explode(':', trim($line) );
		  list($key, $val) = array_pad(explode(':', trim($line), 2), 2, null);
          if (trim($key) == $name)
          {
                return $val;
          }
     }
     return false;
} 
function get_ico_of($name)
{
     $lines = file('data2.txt');
     foreach (array_values($lines) AS $line)
     {
          //list($key, $val) = explode(':', trim($line) );
		  list($key, $val, $ico) = array_pad(explode('|', trim($line), 3), 3, null);
          if ((trim($key) == $name) && (trim($key) != 0))
          {
                return $ico;
          }
     }
     return false;
} 
if(isset($_POST['nick'])){
$nick=$_POST['nick'];
echo "<center><font color=#ff0000 size=4><b>".$nick."</b></font></center>";
$sqlcekinven = "select * from store where user_id='$nick'";
$querycekinven = mysql_query($sqlcekinven)or mysql_error();
if(!mysql_num_rows($querycekinven)=="0"){
?>
<div align="center">
<form action='' method='POST'>
<table border=1>
	<tr>
		<td>Item 1</td><td>Item 2</td><td>Hasil</td>
	</tr>
	<tr>
		<td><input type=text name=item1></td>
		<td><input type=text name=item2></td>
		<td><input type=text name=hasil></td>
	</tr>
</table>
<input type='hidden' name='nick' value='<?php echo $nick;?>'>
<input type='submit' value='Check!' class='buttonbig' name='hehe2'></center>
</form>
</div>
<?php
if(isset($_POST['hehe2'])){
	$i1 = $_POST['item1'];
	$i2 = $_POST['item2'];
	$hs = $_POST['hasil'];
	$row = mysql_fetch_array($querycekinven);
	
	//pake array aja
	$ketemu1=false;
	$ketemu2=false;
	for($i=0;$i<80;$i++){
		$it="it".$i;
		$io="io".$i;
		$ioo="ioo".$i;
		if($row[$it]==$i1){
			$ketemu1=true;
			for($i=0;$i<80;$i++){
				$it="it".$i;
				$io="io".$i;
				$ioo="ioo".$i;
				if($row[$it]==$i2){
					$ketemu2=true;
					break;
				}
			}
			break;
		}
	}
	if(!$ketemu1)
		echo "<center>Penukaran gagal karena item1 tidak ditemukan</center>";
	else if(!$ketemu2)
		echo "<center>Penukaran gagal karena item2 tidak ditemukan</center>";
	else if(!$ketemu1 && !$ketemu2)
		echo "<center>Penukaran gagal karena kedua item tidak ditemukan</center>";
	else if($ketemu1 && $ketemu2){	
	?>
		<center><font color=#ff0000 size=4><b>Pilih itemnya</b></font></center>
		<div style=" position:absolute; left:38%; height:603.6px; width:312px; background-size: 312px 603.6px; background-image:url('bg_store.jpg'); background-repeat: no-repeat; padding: 42px 0px 0px 2px;" >
		<form action='' method='POST'>
			<?php
			echo "<table border='0' style='border-spacing: 3px; padding:0px; font-size: 15px;'>";
			//$row = mysql_fetch_array($querycekinven);
			$i = 0;
			for($y=0;$y<10;$y++){
				echo "<tr align='center'>";
				for($x=0;$x<8;$x++){
					$it="it".$i;		
					$io="io".$i;
					$ioo="ioo".$i;
					if($row[$it]=="0"){
						//$color="background='item.png'";
						echo "<td height='34' width='33'><!--b><small>$i</small></b--></td>";
					}else{
						if($row[$it]==$i1 || $row[$it]==$i2){
							$attr = "";
							$clas = "imgcheck";
						}else {
							$attr = "filter: grayscale(100%);";
							$clas = "";
						}
						//$color="bgcolor=red";
							echo "	<td height='34' width='33' >
										<b><small>
										<label>
											<img id='item' title='$i' class='$clas' style='$attr' 
											onmouseover='asd($i)' alt='".$i."' src='ico/".get_ico_of($row[$it]).".png'>
											<input type='checkbox' name='item[]' value='$i' class='hidden' autocomplete='off'>
										</label>
										</small></b>
									</td>";
					}
					
					$i++;
				}
				echo "</tr>";
			}
			?>
			<!--td height="2" colspan="4"><input type="submit" value="Edit Bank!" class="button" style="margin-left: auto; padding: 10px; margin-top: 10px; margin-right: auto; text-align: center; position: relative;"></td-->
			</table>
			<input type='hidden' name='nick' id='nick' value='<?php echo $nick;?>'>
			<input type='hidden' name='i1' id='i1' value='<?php echo $i1;?>'>
			<input type='hidden' name='i2' id='i2' value='<?php echo $i2;?>'>
			<input type='hidden' name='hs' id='hs' value='<?php echo $hs;?>'>
			<input type='submit' value='Exchange!' class='buttonbig' name='hehe3'>
		</form>
		</div>
		<div id="myModal" class="modal">
		<div class="modal-content">
			<span onclick="closex()" class="close">&times;</span>
			<div id="asu">	
			</div>
		  </div>
		</div>
		<?php
	}else{
		echo "Error[4]. Hubungi admin!";
	}
}
if((isset($_POST['hehe3'])) && (!empty($_POST['item']))){
		$sqlcekinven = "select * from store where user_id='$nick'";
		$querycekinven = mysql_query($sqlcekinven)or mysql_error();
		$row = mysql_fetch_array($querycekinven);
		$i1 = $_POST['i1'];
		$i2 = $_POST['i2'];
		$hs = $_POST['hs'];
		for($i=79;$i>=0;$i--){
			$it="it".$i;
			$io="io".$i;
			$ioo="ioo".$i;
			if($row[$it]==0){
				$no3 = $i;
				break;
			}
		}
		$h = 0;
		//echo count($_POST['item'])."|";
		foreach(array_pad(((array)$_POST['item']),2,null) as $selected){
		//	echo $selected."|".$h."|".$row["it".$selected]."<br>";
			$no[$h] = $selected ;
			$h++;
		}
		echo "<div align='center' style='color=ff0000;'>";
		if(($row["it".$no[0]] == $i1 && $row["it".$no[1]] == $i2) || (("it".$row[$no[0]] == $i2 && $row["it".$no[1]] == $i1))){
			$sqlect = " update store set it".$no[0]."='0', it".$no[1]."='0' where user_id='$nick'";
			$quelect = mysql_query($sqlect)or mysql_error($sqlect);
			if($quelect){
				$sqlect = " update store set it".$no3."='$hs' where user_id='$nick'";
				$quelect2 = mysql_query($sqlect)or mysql_error($sqlect);
				if($quelect2){
					echo "Penukaran berhasil!";
				}else{
					echo "Error[2]. Hubungi admin!";
				}
			}else
				echo "Error[1]. Hubungi admin!";
		}else{
			echo "Error[3]. Item tidak sesuai!";
		}
		echo "</div>";
		header('refresh:5;url=exchange_pick.php');
}
 } } 
?>