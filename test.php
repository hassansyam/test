<?php
include 'inc/header.php';
?>
  	<table width="100%" border="0" dir="rtl" cellpadding="5" cellspacing="4">
			
			<tr>
				<td width="20%" valign="top">
					<? block(1) ?>
				</td>
				<td width="60%" valign="top">
					<?
					
					$gid = intval($_GET['id_cat']);
					$t2 = "";
					if(!$gid){
					            $t1 ="تنبيه" ;
						    	$t2 .= "<div class='error'>الصفحة المطلوبة غير موجودة</div>";
								block_des($t1,$t2);
					}else{
						$sql1 = mysql_query("select id_cat,name_cat,active_cat from 
						cat where id_cat='$gid'");
						$num1 = mysql_num_rows($sql1) ;
						if($num1 == '' or $num1 == 0  ){
						        $t1 ="تنبيه" ;
						    	$t2 .= "<div class='error'>الصفحة المطلوبة غير موجودة</div>";
								block_des($t1,$t2);
							
						}else{
							$row1 = @mysql_fetch_array($sql1);
							if($t1 =$row1['active_cat'] == 2 ){
								$t1 ="تنبيه" ;
								$t2 .= "<div class='error'>الصفحة المطلوبة غير موجودة</div>";
								block_des($t1,$t2);
							}else{
								///////الاقسام الفرعية
									
								///////نهاية الاقسام الفرعية
						  $t1 =$row1['name_cat'] ;
	                   	  $sql = mysql_query("select * from pro where cat_pro='$gid' and active_pro='1'");
						  $numpro = mysql_num_rows($sql);
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
							if($page > $n_page){
								echo'<meta http-equiv="refresh" content="1; url=index.php">';
							}
	                    	$start = $page - 1 ;
	                      	$start = $start * $n_pa;
	                     	$sqlpro = mysql_query("select * from pro where cat_pro='$gid' and active_pro='1'
	                     	 order by id_pro desc limit $start,$n_pa ");
							while($rowsqlpro = mysql_fetch_array($sqlpro)){
								echo $rowsqlpro['name_pro'] ;
							}
							$t2 .="<br />";
							
							for($w = 1; $w <=$n_page; $w++)
		                    {
		                   	if($page == $w )
		                  	{
				                $t2 .= "<span style='color:red;'>$w</span>";
		                   	}
			                else
			                {
		                        $t2 .="<a href='viewcat.php?id_cat=$gid&page=$w'> $w </a>";
			                }
		                    }
							 
							//$t2 .= "";
			        		block_des($t1,$t2);
						}
						}
					}///////end else
					
					?>					
				</td>
				<td width="20%" valign="top">
					<? block(3) ?>
				</td>
			</tr>
			<tr>
			</tr>
		</table>
<?php
include 'inc/footer.php';
?>
