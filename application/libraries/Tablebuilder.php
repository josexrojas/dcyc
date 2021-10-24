<?php
require_once(dirname(__FILE__).'/Listbuilder.php');


class TableBuilder extends ListBuilder
{
	private $num_cols = '';
	private $current_col = 0;
	protected $table_class = '';
	private $rowodd_class = '';
	private $roweven_class = '';
	private $item_class = '';

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		parent::initialize($params);
		
		if (count($params) <= 0)
			return;
			
		foreach ($params as $key => $val)
		{
			if (isset($this->$key))
				$this->$key = $val;
		}
	}

	
	public function render_header()
	{
		$output = '';
		
		$output.= '<table class="'.$this->table_class.'">';
		$output.= '<thead><tr>';
		$output.= parent::render_header();
		$output.= '</tr></thead>';
		
		return $output;
	}
	
	public function render_body()
	{
		$output = '';
		$this->current_col = 0;
		
		$output.= '<tbody class="'.$this->item_class.'">';
		$output.= parent::render_body();
		$output.= '</tbody>';
		
		return $output;
	}
		
	public function render_footer()
	{
		$output = '';
		$output.= '</table>';
		$output.= parent::render_footer();
		
		return $output;
	}
	
	public function render_preitem($item)
	{
		$output = '';
		
		if ($this->current_col % 2)
			$output.= '<tr class="'.$this->rowodd_class.'">';
		else
			$output.= '<tr class="'.$this->roweven_class.'">';
			
		return $output;
	}
	
	public function render_item($item)
	{
		$output = '';
		$output.= $this->render_preitem($item);
		
		$outputitem = parent::render_item($item);		
		if ($outputitem != '')
			$output.= $outputitem;
		else
			$output.= "<td>".print_r($item, true)."</td>";
			
		$output.= $this->render_postitem($item);
		
		return $output;
	}
	
	public function render_postitem($item)
	{
		$output = '';
		$output.= '</tr>';

		$this->current_col++;
		
		return $output;
	}	
	
}