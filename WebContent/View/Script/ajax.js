$(function() 
{	
    $("#modelno").autocomplete({
        source: "Model/modelsearch.php",
        minLength: 1
    }); 
   
    $("#billmodelno").autocomplete({
        source: "Model/modelsearch.php",
        minLength: 1
    });
    
    $("#billno").autocomplete({
        source: "Model/modelsearch.php",
        minLength: 1
    }); 

    $("#brand").autocomplete({
        source: "Model/brandsearch.php",
        minLength: 2
    });                

    $("#color").autocomplete({
        source: "Model/colorsearch.php",
        minLength: 2
    });   
    
    $("#billno").autocomplete({
        source: "Model/billsearch.php",
        minLength: 1
    });
    
    $("#name").autocomplete({
        source: "Model/namesearch.php",
        minLength: 1
    });
    
    $( "#choice" ).buttonset();
});

$(function() 
{
	$( "#billdate" ).datepicker({maxDate: 0,dateFormat: 'yy-mm-dd', defaultDate: new Date()});
	$( "#date" ).datepicker({maxDate: 0,dateFormat: 'yy-mm-dd', defaultDate: new Date()});
	$( "#fdate" ).datepicker({maxDate: 0,dateFormat: 'yy-mm-dd'});
	$( "#tdate" ).datepicker({maxDate: 0,dateFormat: 'yy-mm-dd'});	
});

$(function() 
{
	$( "#prodpriceslider" ).slider({
	range: true,
	min: 50,
	max: 2000,
	values: [ 75, 1000 ],
	slide: function( event, ui ) {
	$( "#prodamount" ).val( "RS" + ui.values[ 0 ] + " - Rs" + ui.values[ 1 ] );
	}
	});
	$( "#prodamount" ).val( "Rs" + $( "#prodpriceslider" ).slider( "values", 0 ) +
	" - Rs" + $( "#prodpriceslider" ).slider( "values", 1 ) );
	
	$( "#billpriceslider" ).slider({
		range: true,
		min: 500,
		max: 2000000,
		values: [ 1000, 100000 ],
		slide: function( event, ui ) {
		$( "#billamount" ).val( "RS" + ui.values[ 0 ] + " - Rs" + ui.values[ 1 ] );
		}
		});
		$( "#billamount" ).val( "Rs" + $( "#billpriceslider" ).slider( "values", 0 ) +
		" - Rs" + $( "#billpriceslider" ).slider( "values", 1 ) );
});
