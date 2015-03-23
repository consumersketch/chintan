<?php
class Welcomemodel extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
    
    function getAllclients()
    {
		//Populate client dropdown 
        $query = $this->db->get('clients', 10);
        return $query->result();
    }
	function getAllProducts($client_id)
    {   
	    //Generate products dropdown based on client dropdown selection
		$query=$this->db->select('p.*')
		->from('products p')
		->where('p.client_id',$client_id)->get();
		$data_product = $query->result();
		$str = '';
		$str .= 'Products : <select name="product_id" id="product_id"><option value="">Please Select</option>';
		foreach ($data_product as $product){
		   $str .= '<option value="'.$product->product_id.'">'.$product->product_description.'</option>';
		}
		$str .= '</select>';
		echo $str;
    }
	function generatereport($client_id,$date_id)
    {   
		//Generate report data basedon client and date filter.
	    $condition = 'where 1=1';
		if($client_id != '1V1'){
		  $condition .= " and inv.client_id = '".$client_id."'";
		}
		
			//SQL query condition to display records from Last month to date
		  if($date_id == 'lastm'){
		    $start_date = date('Y-m-d', strtotime('first day of last month'));
			$end_date = date('Y-m-d');
			$condition .= " and (inv.invoice_date BETWEEN '".$start_date."' AND '".$end_date."')";
			
		  }
		  
		  //SQL query condition to display records for this Month
		  else if($date_id == 'thism'){
		    $start_date = date('Y-m-d', strtotime('first day of this month'));
			$end_date = date('Y-m-d');
			$condition .= " and (inv.invoice_date BETWEEN '".$start_date."' AND '".$end_date."')";
			
		  }
		  
		  //SQL query condition to display records for this year
		  else if($date_id == 'thisy'){
		    $start_date = date('Y-m-d', strtotime('first day of January'));
			$end_date = date('Y-m-d', strtotime('first day of December'));
			$condition .= " and (inv.invoice_date BETWEEN '".$start_date."' AND '".$end_date."')";
			
		  }
		  
		  //SQL query condition to display records for last year
		  else if($date_id == 'lasty'){
		    $year = date('Y') - 1; // Get current year and subtract 1
			$start_date =  $year.'-01-01' ;
			$end_date =    $year.'-12-01' ;
		    
			$condition .= " and (inv.invoice_date BETWEEN '".$start_date."' AND '".$end_date."')";
			
		  }
		  
		 
		
	    $sql = "select inv.*,invd.product_id,p.product_description,invd.qty,invd.price from invoices inv left join invoicelineitems invd on inv.invoice_num=invd.invoice_num inner join products p on invd.product_id = p.product_id $condition";
		$query = $this->db->query($sql);
		
		//Generate HTML table structure and data for report
		$str = '';
		$str .= '<table width="800px" border="1">
				<tr>
				<th>Invoice Number</th>
				<th>Invoice Date</th>
				<th>Product</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Total</th>
				</tr>';
		foreach ($query->result() as $product){
		    $total_price = $product->qty*$product->price;
		   $str .= '<tr>
		            <td>'.$product->invoice_num.'</td>
					<td>'.$product->invoice_date.'</td>
					<td>'.$product->product_description.'</td>
					<td>'.$product->qty.'</td>
					<td>'.$product->price.'</td>
					<td>'.$total_price.'</td>
		   </tr>';
		}
		$str .= '</table>';
		echo $str;
		
    }

    
}
?>