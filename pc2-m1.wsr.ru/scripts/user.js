// отображение кнопок для юзеров
$(document).ready(function() {
$(".prod").each(function(i,e){
if(role == "admin"){
    $(e).append(`<p><a href="controllers/delete_product.php?id=${$(e).attr('data-val')}">Удалить</a></p> 
    <p><a href="update.php?id=${$(e).attr('data-val')}">Редактировать</a></p>`);
}
if(role != "guest"){
    $(e).append(`<span class="buy" data-prod=${$(e).attr('data-prod')} data-id=${$(e).attr('data-val')}>Купить</span><div class='count'>В наличии: ${$(e).attr('data-prod')}</div>`);
}
})

// скрыть авторизацию и регистрацию
if(role!='guest'){
    $('#register,#form_reg,#login,#form_log,.val').css('display', 'none');
}

// отправка заказа без перезагрузки
$(".form_checkout").submit(function (e) {
        e.preventDefault();
        let data = $(".form_checkout").serialize()
        $.post('controllers/checkout.php', data, function(el){
                if(el=='Заказ оформлен'){
                $(".cart").css('display', 'none');
                $(".checkout_password").val('');
                // $(".error_password").css('display', 'none');
                }
                else{
                    $(".error_password").css('display', 'block');
                }  
                console.log(el);

        });
});


// проверка на наличие товара
$('.plus').each(function(){
    if($(this).attr('data-prod')=='0'){
        $(this).next().css('display', 'block');
        $(this).css('display','none');
        
    }
})


// увелечение товара в корзине
$(".buy").click(function (e){
        
    let id=$(this).attr('data-id');
    let d=$(this);
    let prod=+$(this).attr('data-prod');
    --prod;
    $(this).attr('data-prod',String(prod));
    if(prod==0){
        $(this).parent('.prod').css('display','none');

    }
    $.post('controllers/add_cart.php', {id: id}, function(data){
        d.next().html('В наличии: '+prod);
    });
});



$('.buy').each(function(){
    if($(this).attr('data-prod')=='0'){
        $(this).parent('.prod').css('display','none');
        
    }
})

// увелечение товара в корзине
$(".plus").click(function (e){
        
        let id=$(this).attr('data-id');
        let d=$(this);
        let prod=+$(this).attr('data-prod');
        --prod;
        $(this).attr('data-prod',String(prod));
        if(prod==0){
            $(this).css('display','none')
            $(this).next().css('display', 'block');
        }
        $.post('controllers/add_cart.php', {id: id}, function(data){
            d.prev().html(data);
        });
});

// уменьшение товара в корзине
$(".minus").click(function (){
    let id=$(this).attr('data-id');
    let d=$(this);
    let prod=+$(this).siblings('.plus').attr('data-prod');
        ++prod;
        $(this).siblings('.plus').attr('data-prod',String(prod));
        if(prod!=0){
            $(this).siblings('.plus').css('display','block')
            $(this).siblings('.error_product').css('display', 'none');
        }
    $.post('controllers/delete_cart.php', {id: id}, function(data){
        d.next().html(data);
        if (d.next().html()=='0'){
            d.parent('.row').parent('.col').remove();
        }
    });
});

}); 