<?php
class DropDown
{
	public static function render($name, $items, $selected_key = '', $extra = '', $show_select_message = true)
	{
		?>
        <select name="<?=$name?>" id="<?php echo $name?>" <?php echo $extra?>>
	    <?php 
        if ($show_select_message != false) { ?>
        	<?php if ($show_select_message === true) { ?>
    	    	<option value="">Seleccione</option>
            <?php } else { ?>
    	    	<option value=""><?=$show_select_message?></option>
            <?php } ?>
    		<?php 
			
        }
        foreach($items as $item) { ?>
        	<option value="<?php echo $item->get_key()?>" <?php echo $item->get_key()===$selected_key?'selected':''?>>
	        <?php echo $item->get_value()?></option>
		    <?php 
        } ?>
        </select>	
    	<?php 
	}


	public static function render_multiple($name, $items, $selected_keys = array(), $size = 6, $extra = '')
	{
		?>
        <select style="display:none;" id="<?php echo $name?>" multiple="multiple" name="<?php echo $name?>[]" size="<?php echo $size?>" <?php echo $extra?>>
	    <?php 
        foreach($items as $item) {
			$selected = false;
			foreach ($selected_keys as $selected_key)
			{
				if ($item->get_key() == $selected_key->get_key())
				{
					$selected = true;
					break;
				}
			}
			?>
        	<option value="<?php echo $item->get_key()?>" <?php echo $selected?'selected':''?>><?php echo $item->get_value()?></option>
		    <?php 
        } ?>
        </select>	
        
        
        <div>
        
			<?php 
			$i = 0;
            foreach($items as $item) {
                $selected = false;
                foreach ($selected_keys as $selected_key)
                {
                    if ($item->get_key() == $selected_key->get_key())
                    {
                        $selected = true;
                        break;
                    }
                }
                ?>
              
                
                <input type="checkbox" id="multicheck_<?=$name.'_'.$i?>" value="<?=$i?>" onclick="javascript:var o=document.getElementById('<?php echo $name?>'); o.options[<?php echo $i?>].selected = this.checked;" <?=$selected ? 'checked' : ''?> />
                <?php echo $item->get_value(); ?> 
                <div class="fix"></div>
                
                <?php 
				$i++;
            } 
            ?>
        </div>
        <?php
		
	}

	public static function render_multiple_especial($name, $items, $selected_keys = array(), $extra = '')
	{
		?>
        <select   multiple="multiple" name="<?php echo $name?>" <?php echo $extra?>>
	    <?php 
		
		
		
        foreach($items as $item) {
			$selected = false;
			foreach ($selected_keys as $selected_key)
			{
				if ($item->get_key() == $selected_key->get_key())
				{
					$selected = true;
					break;
}
			}
			?>
        	<option value="<?php echo $item->get_key()?>" <?php echo $selected?'selected':''?>><?php echo $item->get_value()?></option>
		    <?php 
        } ?>
        </select>	
 <?php }
        
} ?>

