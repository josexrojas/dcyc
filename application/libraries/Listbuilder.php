<?
class Listbuilder
{
	private $type;
	protected $field = 0;
	protected $dbresult;
	private $arrayresult;
	private $arrayindex;
	protected $current_page = 1;
	protected $page_size = 200;
	protected $base_url = '';
	protected $item_view = '';
	protected $item_function = '';
	protected $header_view = '';
	protected $header_function = '';
	protected $render_msj = true;
	private $_pagination_output;
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct($params = array())
	{
		$this->initialize($params);
	}
	
	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) <= 0)
			return; 
			
		foreach ($params as $key => $val)
		{
			if (isset($this->$key))
				$this->$key = $val;
		
		}

		if (isset($params['data_from_array']))
			$this->set_data_from_array($params['data_from_array']);

		if (isset($params['data_from_dbresult']))
			$this->set_data_from_dbresult($params['data_from_dbresult']);
			
		
	}
	
	public function render()
	{
		$output = '';
		
		$CI =& get_instance();
		$CI->load->library('pagination');

		if ($CI->input->post('export'))
			$this->page_size = 1000000;

		$params = array();
		if ($this->type == 1)
			$params['total_rows'] = count($this->arrayresult);
		else
		$params['total_rows'] = $this->dbresult->num_rows();
		$params['per_page'] = $this->page_size;
		$params['base_url'] = $this->base_url;
		$params['first_link'] = "<<";
		$params['prev_link'] = FALSE;
		$params['next_link'] = FALSE;
		$params['last_link'] = ">>";
		$params['num_links'] = 2;
		$params['uri_segment'] = 1000;
		$params['cur_page'] = (int)$CI->uri->rsegment('page', 0);
		$params['last_tag_open'] = '<li>';
		$params['last_tag_close'] = '</li>';
		$params['first_tag_open'] = '<li>';
		$params['first_tag_close'] = '</li>';
		$params['next_tag_open'] = '';
		$params['next_tag_close'] = '';
		$params['prev_tag_open'] = '';
		$params['prev_tag_close'] = '';
		$params['cur_tag_open'] = '<li class="active" ><a href="#m">';
		$params['cur_tag_close'] = '</a></strong></li>';
		$params['num_tag_open'] = '<li>';
		$params['num_tag_close'] = '</li>';
		$params['full_tag_open'] = '<ul class="pagination">';
		$params['full_tag_close'] = '</ul>';
		$params['suffix'] = '#pagination';


		$pagination = new CI_Pagination();
		$pagination->initialize($params);
		
		$this->_pagination_output = $pagination->create_links();
		$this->current_page = (int)$pagination->cur_page;
		
		$output.= $this->render_header();
		
		if ($params['total_rows'] > 0)
			$output.= $this->render_prebody();

		$output.= $this->render_body();
		$output.= $this->render_footer();
	
		return $output;
	}
	
	public function render_header()
	{
		$output = '';		
		
		if ($this->header_view != '')
			$output.= include_partial($this->header_view, array(), true);
		elseif ($this->header_function != '')
		{
			$function = $this->header_function;
			$output.= $function();
		}
		
		return $output;
	}
	
	public function render_prebody()
	{
		return '';
	}
	
	public function render_msj()
	{
		if ($this->render_msj)
			return '<div> No hay elementos para mostrar </div>';
		else
			return '';
	}
	
	public function render_body()
	{
		
		
		$output = '';
		$prev_row = -1;
		
		$i = 0;
		if ($this->type == 1)
		{
			for ($j=0; $j<($this->current_page-1) * $this->page_size; $j++)
				next($this->arrayresult);
			$row = current($this->arrayresult);
		}
		else
			$row = $this->dbresult->row_array(($this->current_page-1) * $this->page_size);
		
		/* agregado para mostrar msj (no hay registros disponibles)*/  
		if (!$row)													
			return $this->render_msj();
		
		while (1)
		{
			if (!$row)														 
				break;
			
			if ($this->type == 0 && $this->dbresult->current_row == $prev_row)
				break;
				
			if ($i >= $this->page_size)
				break;
				
			$output.= $this->render_item($row);
		
			if ($this->type == 1)
			{
				next($this->arrayresult);
				$row = current($this->arrayresult);
			}
			else
			{
				$prev_row = $this->dbresult->current_row;
				$row = $this->dbresult->next_row('array');
			}
			$i++;
		}
		
		return $output;
	}
	
	public function render_footer()
	{
		if ($this->_pagination_output != '')
			return '<div id="list_pagination">'.$this->_pagination_output.'</div>';
			
		return '';
	}
	
	/* override this method */
	public function render_item($item)
	{
		if ($this->item_view != '')
			$output = include_partial($this->item_view, array('item' => $item), true);
		elseif ($this->item_function != '')
		{
			$function = $this->item_function;
		
			 $output = $function($item, $this->field);
		
		}
		else
			$output = ''; 
		
		return $output;
	}
	
	public function set_data_from_dbresult(CI_DB_result $obj)
	{
		$this->dbresult = $obj;
		$this->type = 0;
	}
	
	public function set_data_from_array(array $arr)
	{
		
		$this->arrayresult = $arr;
		$this->type = 1;
	}
}



class ListByColumnBuilder extends ListBuilder
{
	private $num_cols = 1;
	private $current_col = 0;
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
		
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
					$this->$key = $val;
			}
		}
	}
	
	public function render_body()
	{
		$output = '';
		$this->current_col = 0;
		
		$output.= '<table border="0" cellspacing="0" cellpadding="0">';
		$output.= parent::render_body();
		$output.= '</tr>';
		$output.= '</table>';
		
		return $output;
	}
		
		
	public function render_preitem($item)
	{
		$output = '';
		
		// debe comenzar nueva fila 
		if ($this->current_col % $this->num_cols == 0)
		{
			/* si es la primer fila: sólo abre fila nueva
			 * si es otra fila: cierra fila anterior y abre nueva */			
			if ($this->current_col == 0)
				$output.= '<tr>';
			else
				$output.= '</tr><tr>';
		}
		
		if (isset($this->item_class))
			$output.= '<td class="'.$this->item_class.'">';
		else
			$output.= '<td>';
			
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
		
/*		if ($this->item_view != '')
			$output.= include_partial($this->item_view, array('item' => $item, 'column' => $this->current_col % $this->num_cols), true);
		else		
			$output.= print_r($item, true);*/
			
		$output.= $this->render_postitem($item);
		
		return $output;
	}
	
	public function render_postitem($item)
	{
		$output = '';
		$output.= '</td>';

		$this->current_col++;
		
		return $output;
	}	
	
}



