const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input");

form.onsubmit = (e)=>{
    e.preventDefault();//preventing form from submitting
}

continueBtn.onclick=()=>{
    //let's start ajax
    let xhr = new XMLHttpRequest();//creating XML object
    xhr.open("POST" , "registeruser.php", true);
    xhr.onload= ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "login.php"
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    
                }
            }
        }
    }
    //we have to send form data through ajax to php
    let formData = new FormData(form);//creating new formData obj
    xhr.send(formData);
}