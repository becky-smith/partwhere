  $(document).ready(function(){
    $('#partsList').DataTable({
    	"dom": '<flipt>',
    	"pageLength": 25
    	});
	  $('select').material_select();
  });

 	var partCategory = -1;
	var partType = [];
	var headType = -1;
	var driveType = -1;
	var lenType = -1;
	var isoType = -1;
	var utsType = -1;
	var tipType = -1;
	var gradeType = -1;
	var materialType = -1;
	var finishType = -1;
	
	function resetWizard()
	{
		clearSelection();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	if(xmlhttp.responseText != "")
        	{
            document.getElementById("filter").innerHTML = '<div class="col s12">Select Part Type:</div>' + xmlhttp.responseText;
					  $(document).ready(function(){
					  });
          }
          else
        	{
        		// no subtypes...get parts?  Get other properties?
        		getParts(selId);
        	}
        }
    };
    xmlhttp.open("POST", "wizardwand.php?id=-1&method=getPartTypes", true);
    xmlhttp.send();
	}
	
	function clearSelection()
	{
  		document.getElementById("filter").innerHTML = "";
  		document.getElementById("selections").innerHTML = "";
  		document.getElementById("partSection").innerHTML = "";
  		// reset filter values
			partCategory = -1;
			partType = [];
			headType = -1;
			driveType = -1;
			lenType = -1;
			isoType = -1;
			utsType = -1;
			tipType = -1;
			gradeType = -1;
			materialType = -1;
			finishType = -1;  		
	}
	
	function addChip(chipName, chipImg)
	{
		var newChip = '<div class="chip">';
		if(chipImg != null && chipImg.length > 0)
		{
				newChip += ' <img src="img/' + chipImg + '">';
		}
		newChip += chipName + '</div>';
		document.getElementById("selections").innerHTML += newChip;
	}
	
	function partTypeSelected(selId, selName, selImg)
	{
		if(selId != -1)
		{
			document.getElementById("wizardErr").innerHTML = "";
			// only add this part type if it isn't already there...
			if(partType.indexOf(selId) == -1)
			{
				partType.push(selId);
				addChip(selName, selImg);
			}
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	if(xmlhttp.responseText != "")
	        	{
	            document.getElementById("filter").innerHTML = '<div class="col s12">Select Part Type:</div>' + xmlhttp.responseText;
	            
	          }
	          else
          	{
          		// no subtypes
          		getParts(selId);
          		// request grade
          		displayGrade();
          	}
	        }
	    };
	    xmlhttp.open("POST", "wizardwand.php?id=" + selId + "&method=getPartTypes", true);
	    xmlhttp.send();
	  }
	  else
  	{
  		document.getElementById("wizardErr").innerHTML = '<b>An error occurred when selecting Part Type. Please try again.<\b>';
			resetWizard();
  	}
	}
	
          		// request length for filtering
//          		displayLength();
	function displayLength()
	{
		var lenOpts = '<div class="row">';
		lenOpts += '<div class="col s6 m3 l2">Specify length:</div>';
		lenOpts += '<div class="col s6 red-text" id="lenErr"></div>';
		lenOpts += '</div>';
		lenOpts += '<div class="row">';
		lenOpts += '<div class="col s6 m3 l2">';
    lenOpts += '<input id="length" type="text" required/>';
    lenOpts += '<label for="length">Length</label>';
		lenOpts += '</div>';
		lenOpts += '<div class="col s3 m3 l2">';
    lenOpts += '<input name="unit1" type="radio" id="inch" checked/>';
    lenOpts += '<label for="inch">inches</label>';
		lenOpts += '</div>';
		lenOpts += '<div class="col s3 m3 l2">';
    lenOpts += '<input name="unit1" type="radio" id="metric" />';
    lenOpts += '<label for="metric">cm</label>';
		lenOpts += '</div>';
		lenOpts += '<div class="col s3 m3 l2">';
    lenOpts += '<a class="btn-floating waves-effect waves-teal" onclick="sendLength()"><i class="small material-icons">play_arrow</i></a>';
		lenOpts += '</div>';
		lenOpts += '</div>';
    document.getElementById("filter").innerHTML = lenOpts;		
	}
	
	function sendLength()
	{
		// apply a length filter, reselect parts, and display next filter.
    var lenStr = document.getElementById("length").value;
    var std = document.getElementById("inch").checked;
		var chipStr = "Length: " + lenStr;
    if(std === true)
    {
    	// value in inches
    	units = 1;
    	chipStr += '"';
    }
    else
  	{
  		// value in centimeters
  		units = 2;
    	chipStr += ' cm';
  	}
  	var lenNum = Number(lenStr);
  	if(isNaN(lenNum))
  	{
  		document.getElementById("lenErr").innerHTML = "<b>Length must be a number.  Please try again.</b>";
  	}
  	else
		{
			addChip(chipStr, "");
			// convert to a length type
			getLengthType(lenNum, units);
 		}
	}
	
	function getLengthType(lenToConvert, unit)
	{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	var result = Number(xmlhttp.responseText); 
	        	if(!isNaN(result))
	        	{
	        		lenType = result;
          		getParts(partType[partType.length - 1]);
          		// request diameter for filtering
          		displayDiameter();
          	}
	        }
	    };
	    xmlhttp.open("POST", "convertLength.php?len=" + lenToConvert + "&unit=" + unit, true);
	    xmlhttp.send();		
	}
	
	function displayDiameter()
	{
		var diamOpts = '<div class="row">';
		diamOpts += '<div class="col s6 m3 l2">Specify diameter:</div>';
		diamOpts += '<div class="col s6 red-text" id="diamErr"></div>';
		diamOpts += '</div>';
		diamOpts += '<div class="row">';
		diamOpts += '<div class="col s6 m3 l2">';
    diamOpts += '<input id="diameter" type="text" required/>';
    diamOpts += '<label for="diameter">Diameter</label>';
		diamOpts += '</div>';
		diamOpts += '<div class="col s6 m4 l3">';
    diamOpts += '<input name="unit1" type="radio" id="inch" checked/>';
    diamOpts += '<label for="inch">Standard (inches, ISO)</label>';
		diamOpts += '</div>';
		diamOpts += '<div class="col s6 m4 l3">';
    diamOpts += '<input name="unit1" type="radio" id="metric" />';
    diamOpts += '<label for="metric">Metric (mm, UTS)</label>';
		diamOpts += '</div>';
		diamOpts += '<div class="col s3 m3 l2">';
    diamOpts += '<a class="btn-floating waves-effect waves-teal" onclick="sendDiameter()"><i class="small material-icons">play_arrow</i></a>';
		diamOpts += '</div>';
		diamOpts += '</div>';
    document.getElementById("filter").innerHTML = diamOpts;		
	}
	
	function sendDiameter()
	{
		// apply a length filter, reselect parts, and display next filter.
    var diamStr = document.getElementById("diameter").value;
    var std = document.getElementById("inch").checked;
		var chipStr = "Diameter: " + diamStr;
    if(std === true)
    {
    	// value in inches
    	units = 1;
    	chipStr += '"';
    }
    else
  	{
  		// value in millimeters
  		units = 2;
    	chipStr += ' mm';
  	}
  	var diamNum = Number(diamStr);
  	if(isNaN(diamNum))
  	{
  		document.getElementById("diamErr").innerHTML = "<b>Diameter must be a number.  Please try again.</b>";
  	}
  	else
		{
			addChip(chipStr, "");		
			// convert to a thread
			getThread(diamNum, units);
 		}
	}

	function getThread(diamNum, unit)
	{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	var result = Number(xmlhttp.responseText); 
	        	if(!isNaN(result) && xmlhttp.responseText != "")
	        	{
	        		if(unit === 1)
	        		{
	        			isoType = result;
	        		}
	        		else
        			{
        				utsType = result;
        			}
          		getParts(partType[partType.length - 1]);
          		document.getElementById("filter").innerHTML = "";
          	}
          	else
          	{
          		document.getElementById("diamErr").innerHTML = "<b>Failed to locate thread.  Please try again.</b>";
          	}
	        }
	    };
	    xmlhttp.open("POST", "convertDiameter.php?diam=" + diamNum + "&unit=" + unit, true);
	    xmlhttp.send();
	}

	function displayGrade()
	{
		var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	if(xmlhttp.responseText != "")
        	{
            document.getElementById("filter").innerHTML = '<div class="col s12">Select Grade:</div>' + xmlhttp.responseText;
          }
          else
        	{
			  		document.getElementById("wizardErr").innerHTML = 'An error occurred when retrieving Grades. Please try again.';
						resetWizard();
        	}
        }
    };
    xmlhttp.open("POST", "wizardwand.php?method=getGrades", true);
    xmlhttp.send();
	}
	
	function gradeSelected(selId, selName, selImg)
	{
		if(selId != -1)
		{
			gradeType = selId;
			addChip(selName, selImg);
  		getParts(partType[partType.length - 1]);
  		// request length for filtering
  		displayMaterial();
	  }
	  else
  	{
  		document.getElementById("wizardErr").innerHTML = 'An error occurred when selecting Grade. Please try again.';
			resetWizard();
  	}
	}
	
	function displayMaterial()
	{
		var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	if(xmlhttp.responseText != "")
        	{
            document.getElementById("filter").innerHTML = '<div class="col s12">Select Material:</div>' + xmlhttp.responseText;
          }
          else
        	{
			  		document.getElementById("wizardErr").innerHTML = 'An error occurred when retrieving materials. Please try again.';
        		resetWizard();
        	}
        }
    };
    xmlhttp.open("POST", "wizardwand.php?method=getMaterials", true);
    xmlhttp.send();
		
		document.getElementById("filter").innerHTML = "";
	}
			
	
	function materialSelected(selId, selName, selImg)
	{
		if(selId != -1)
		{
			materialType = selId;
			addChip(selName, selImg);
  		getParts(partType[partType.length - 1]);
  		// request finish for filtering
  		displayFinish();
	  }
	  else
  	{
  		document.getElementById("wizardErr").innerHTML = 'An error occurred when selecting materials. Please try again.';
			resetWizard();
  	}
	}
	
	function displayFinish()
	{
		var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	if(xmlhttp.responseText != "")
        	{
            document.getElementById("filter").innerHTML = '<div class="col s12">Select Finish:</div>' + xmlhttp.responseText;
          }
          else
        	{
			  		document.getElementById("wizardErr").innerHTML = 'An error occurred when retrieving finishes. Please try again.';
        		resetWizard();
        	}
        }
    };
    xmlhttp.open("POST", "wizardwand.php?method=getFinishes", true);
    xmlhttp.send();
		
		document.getElementById("filter").innerHTML = "";
	}
			
	
	function finishSelected(selId, selName, selImg)
	{
		if(selId != -1)
		{
			finishType = selId;
			addChip(selName, selImg);
  		getParts(partType[partType.length - 1]);
  		// request finish for filtering
  		displayLength();
	  }
	  else
  	{
  		document.getElementById("wizardErr").innerHTML = 'An error occurred when selecting finish. Please try again.';
			resetWizard();
  	}
	}
	
	function getParts(selPartType)
	{
		var xmlhttp = new XMLHttpRequest();
	  xmlhttp.onreadystatechange = function() {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      	if(xmlhttp.responseText != "")
        {
          document.getElementById("partSection").innerHTML = xmlhttp.responseText;
          if (!$.fn.dataTable.isDataTable( '#partsList' ) ) {
					  $(document).ready(function(){
					    $('#partsList').DataTable({
					    	"dom": '<flipt>',
					    	"pageLength": 25
					    	});
						  $('select').material_select();
						});
					}
        }
      }
    };
    var page = "getParts.php?id=" + selPartType;
    if(headType != -1)
    {
    	page += "&head=" + headType;
    }
    if(lenType != -1)
    {
    	page += "&len=" + lenType;
    }
    if(isoType != -1)
    {
    	page += "&iso=" + isoType;
    }
    if(utsType != -1)
    {
    	page += "&uts=" + utsType;
    }
    if(tipType != -1)
    {
    	page += "&tip=" + tipType;
    }
    if(driveType != -1)
    {
    	page += "&drive=" + driveType;
    }
    if(gradeType != -1)
    {
    	page += "&grade=" + gradeType;
    }
    if(materialType != -1)
    {
    	page += "&material=" + materialType;
    }
    if(finishType != -1)
    {
    	page += "&finish=" + finishType;
    }
    xmlhttp.open("POST", page, true);
    xmlhttp.send();
	}
