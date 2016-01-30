$("#date" ).datepicker({dateFormat: 'yy-mm-dd'});

$("#modelno").autocomplete({
    source: "Model/modelsearch.php",
    minLength: 2
}); 

$("#brand").autocomplete({
	source: "Model/brandsearch.php",
	minLength: 2
});                

$("#color").autocomplete({
    source: "Model/colorsearch.php",
    minLength: 2
});  

$(function() 
{
	$("body").on('change','#type',function()
	{
		var type = $('#type').val();
		if(type == "floor")
		{
			$("#floortype").show( 100 );
			$("#parkingtype").hide( 100 );
			$("#vitrifiedtype").hide( 100 );
			$("#walltype").hide( 100 );
		}
		else if(type == "parking")
		{	
			$("#floortype").hide( 100 );
			$("#parkingtype").show( 100 );
			$("#vitrifiedtype").hide( 100 );
			$("#walltype").hide( 100 );
		}
		else if(type == "vitrified")
		{
			$("#floortype").hide( 100 );
			$("#parkingtype").hide( 100 );
			$("#vitrifiedtype").show( 100 );
			$("#walltype").hide( 100 );
		}
		else if(type == "wall")
		{
			$("#floortype").hide( 100 );
			$("#parkingtype").hide( 100 );
			$("#vitrifiedtype").hide( 100 );
			$("#walltype").show( 100 );
		}	
	});
	
});

function exist()
{
	document.getElementById("edbtn").style.display="inline";
	var elems = document.getElementsByClassName('add');
	
	for(var i = 0; i < elems.length; i++) 
	{
	    elems[i].style.display = 'inline';
	}
}

function success()
{
	
}

function rest()
{
	document.getElementById("modelno").disabled = false;
	document.getElementById("brand").disabled = false;
	document.getElementById("size1").disabled = false;
	document.getElementById("size2").disabled = false;
	document.getElementById("type").disabled = false;
	document.getElementById("god1").disabled = false;
	document.getElementById("god2").disabled = false;

	$("#image" ).hide( 100 );

	var elems = document.getElementsByClassName('add');
	for(var i = 0; i < elems.length; i++) {
	    elems[i].style.display = 'none';
	}
	
	document.getElementById("pics").disabled = false;
	document.getElementById("make").disabled = false;
	document.getElementById("color").disabled = false;
	document.getElementById("date").disabled = false;
	document.getElementById("price").disabled = false;
	
}



function clrscr()
{
	document.getElementById("modelno").disabled = false;
	document.getElementById("brand").disabled = false;
	document.getElementById("size1").disabled = false;
	document.getElementById("size2").disabled = false;
	document.getElementById("type").disabled = false;
	document.getElementById("god1").disabled = false;
	document.getElementById("god2").disabled = false;
	
	document.getElementById("adgod1").value = "";
	document.getElementById("adgod2").value = "";
	
	var elems = document.getElementsByClassName('add');
	for(var i = 0; i < elems.length; i++) 
	{
	    elems[i].style.display = "none";
	}
	
	document.getElementById("pics").disabled = false;
	document.getElementById("make").disabled = false;
	document.getElementById("color").disabled = false;
	document.getElementById("date").disabled = false;
	document.getElementById("price").disabled = false;

}

function showimage()
{
	$("#image" ).show( 100 );
}
