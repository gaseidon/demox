$('#category').change(function(){
    var val = $("#category option:selected").val();
    if(val!='Все'){
    $.post('scripts/filter.php', {filter: val}, function(data){
        $('.el_filter').each(function(){
            if($(this).val()!=data || $(this).closest('.prod').attr('data-prod')=='')
                $(this).closest('.prod').css('display','none');
            else if($(this).val()==data)
                $(this).closest('.prod').css('display','block');
        });
});
}
else{
    $.post('scripts/filter.php', {filter: val}, function(data){
        $('.el_filter').each(function(){
            $(this).closest('.prod').css('display','block');
        });
});
}
});

