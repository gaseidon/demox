//обьявляем элементы формы
const form=document.forms[0];
const button = form.elements['button'];
const pass = form.elements['password'];
const passRep = form.elements['password_repeat'];

//генерация ошибок
const div = document.createElement('div');
const div1 = document.createElement('div');
const div2 = document.createElement('div');
const div3 = document.createElement('div');
const div4 = document.createElement('div');
div.innerHTML = "Данные заполнены некорректно";
div1.innerHTML = "Пароль меньше 6 символов";
div2.innerHTML = "Пароли не совпадают";
div4.innerHTML = "Не все поля заполнены";
div.style.color='red';
div1.style.color='red';
div2.style.color='red';
div3.style.color='red';
div4.style.color='red';
div.style.fontSize='14px';
div1.style.fontSize='14px';
div2.style.fontSize='14px';
div3.style.fontSize='14px';
div4.style.fontSize='14px';
//создание массива элементов формы

const inputArr=Array.from(form);
const validInputArr=[];

//нажатие

form.addEventListener("input", inputHandler);
button.addEventListener("click", buttonHandler);

//перебор элементов имеющие определенные атрибуты

inputArr.forEach((e)=>{
    if(e.hasAttribute('data-reg') || e.hasAttribute('data-pas')){
        e.setAttribute('is-valid','0'); 
        validInputArr.push(e); 
    } 
});

//вызов функций проверки пароля и валидности полей

function inputHandler({target}){
    if (target.hasAttribute("data-reg")){
        inputCheck(target);
    }
    if (target.hasAttribute("data-pas")){
        pasCheck(target);
    }
    if (target.hasAttribute("data-log")){
        logCheck(target);
    }
}

//уникальность логина

async function logCheck(el){ 
    const inputValue = el.value;
    const inputReg=el.getAttribute("data-reg");
    const reg= new RegExp(inputReg);
    const response = await fetch("scripts/unique.php", {
          method: 'POST',
          headers:{"Content-Type":'application/x-www-form-urlencoded'},
          body:"login=" + inputValue
      })
      
      const data = await response.text();
      div3.innerHTML =  data;
      if(div3.innerHTML!=''){
        el.style.border="1px solid rgb(255, 0, 0)";
        el.after(div3);
        el.setAttribute('is-valid','0');
        if(inputValue==''){
            el.style.border="1px solid black";
            div3.remove();
        }
      }
    //   else if(inputValue==''){
    //     el.style.border="1px solid black";
    //   }
      
      else if(reg.test(inputValue)){
        el.setAttribute('is-valid','1');
        
      }
  }

//проверка пароля

function pasCheck(el){
if(el.name=='password_repeat'){
    if(el.value==pass.value && pass.getAttribute('is-valid')=='1'){
        el.style.border="1px solid rgb(0, 196, 0)";
        div.remove();
        div2.remove();
        el.setAttribute('is-valid','1');
        if(el.value==''){
            el.style.border="1px solid black";
        }
    }
   else if(el.value==''){
    el.style.border="1px solid black";
    }
    else{
        el.style.border="1px solid rgb(255, 0, 0)";
        el.after(div2);
        el.setAttribute('is-valid','0');
        if(el.value==''){
            el.style.border="1px solid black";
        }
    }
}
else{
    if(el.value==passRep.value){
        passRep.style.border="1px solid rgb(0, 196, 0)";
        div.remove();
        div2.remove();
        passRep.setAttribute('is-valid','1');
    }
    else{
        passRep.style.border="1px solid rgb(255, 0, 0)";
        passRep.after(div2);
        passRep.setAttribute('is-valid','0');
    }
}
}

//валидность полей

function inputCheck(el){
    const inputValue = el.value;
    const inputReg=el.getAttribute("data-reg");
    const reg= new RegExp(inputReg); 
    console.log(el.value);
    
    if(reg.test(inputValue)){
        el.style.border="1px solid rgb(0, 196, 0)";
        div.remove();
        if(el.name!='password'){div.remove();}
        else{div1.remove();}
        el.setAttribute('is-valid','1');
        
        
    } 
    else if(inputValue==''){
        el.style.border="1px solid black";
        div.remove();
    }
    else{
        el.style.border="1px solid rgb(255, 0, 0)";
        if(el.name!='password'){el.after(div);}
        else{el.after(div1);}
        el.setAttribute('is-valid','0');
        
    }
}

//проверка полей перед отправкой при нажатии кнопки

function buttonHandler(e){
    const isAllValid=[];
    validInputArr.forEach((el)=>{
        if(el.getAttribute("is-valid")=='0'){
            el.style.border="1px solid rgb(255, 0, 0)";
            document.querySelector('.part').after(div4);
            el.setAttribute('is-valid','0');
        }
        else{
        el.style.border="1px solid rgb(0, 196, 0)";
        div.remove();
        el.setAttribute('is-valid','1');
        }
        if(el.name=='rules' && el.checked){
            el.setAttribute('is-valid','1');
            el.parentNode.style.border='none';
        }
         else if (el.name=='rules' && !(el.checked)){
        el.setAttribute('is-valid','0');
        el.parentNode.style.border='1px solid red';
        }
        if(el.name=='patronymic' && el.value==''){
            delete el;
        }
        else{
        isAllValid.push(el.getAttribute("is-valid"));
    }
    });
    console.log(isAllValid);
    let len=isAllValid.length;
    const isVallid=isAllValid.reduce((acc,current)=>{
        return Number(acc) + Number(current);
    });
    if (isVallid!=len ){
        e.preventDefault();
    } 
}



