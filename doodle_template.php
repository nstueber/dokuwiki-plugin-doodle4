<?php
  /**
   * This is the HTML template for the doodle table.
   *
   * I am utilizing the PHP parser as a templating engine:
   * doodle_tempalte.php is simply included and evaled from syntax.php
   * The variable  $template   will be inherited from syntax.php and can be used here.
   */
  global $ID;

  $template = $this->template;
  $c = count($template['choices']);
  $c1 = count($template['doodleData']);
?>

<!-- Doodle Plugin -->
<div class="doodle4_scrollcontainer">
<form action="<?php echo wl() ?>" method="post" name="doodle__form" id="<?php echo $template['formId'] ?>" accept-charset="utf-8" >

<input type="hidden" name="sectok" value="<?php echo getSecurityToken() ?>" />
<input type="hidden" name="do" value="show" >
<input type="hidden" name="id" value="<?php echo $ID ?>" >
<input type="hidden" name="formId" value="<?php echo $template['formId'] ?>" >
<input type="hidden" name="edit__entry"   value="">
<input type="hidden" name="delete__entry" value="">

<?php
//check UserList vertical or horizontal  
if ($template['userlist'] == 'vertical'){ 
//vertical	
?>

 <table class="inline">
   <tbody>
     <tr class="row0">
       <th class="centeralign" colspan="<?php echo ($c+1) ?>">
         <?php echo $template['title'] ?>
       </th>
     </tr>
     <tr class="row1">
         <th class="col0"><?php echo $lang['fullname'] ?></th>
<?php foreach ($template['choices'] as $choice) {  ?>
         <td class="centeralign" style="width:<?php echo $template['fieldwidth'] ?>"><?php echo $choice ?></td>
<?php } ?>
     </tr>

<?php foreach ($template['doodleData'] as $fullname => $userData) { ?>
     <tr>
         <td class="rightalign"> 
           <?php
		if ($template['printName'] == 'both'){
			echo $userData['editLinks'].$fullname.' ('.$userData['username'].')'; 
		} elseif ($template['printName'] == 'fullname'){
			 echo $userData['editLinks'].$fullname;
		}elseif ($template['printName'] == 'username'){
			echo $userData['editLinks'].$userData['username']; 
		} 
	?>
         </td>
         <?php for ($col = 0; $col < $c; $col++) {
             echo $userData['choice'][$col];
         } ?>        
     </tr>
<?php } ?>
 
<!-- Results / sum per column -->
	 <?php 
		if ($template['showSum']){
				echo ' <th class="rightalign"><b>';
				echo $template['result'];
				echo '</b></th>';
				for ($col = 0; $col < $c; $col++) {
					echo '<th class="centeralign"><b>';
					echo $template['count'][$col];
					echo '</b></th>';
				}
		}
	 ?>

<?php
     /* Input fields, if allowed. */
 	echo $template['inputTR'] 
?>

<?php if (!empty($template['msg'])) { ?>    
     <tr>
       <td colspan="<?php echo $c+1 ?>">
         <?php echo $template['msg'] ?>
       </td>
     </tr>
<?php } ?>

   </tbody>
 </table>

<?php	
}
else
{
	
//horizontal
/* Input fields, if allowed. */
$trArray = preg_split('[<tr>]', $template['inputTR']);
foreach ($trArray as $tr){
	$trA = $trA . $tr;
}
$trArray = preg_split('[</td>]', $trA);
$i1 = 0;
$trArrayUser = array();
foreach ($trArray as $tr){
	$trArrayUser[$i1] = $tr . '</td>';;
	$i1 = $i1 + 1;; 
}
$trArray = preg_split('[</TD>]', $trArrayUser[1]);
$i1 = 0;
$trArrayCheck = array();
foreach ($trArray as $tr){
	$trArrayCheck[$i1] = $tr . '</td>';
	$i1 = $i1 + 1;
}
 ?>
 <table class="inline">
   <tbody>
     <tr class="row0">
       <th class="centeralign" colspan="<?php echo ($c1+3) ?>">
         <?php echo $template['title'] ?>
       </th>
     </tr>

     <tr class="row1">
	 <!--edit lang for first column-->
         <th class="col0"><?php echo '' ?>
		 </th>
          <?php $durchlauf = 1; $userZahl = 0; $checkbox = 0;
          foreach ($template['choices'] as $choice) {     
	         if($durchlauf == 1){        
                foreach ($template['doodleData'] as $fullname => $userData) { ?>
                 <td class="centeralign" style="width:<?php echo $template['fieldwidth'] ?>">
			 
			 
                 <?php
		if ($template['printName'] == 'both'){
			echo $userData['editLinks'].$fullname.' ('.$userData['username'].')'; 
		} elseif ($template['printName'] == 'fullname'){
			 echo $userData['editLinks'].$fullname;
		}elseif ($template['printName'] == 'username'){
			echo $userData['editLinks'].$userData['username']; 
		} 
		?>				  
                 
	     
	     
	     
	     
	     </td>	   
 <?php 
		            for ($col = 0; $col < $c; $col++) {
                     $userAuswahl[$userZahl][$col] = $userData['choice'][$col];
                    }
		        $userZahl++;      
		        }
	            $userZahl = 0; 
				//Username for Vote
	            echo $trArrayUser[0];  
               // Results   	 
		        if ($template['showSum']){
				  echo ' <th class="rightalign"><b>';
				  echo $template['result'];
				  echo '</b></th>';				
		       }
		   }
 ?>		 	 			 
	 </tr> 
        <?php
        $durchlauf = 2;
	    if($durchlauf > 1){?>
	<tr>
	    <td class="rightalign" ><?php echo $choice ?>
		</td> 	   
	  <?php for ($col = 0; $col < $c1 ; $col++) {
			 //Userchoices
             echo $userAuswahl[$col][$userZahl];
            }     
		    //User Input if allowed
		    echo $trArrayCheck[$checkbox];		 
		    // Results / sum per row -->
		    if ($template['showSum']){
		
					echo '<th class="centeralign"><b>';
					echo $template['count'][$checkbox];
					echo '</b></th>';		
		    }   
		    $checkbox = $checkbox + 1;
		      ?>	
    </tr>
 <?php  } 
        $userZahl++;      
      }?>
<?php
     /* Input fields, if allowed. */
 //	Vote Button 
 echo $trArrayCheck[count($trArrayCheck) -1];
?>
<?php if (!empty($template['msg'])) { ?>    
     <tr>
       <td colspan="<?php echo $c+1 ?>">
         <?php echo $template['msg'] ?>
       </td>
     </tr>
<?php } ?>
   </tbody>
 </table>

<?php
}
?>	

</form>
</div>
