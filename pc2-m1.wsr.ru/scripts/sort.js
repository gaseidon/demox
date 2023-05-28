$(document).ready(function() {
    let desc_year=0;
    let desc_name=0;
    let desc_price=0;

$('.sp').each(function(){
    $(this).click(function(){
        let d;
        if($(this).text()=='Все'){
            d={type:'created_at',method:'ASC'};
            desc_year=0;
             desc_name=0;
            desc_price=0;
        }
        if($(this).text()=='Год'){
        
            d={type:'year',method:'ASC'};
            desc_year++;
            desc_name=0;
            desc_price=0;
            if(desc_year==2){
                d={type:'year',method:'DESC'};
                desc_year=0;
            }
        }
        if($(this).text()=='Наименование'){
            d={type:'name',method:'ASC'};
            desc_year=0;
            desc_price=0;
            desc_name++;
            if(desc_name==2){
                d={type:'name',method:'DESC'};
                desc_name=0;
            }
        }
        if($(this).text()=='Цена'){
            d={type:'price',method:'ASC'};
            desc_year=0;
            desc_name=0;
            desc_price++;
            // console.log(desc);
            if(desc_price==2){
                d={type:'price',method:'DESC'};
                desc_price=0;
                
            }
        }
        // console.log(desc);
        

        $.post('scripts/sort.php', {dat: d}, function(data){
            // console.log(data);
           let dd=JSON.parse(data);
           let k='';
           dd.forEach((element,i) => {
            k+=`<div class="col prod" data-prod="${ JSON.parse(dd[i]).count_products }" data-val="${ JSON.parse(dd[i]).product_id }">
            <img src="${ JSON.parse(dd[i]).path }" alt="">
            <h3><a href="product.php?id=${ JSON.parse(dd[i]).product_id }">${ JSON.parse(dd[i]).name }</a></h3>
            <p>${ JSON.parse(dd[i]).price }$</p>
            <input type="hidden" name="product_id"">
            <input type="hidden" value="${ JSON.parse(dd[i]).year }" name="year">
            <input type="hidden" class="el_filter" value="${ JSON.parse(dd[i]).category }" name="category">
            </div>`


           });

            $('.alim').html(k);
            $(".prod").each(function(i,e){
                if(role == "admin"){
                    $(e).append(`<p><a href="controllers/delete_product.php?id=${$(e).attr('data-val')}">Удалить</a></p> 
                    <p><a href="update.php?id=${$(e).attr('data-val')}">Редактировать</a></p>`);
                }
                if(role != "guest"){
                    $(e).append(`<span class="buy" data-prod=${$(e).attr('data-prod')} data-id=${$(e).attr('data-val')}>Купить</span><div class='count'>В наличии: ${$(e).attr('data-prod')}</div>`);
                }
                })
    });



    });

});

});