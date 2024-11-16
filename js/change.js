function inputs_clean(){
    var modification_box = document.getElementById('modification_box');
    var input_1 = document.getElementById('input_1');
    var input_2 = document.getElementById('input_2');
    var input_3 = document.getElementById('input_3');
    var for_input_1 = document.getElementById('for_input_1');
    var for_input_2 = document.getElementById('for_input_2');
    var for_input_3 = document.getElementById('for_input_3');
    input_1.children[0].removeAttribute("placeholder");
    input_1.children[0].removeAttribute("type");
    input_1.children[0].removeAttribute("name");
    input_1.children[0].removeAttribute("min");
    input_2.children[0].removeAttribute("placeholder");
    input_2.children[0].removeAttribute("type");
    input_2.children[0].removeAttribute("name");
    input_3.children[0].removeAttribute("placeholder");
    input_3.children[0].removeAttribute("type");
    input_3.children[0].removeAttribute("name");
    for_input_1.innerHTML = "";
    for_input_2.innerHTML = "";
    for_input_3.innerHTML = "";
    input_1.children[0].value = "";
    input_2.children[0].value = "";
    input_3.children[0].value = "";
    document.getElementById("all_req_rep").innerHTML ="";
    //console.log("active");
    modification_box.style.display = "none";
    for_input_1.style.display = "none";
    input_1.style.display = "none";
    for_input_2.style.display = "none";
    input_2.style.display = "none";
    for_input_3.style.display = "none";
    input_3.style.display = "none";
    document.getElementById("all_req_rep").style.display = "none";
    //for_input_3.style.display = "none";
    //input_3.style.display = "none";
}

function listner_input(e,y){
    y.addEventListener('input', function(event) {
        const inputValue2 = event.target.value;
        for (let i = 0; i < inputValue2.length; i++) {
            if (e.indexOf(inputValue2[i]) === -1) {
            event.target.value = inputValue2.replace(inputValue2[i], '');
            //console.log("if");
            break;

            }else{
                //console.log("else");
            }
        }
        });
}

function btn_change(btn){
    inputs_clean();
    //console.log(btn);
    //console.log(btn.getAttribute("btn-data"));
    var btn_data = btn.getAttribute("btn-data");
    var modification_box = document.getElementById('modification_box');
    modification_box.style.display = "block";
    var input_1 = document.getElementById('input_1');
    var input_2 = document.getElementById('input_2');
    var input_3 = document.getElementById('input_3');
    var for_input_1 = document.getElementById('for_input_1');
    var for_input_2 = document.getElementById('for_input_2');
    var for_input_3 = document.getElementById('for_input_3');

    if( btn_data =="first_name"){
        //var input_1 = document.getElementById('input_1');
        //var for_input_1 = document.getElementById('for_input_1');
        for_input_1.style.display = "block";
        for_input_1.innerHTML = "Enter your new first name";
        input_1.style.display = "block";
        input_1.children[0].setAttribute("type","text");
        input_1.children[0].setAttribute("name","first_name");
        //input_1.children[0].setAttribute("id","first_name");
        input_1.children[0].setAttribute("placeholder","your new first name");
        //var change_btn = document.getElementById('change_btn');
        //change_btn.setAttribute("onclick","verif_req('first_name','first_name')");
        listner_input(wantedCharacters2,input_1);
    }  
    else if( btn_data =="name"){
        //var input_1 = document.getElementById('input_1');
        //var for_input_1 = document.getElementById('for_input_1');
        for_input_1.style.display = "block";
        for_input_1.innerHTML = "Enter your new name";
        input_1.style.display = "block";
        input_1.children[0].setAttribute("type","text");
        input_1.children[0].setAttribute("name","name");
        input_1.children[0].setAttribute("placeholder","your new name");
        listner_input(wantedCharacters2,input_1);
    }
    else if( btn_data =="mail"){
        for_input_3.style.display = "block";
        for_input_3.innerHTML = "Enter your new mail";
        input_3.style.display = "block";
        input_3.children[0].setAttribute("type","mail");
        input_3.children[0].setAttribute("name","mail");
        input_3.children[0].setAttribute("placeholder","your new mail");
        listner_input(wantedCharacters1,input_3);
    }
    else if( btn_data =="password"){
        //var input_1 = document.getElementById('input_1');
        //var input_2= document.getElementById('input_2');
        //var for_input_1 = document.getElementById('for_input_1');
        //var for_input_2 = document.getElementById('for_input_2');
        for_input_1.style.display = "block";
        for_input_1.innerHTML = "Enter your old password";
        for_input_2.style.display = "block";
        for_input_2.innerHTML = "Enter your new password";
        input_1.style.display = "block";
        input_1.children[0].setAttribute("type","text");
        input_1.children[0].setAttribute("name","old_password");
        input_1.children[0].setAttribute("placeholder","your old password");
        input_2.style.display = "block";
        input_2.children[0].setAttribute("type","text");
        input_2.children[0].setAttribute("name","password");
        input_2.children[0].setAttribute("placeholder","your new password");
        listner_input(wantedCharacters3,input_1);
        listner_input(wantedCharacters3,input_2);
    }else if( btn_data =="Date_of_birth"){
        var input_1 = document.getElementById('input_1');
        var for_input_1 = document.getElementById('for_input_1');
        for_input_1.style.display = "block";
        for_input_1.innerHTML = "Enter your birthday";
        input_1.style.display = "block";
        input_1.children[0].setAttribute("type","date");
        input_1.children[0].setAttribute("name","naissance");
        input_1.children[0].setAttribute("min","2000-01-02");
    }else if( btn_data =="user"){
        var input_1 = document.getElementById('input_1');
        var for_input_1 = document.getElementById('for_input_1');
        for_input_1.style.display = "block";
        for_input_1.innerHTML = "Enter your new user name";
        input_1.style.display = "block";
        input_1.children[0].setAttribute("type","text");
        input_1.children[0].setAttribute("name","user");
        listner_input(wantedCharacters4,inputField1);
    }
    if( btn.id =="cancel_btn"){
        inputs_clean();
    }
    document.getElementById("modification_box").addEventListener("submit", function(event) {
        event.preventDefault();
        
        let formData = new FormData(document.getElementById("modification_box"));
        
        fetch("php/update.php", {
          method: "POST",
          body: formData
        })
        //.then(response => response.text())
        .then(response => response.json())
        .then(data => {
          //console.log(data);
          //console.log(Object.keys(data));
          //for (const property in data[myarray]){
            //console.log(property);
           // console.log(data[property]);
         // }
        let myString = data.myString;
        let first_name_content = data.myArray.first_name_content;
        let mail_content = data.myArray.mail_content;
        let naissance_content = data.myArray.naissance_content;
        let name_content = data.myArray.name_content;
        let user_content = data.myArray.user_content;
        //console.log(first_name_content);
        //console.log(mail_content);
        //console.log(naissance_content);
        //console.log(name_content);
        //console.log(myString);
        //console.log(user_content);
        if (myString == "msg_vide"){

            document.getElementById("all_req_rep").style.display = "none";
            document.getElementById("all_req_rep").innerHTML ="";
            document.getElementById("user_content").innerHTML = user_content ;
            document.getElementById("first_name_content").innerHTML ="First name : " + first_name_content;
            document.getElementById("name_content").innerHTML ="Name : " + name_content;
            document.getElementById("mail_content").innerHTML ="Mail : " + mail_content;
            document.getElementById("naissance_content").innerHTML =naissance_content;
            document.getElementById("success-msg-2").style.display = "block";
            setTimeout(function() {
                document.getElementById("success-msg-2").style.display = "none";
            }, 1000);
            inputs_clean();
            var liner = document.querySelector("#liner");
            liner.dataset.content = user_content + "-virtuel-machine:~ $";
        }
        if(myString == "msg_mail"){
            document.getElementById("all_req_rep").style.display = "block";
            document.getElementById("all_req_rep").innerHTML ="This mail is already exist";
        }
        if(myString == "msg_password"){
            document.getElementById("all_req_rep").style.display = "block";
            document.getElementById("all_req_rep").innerHTML ="This password is incorrect";
        }

        if(myString == "msg_user"){
            document.getElementById("all_req_rep").style.display = "block";
            document.getElementById("all_req_rep").innerHTML ="This user is already exist";
        }
        



          //console.log(typeof data["first_name_content"]);







        })
        .catch(error => {
          console.error(error);
        });
    });
}

function profil_img_change(el){
    var modification_box = document.getElementById('modification_box_2');
    modification_box.style.display = "block";
}



