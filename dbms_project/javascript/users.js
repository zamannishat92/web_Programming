const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button"),
usersList = document.querySelector(".users .users-list");

searchBtn.onclick = () =>{
    searchBar.classList.toggle("active");///allows for manipulating searchbar's class content attribute through DOMTokenlist object
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}
//adding an active class when user start searching and only run the setinterval ajax if there is no active class
searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;//string
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
     //let's start ajax
     let xhr = new XMLHttpRequest();//creating XML object//use to interact with servers
     xhr.open("POST" , "php/search.php", true);
     xhr.onload= ()=>{
         if(xhr.readyState === XMLHttpRequest.DONE){
             if(xhr.status === 200){
                 let data = xhr.response;
                 usersList.innerHTML = data;
             }
         }
     }
     //combine a header in author request header
     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhr.send("searchTerm=" + searchTerm);//sending user search term to php file with ajax
}

setInterval(() => {
    //let's start ajax
    let xhr = new XMLHttpRequest();//creating XML object
    xhr.open("GET" , "php/users.php", true);
    xhr.onload= ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){//if active active not contains in search bar then add this data
                usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();

}, 500);//this function will run frequently after 500ms