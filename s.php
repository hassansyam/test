<?php include 'session.php'; ?>

<!DOCTYPE html>
<html>
  
	<head>
		<title>لوحة التحكم </title>
		<meta charset="UTF-8" />
		<link href="template.css" rel="stylesheet" type="text/css" />

	</head>
    <body>
    	<div class="headblock"> التحكم بالبرامج</div>
    	<?php

    	?>
    	<?php
    	####################################### delete
      	if($_REQUEST['action'] == 'delete'){
    		$getid = intval($_GET['id_pro']);
			if($getid){
    		$delete = mysql_query("delete from pro where id_pro=".$getid."");
				if($delete){
		    	echo'<div class="ok">تم حذف البرنامج بنجاح</div>';
				echo'<meta http-equiv="refresh" content="1; url=editp.php">';
			    exit;
				}
			}
    	}
    	
    	####################################### end delete
    	####################################### submit
    	 	if($_REQUEST['editpro']){
    		$_post_name_pro = $_POST['name_pro'];
    		$_post_img_pro = $_POST['img_pro'];  
    		$_post_info_pro = $_POST['info_pro'];
    		$_post_cat_pro = $_POST['cat_pro'];
    		$_post_sys_pro = $_POST['sys_pro'];
    		$_post_size_pro = $_POST['size_pro'];
    		$_post_site_pro = $_POST['site_pro'];
    		$_post_v_pro = $_POST['v_pro'];
    		$_post_d_pro = $_POST['d_pro'];
    		$_post_active_pro = $_POST['active_pro'];
			$_id_pro = $_POST['id_pro'];
			
			if(
			$_post_name_pro     == '' or 
			$_post_img_pro      == '' or 
			$_post_info_pro     == '' or 
			$_post_sys_pro      == '' or 
			$_post_size_pro     == '' or 
			$_post_v_pro        == '' or 
			$_post_d_pro        == '' 
			){
				echo'<div class="error"> الرجاء ادخال جميع الحقول</div>';
			}else{
				$update = mysql_query("update pro set 
				name_pro ='$_post_name_pro',
				img_pro ='$_post_img_pro',
				info_pro ='$_post_info_pro',
				cat_pro ='$_post_cat_pro',
				sys_pro ='$_post_sys_pro',
				size_pro ='$_post_size_pro',
				site_pro ='$_post_site_pro',
				v_pro ='$_post_v_pro',
				d_pro ='$_post_d_pro',
		        active_pro ='$_post_active_pro'
				 where id_pro='$_id_pro'") ;
				if($update){
				echo'<div class="ok">تم تعدي البرنامج</div>';
				echo'<meta http-equiv="refresh" content="1; url=editp.php">';
			exit;
				}
			}
			
    	}
		$sel = mysql_num_rows(mysql_query("select * from cat"));
		if($sel == 0){
		  echo'<div class="error">يجب اضافة قسم لمتابعة</div>';
			exit;
		}
    	#######################################end submit
    	####################################### edit
    	if($_REQUEST['action'] == 'edit'){
    	 $getid = intval($_GET['id_pro']);
		  if($getid)
		  {
				$select = mysql_query("select * from pro where id_pro=".$getid."");
				$row2 = mysql_fetch_array($select)
				?>
				   	<form method="post">
    		<table width="100%" dir="rtl">
    			<tr>
    				<td>عنوان البرنامج</td>
    				<td><input type="text" name="name_pro"  size="30" value="<?=$row2['name_pro'] ?>"/></td>
    			</tr>
    			
    			<tr>
    				<td>صورة البرنامج</td>
    				<td><input type="text" name="img_pro"  size="30" value="<?=$row2['img_pro'] ?>"/></td>
    			</tr>
    			
    			<tr>
    				<td>معلومات عن البرنامج</td>
    				<td>
    					<textarea cols="40" rows="3" name="info_pro" value=""><?=$row2['info_pro']?></textarea>
    				</td>
    			</tr>
    			
    			<tr>
    				<td>قسم البرنامج</td>
    				<td>
    					<select name="cat_pro">
   	<?
   	$cat = $row2['cat_pro'];
	$selectcat = mysql_query("select * from cat where id_cat='$cat'");
	$rowcat = mysql_fetch_array($selectcat);
	echo "<option value='".$rowcat['id_cat']."'>".$rowcat['name_cat']."</option>";
	
	$selectcat2 = mysql_query("select * from cat where id_cat!='$cat'");
	while($rowcat2 = mysql_fetch_array($selectcat2)){
		echo "<option value='".$rowcat2['id_cat']."'>".$rowcat2['name_cat']."</option>";
	}
   	?>
                        </select>	
    				</td>
    			</tr>
    			
    			<tr>
    				<td>نظام التشغيل</td>
    				<td><input type="text" name="sys_pro"  size="30" value="<?=$row2['sys_pro'] ?>"/></td>
    			</tr>
    			
    			
    			<tr>
    				<td>حجم البرنامج</td>
    				<td><input type="text" name="size_pro"  size="30" value="<?=$row2['size_pro']?>"/></td>
    			</tr>
    			
    			
    			<tr>
    				<td>موقع البرنامج</td>
    				<td><input type="text" name="site_pro"  size="30" value="<?=$row2['site_pro'] ?>"/></td>
    			</tr>
    			
    			<tr>
    				<td>اصدار البرنامج</td>
    				<td><input type="text" name="v_pro"  size="30" value="<?=$row2['v_pro'] ?>"/></td>
    			</tr>
    			
    			<tr>
    				<td>رابط تحميل البرنامج</td>
    				<td><input type="text" name="d_pro"  size="30" value="<?=$row2['d_pro'] ?>"/></td>
    			</tr>
    			
    	     	<tr>
    				<td>حالة البرنامج</td>
    				<td>
    					<select name="active_pro">
    						<?
    						if($row2['active_pro'] == 1)
    						{
    							echo"
    					    	<option value='1'>مفعل</option>
    							<option value='2'>غير مفعل</option>
    							";
    						}
    						else
    						{
    							echo"
    							<option value='2'>غير مفعل</option>
    							<option value='1'>مفعل</option>
    							";
    						}
    						?>
    						
    					</select>
    				</td>
    			</tr>
    			
    			<tr>
    				<input type="hidden" name="id_pro" value="<?=$row2['id_pro']?>" />
    				<td><input type="submit" name="editpro" value="اضافة برنامج"/></td>
    			</tr>
    			
    		</table>
    	</form>
				
				<?
				
				
				
		  }
		exit;}//////end request
    	
    	######################################### end edit
    	
    	$sql = mysql_query("select id_pro from pro");
		$num = @mysql_num_rows($sql);
		$n_pa = 2;
		$n_page = $num/$n_pa;
		$n_page = ceil($n_page);
		$page = intval($_REQUEST['page']);
		if(!$page){
			$page = 1;
		}else{
			$page = $page;
		}
		$start = $page - 1 ;
		$start = $start * $n_pa;
		$sql2 = mysql_query("select * from pro order by id_pro limit $start,$n_pa ");
		echo"
		<table width='100%' dir='rtl'>
		<tr>
		<td class='headtable' width='10%'>#</td>
		<td class='headtable' width='60%'>عنوان البرنامج</td>
		<td class='headtable' width='10%'>الحالة</td>
		<td class='headtable' width='10%'>تعديل</td>
		<td class='headtable' width='10%'>حدف</td>	
		</tr>
		</table>";
		while ($row = mysql_fetch_array($sql2)) {
			if($row['active_pro'] == 1){
    				$active_pro = "<span style='color:green'> مفعل</span>";
    		}else{
    				$active_pro = "<span style='color:red'> غير مفعل</span>";
    		}
		echo"
		<table width='100%' dir='rtl'>
		<tr>
		<td class='td1' width='10%'>".$row['id_pro']."</td>
		<td class='td2' width='60%'>".$row['name_pro']."</td>
		<td class='td1' width='10%'>".$active_pro."</td>
		<td class='td2' width='10%'>
		<a href='?action=edit&id_pro=".$row['id_pro']."'>تعديل</a>
		</td>
		<td class='td1' width='10%'>
			<a href='?action=delete&id_pro=".$row['id_pro']."'>حذف</a>
		</td>	
		</tr>
		</table>";
		}
		
		for($w = 1; $w <=$n_page; $w++)
		{
			if($page == $w )
			{
				echo "<span style='color:red;'>$w</span>";
			}
			else
			{
		    echo"<a href='?page=$w'> $w </a>";
			}
		}
    	?>
    </body>

</html>
