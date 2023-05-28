const form1=document.forms[1];
const inputArr1=Array.from(form1);
let validInputArr1=[];
const div11 = document.createElement('div');
div11.style.color='red';
div11.style.fontSize='14px';
div11.innerHTML = "Неправильный логин или пароль";
const button1 = document.querySelector('.btn');
inputArr1.forEach((e)=>{
    if(e.hasAttribute('placeholder')){
        e.setAttribute('is-valid','0'); 
        validInputArr1.push(e); 
    } 
});

function buttonVal(e){
    e.preventDefault();
    div4.remove();
    let elem={login:document.querySelector('.login_signup').value, password:document.querySelector('.password_signup').value};
    let isAllValid1=[];
   
        $.post('controllers/exist.php', {ele: elem}, function(dee){
            if(dee=='none'){
            document.querySelector('.btn').after(div11);
        }
            else if(dee==1){
                div11.remove();
                p=dee; 
                document.querySelector('.btn').setAttribute('data-ver','1');
            }
            
            
            validInputArr1.forEach((el)=>{
                if(el.value==''){
                    el.style.border="1px solid rgb(255, 0, 0)";
                    el.setAttribute('is-valid','0');
                    isAllValid1.push(el.getAttribute("is-valid"));
                    document.querySelector('.btn').after(div4);
                }
                else{
                el.style.border="1px solid rgb(0, 196, 0)";
                
                el.setAttribute('is-valid','1');
                isAllValid1.push(el.getAttribute("is-valid"));
                
                }
        
            });
            
        console.log(isAllValid1);
            let len1=isAllValid1.length;
            const isVallid1=isAllValid1.reduce((acc1,current1)=>{
                return Number(acc1) + Number(current1);
            });
            console.log(isVallid1);
            if (isVallid1==len1 && document.querySelector('.btn').getAttribute('data-ver')=='1'){
                form1.submit();
            } 
            
        });
        
}
button1.addEventListener("click", buttonVal);

