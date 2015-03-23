<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script language="javascript">


function getProducts(id)
{
   	var url='welcome/getproducts/'+id;
	
	//AJAX call to populate products dropdown.
	$.ajax({
			url : url,
			cache: false,
			success : function(response) {
				$('#products').html('');
				$('#products').html(response);
				
			},
			
	});
	
}

//Generate report function called on 'submit' click event.
function generate_report(id)
{
    
	var client_id=($('#client_id').val()!='')?$('#client_id').val():'1V1';
	var date_id=($('#date_range').val()!='')?$('#date_range').val():'1V1';
	
   	var url='welcome/generatereport/'+client_id+'/'+date_id;
	
	//AJAX call to fetch and display report data.
	$.ajax({
			url : url,
			cache: false,
			success : function(response) {
				$('#results').html('');
				$('#results').html(response);
				
			},
			
	});
	
}
</script>
<div id="container">
	<h1>Welcome to Report Page</h1>

	<div id="body">
     <div id = "clients">clients : <select name="client_id" id="client_id" onChange="getProducts(this.value);">
          <option value="">Please Select</option>
         <?php foreach ($client_data as $row){ ?>
            <option value="<?php echo $row->client_id;?>"><?php echo $row->client_name;?></option>
		 <?php } ?> 
  
     
     </select> 
    </div>
    <br>
    <div id = "products">Products : <select name="product_id" id="product_id">
          <option value="">Please Select</option>
            
     </select> 
    </div>
    <br>
    <div id = "date_range1">Relative Date : <select name="date_range" id="date_range">
          <option value="">Please Select</option>
          <option value="lastm">Last Month to date</option>
          <option value="thism">This Month</option>
          <option value="thisy">This year</option>
          <option value="lasty">Last year</option>
            
     </select> 
    </div>
    <br>
    <div id = "button"><input type="button" name="getdata" id="getdata" value="Get Report" onClick="generate_report();">
    </div>
    <br>
    <br>
    <br>
    <div id = "results"></div>
		
</div>

</body>
</html>