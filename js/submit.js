
var addTable = document.getElementById("textBox1"); //or addTable = document.querySelector('#tableInc tbody');
var decTable = document.getElementById("textBox2"); 
var addsubjects = [];
var decsubjects = [];
var num_row_increse = 1;
var num_row_decress = 1;
var $row;
var where = document.getElementById('files'); 
	var myfile;
	var filesize;
	var filetype;
var serialized = 0;


function addIncress(){
	
	$("#textBox1").append(
	$("<tr>")
	.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 180px;" class="form-control" placeholder="รหัสหนัง" id="รหัสหนัง_'+ num_row_increse +'" name= "รหัสหนัง" required size="10" data-name1="รหัสหนัง" /></td>'))
	.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 290px;" class="form-control" placeholder="ชื่อหนัง" id="ชื่อหนัง_'+ num_row_increse +'" name= "ชื่อหนัง" required size="20" data-name1="ชื่อหนัง" /></td>'))
		.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 790px;" class="form-control" placeholder="รายละเอียด" id="รายละเอียด_'+num_row_increse+'" name="รายละเอียด" required size="4" data-name1="รายละเอียด" /></td>'))
		.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 100px;" placeholder="ความยาว" class="form-control" id="ความยาว_'+num_row_increse+'" name="ความยาว" required size="4" data-name1="ความยาว" /></td>'))
		.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 150px;"  class="form-control" placeholder="ประเภท" id="ประเภท_'+num_row_increse+'" name="ประเภท" required size="26" data-name1="ประเภท" /></td>'))
		.append($('<td style = "text-align: center">').append('<button type = "button" class ="btn btn-danger" onclick="delRow(this)">ลบ</button></td>')))
		num_row_increse += 1;
}
function addIncress1(){
	
	$("#textBox2").append(
	$("<tr>")
	.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 280px;" class="form-control" placeholder="ชื่อ" id="ชื่อ_'+ num_row_increse +'" name= "ชื่อ" required size="10" data-name1="ชื่อ" /></td>'))
	.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 280px;" class="form-control" placeholder="วันที่ฉาย" id="วันที่ฉาย_'+ num_row_increse +'" name= "วันที่ฉาย" required size="20" data-name1="วันที่ฉาย" /></td>'))
		.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 280px;" class="form-control" placeholder="รอบฉาย" id="รอบฉาย_'+num_row_increse+'" name="รอบฉาย" required size="4" data-name1="รอบฉาย" /></td>'))
		.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 280px;" placeholder="สาขา" class="form-control" id="สาขา_'+num_row_increse+'" name="สาขา" required size="4" data-name1="สาขา" /></td>'))
		.append($('<td style = "text-align: center">').append('<input type ="text" style="width: 280px;"  class="form-control" placeholder="ราคา" id="ราคา_'+num_row_increse+'" name="ราคา" required size="26" data-name1="ราคา" /></td>'))
		.append($('<td style = "text-align: center">').append('<button type = "button" class ="btn btn-danger" onclick="delRow1(this)">ลบ</button></td>')))
		num_row_increse += 1;
}
/*
$('#textBox1').on('click', 'input[type="button"]', function () {
    $(this).closest('tr').remove();
})
$('p input[type="button"]').click(function () {
    $('#textBox1').append('<tr><td><input type="text" class="fname" /></td><td><input type="button" value="Delete" /></td></tr>')
});

//$('#textBox1').on('click', 'input[type="button"]', function () {
   // $(this).closest('tr').remove();
*/

function delRow(currElement) {
     var parentRowIndex = currElement.parentNode.parentNode.rowIndex;
     document.getElementById("textBox1").deleteRow(parentRowIndex);
}
function delRow1(currElement) {
     var parentRowIndex = currElement.parentNode.parentNode.rowIndex;
     document.getElementById("textBox2").deleteRow(parentRowIndex);
}

function subIncress2(x){
	var table = document.getElementById("textBox2");

		 $(this).closest('tr').remove();
	
	

}



function goBack() {
  window.history.back();
}
