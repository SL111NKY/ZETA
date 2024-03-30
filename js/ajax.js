//AJAX ACTIVE CLASS BY CLICK FOR BUTTON COLOR CHANGE
function inlineEdit(value) {
    //    $(value).css("background", "#b3d7ff");
        //we change the color of the selected cell
}


function inlineData(value, inline, id) {

	$(value).css("background", "url(img/loading.gif) no-repeat right");

	$.ajax({
		url: "inlineedit.php", //ur we will send the data to
		type: "POST", //will be sent by post
		data: 'inline=' + inline + '&value=' + value.innerHTML.split('+').join('{0}') + '&id=' + id, 
		// we send the data as "inline" "value and id"             
		success: function (data) {
		//	$(value).css("background", "green");
		//	$("#resultstatus").text("Successful, Data Updated");

		},
		error: function(XMLHttpRequest, data, errorThrown) { 
		//	$(value).css("background", "red");
		//	$("#resultstatus").text("Error , There is something wrong , Please Check");
			//alert("Status: " + data); alert("Error: " + errorThrown); 
		} 

	});

}