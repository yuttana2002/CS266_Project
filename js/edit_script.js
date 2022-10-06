$(function(){
    var provinceObject = $('#province');
    var amphursObject = $('#amphurs');
    var districtObject = $('#district');

    provinceObject.on('change', function(){
        var province = $(this).val();
        amphursObject.html('<option value="">เลือกอำเภอ</option>');
        districtObject.html('<option value="">เลือกตำบล</option>');

        $.get('./get_edit_amphurs.php?province=' + province, function(data){
        
            var result = JSON.parse(data);
            
            $.each(result, function(index, item){
               
                amphursObject.append(
                    $('<option></option>').val(item.Amphurs).html(item.Amphurs)
                );
            });
        });
    });

    // on change amphurs
    amphursObject.on('change', function(){
        var amphurs = $(this).val();

        districtObject.html('<option value="">เลือกตำบล</option>');
        
        $.get('./get_edit_district.php?amphurs=' + amphurs, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                districtObject.append(
                    $('<option></option>').val(item.District).html(item.District)
                );
            });
        });
    });
});