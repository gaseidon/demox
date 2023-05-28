$('#ord').change(function(){
    var vad = $("#ord option:selected").val();
    if(vad!='Все'){
    $.post('scripts/filter_admin.php', {dar: vad}, function(data){

        $('.stat').each(function(){
            if($(this).html()!=data)
                
                $(this).closest('.main_ord').css('display','none');
            else if($(this).html()==data)
                $(this).closest('.main_ord').css('display','block');
        });
});
}
else{
    $.post('scripts/filter_admin.php', {dar: vad}, function(data){
        $('.stat').each(function(){
            $(this).closest('.main_ord').css('display','block');
        });
      
});
}
});