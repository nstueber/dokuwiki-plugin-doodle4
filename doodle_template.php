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
?>

<!-- Doodle Plugin -->
<div class="doodle3_scrollcontainer">
<form action="<?php echo wl() ?>" method="post" name="doodle__form" id="<?php echo $template['formId'] ?>" accept-charset="utf-8" >

<input type="hidden" name="sectok" value="<?php echo getSecurityToken() ?>" />
<input type="hidden" name="do" value="show" >
<input type="hidden" name="id" value="<?php echo $ID ?>" >
<input type="hidden" name="formId" value="<?php echo $template['formId'] ?>" >
<input type="hidden" name="edit__entry"   value="">
<input type="hidden" name="delete__entry" value="">


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
           <?php echo $userData['editLinks'].$fullname.$userData['username'] ?>
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


</form>
</div>
