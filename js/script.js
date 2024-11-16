function log_out(){
  var msg_success_3 = document.getElementById('success-msg-3');
  msg_success_3.style.display = "block";
  setTimeout(function() {
      msg_success_3.style.display = "none";
    }, 1500);
    document.cookie = "id_cookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function getCookie(name) {
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(name + '=')) {
      return cookie.substring(name.length + 1);
    }
  }
  return null;
}
var curent_pos_path = "Home/";
var direction_path = {};
var todos;
var all_status;
var all_window_content;
var desktop_elem;
var option_elem;
var dynamic_app;
//var all_boxs;
var apps;
var all_file_page;
const new_filebox_part = '<div id="toplace" class="filebox"> <li class="todo" ondragstart="dragStart(event)"></li> </div>';
//var todos = document.querySelectorAll(".todo");
//console.log(todos);
//var all_status = document.querySelectorAll(".filebox");
function update_variable() {
  todos = document.querySelectorAll(".todo");
  all_status = document.querySelectorAll(".filebox");
  all_window_content = document.querySelectorAll("#window-content");
  desktop_elem = document.querySelectorAll(".filebox");
  option_elem = document.querySelectorAll(".option");
  dynamic_app = document.getElementById('dynamic-app');
  apps = dynamic_app.querySelectorAll('li');
  all_file_page = document.querySelectorAll(".file_page");
  //console.log(todos);
  //console.log(all_status);
  
}
update_variable();
/**
 ----------------windows navigator switch----start---------------------------------------------
*/
let docTitle = document.title;
window.addEventListener ( "blur" ,()=>{
  document.title="Come Back";
});

window.addEventListener ( "focus" ,()=>{
  document.title= docTitle;
});

/**
 ----------------windows navigator switch----end---------------------------------------------
*/

/**
 ----------------Fullscreen----start---------------------------------------------
*/

function toggleFullScreen() {
if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
    (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {  
    document.documentElement.requestFullScreen();  
    } else if (document.documentElement.mozRequestFullScreen) {  
    document.documentElement.mozRequestFullScreen();  
    } else if (document.documentElement.webkitRequestFullScreen) {  
    document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
    }  
} else {  
    if (document.cancelFullScreen) {  
    document.cancelFullScreen();  
    } else if (document.mozCancelFullScreen) {  
    document.mozCancelFullScreen();  
    } else if (document.webkitCancelFullScreen) {  
    document.webkitCancelFullScreen();  
    }  
}  
}
/**
 ----------------Fullscreen----end---------------------------------------------
*/
/**
 ----------------date + clock ----start---------------------------------------------
*/
const timeElement = document.querySelector(".time");
const dateElement = document.querySelector(".date");

/**
 * @param {Date} date
 */
function formatTime(date) {
const hours12 = date.getHours() % 12 || 12;
const minutes = date.getMinutes();
const isAm = date.getHours() < 12;

return `${hours12.toString().padStart(2, "0")}:${minutes
    .toString()
    .padStart(2, "0")} ${isAm ? "AM" : "PM"}`;
}

/**
 * @param {Date} date
 */
function formatDate(date) {
const DAYS = [
    "Sun",
    "Mon",
    "Tues",
    "Wednes",
    "Thurs",
    "Fri",
    "Satur"
];
const MONTHS = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec"
];

return `${DAYS[date.getDay()]}, ${
    MONTHS[date.getMonth()]
} ${date.getDate()} ${date.getFullYear()}`;
}

setInterval(() => {
const now = new Date();

timeElement.textContent = formatTime(now);
dateElement.textContent = formatDate(now);
}, 200);
/**
 ----------------date + clock -----end--------------------------------------------
*/







/**
 ----------------Dragge and resize Options -----start--------------------------------------------
*/


//console.log(all_window_content);
//var all_window_interface = document.querySelectorAll("#window-interface");
//console.log(all_window_interface);
//var parent = document.getElementById("window-content");
//var draggable = document.getElementById("window-interface");

function drag_all_windows(){
  all_window_content.forEach((this_elem) =>{
    var draggable =this_elem.children[0];
    //console.log(draggable.id);
    let isDragging = false;
    let currentX;
    let currentY;
    let initialX;
    let initialY;
    let xOffset = 0;
    let yOffset = 0;
    draggable.addEventListener("mousedown", dragStart);
    draggable.addEventListener("mouseup", dragEnd);
    draggable.addEventListener("mouseout", dragEnd);
    draggable.addEventListener("mousemove", drag);
    function dragStart(e) {
      //console.log("drag start");
      //console.log(all_window_content);
      initialX = e.clientX - xOffset;
      initialY = e.clientY - yOffset;
      //console.log(currentX);
      //console.log(currentY);
      //console.log(initialX);
      //console.log(initialY);
      if (e.target === draggable) {
        isDragging = true;
      }
    }
    
    function dragEnd(e) {
      //console.log("drag end");
      initialX = currentX;
      initialY = currentY;
      //console.log(currentX);
      //console.log(currentY);
      //console.log(initialX);
      //console.log(initialY);
    
      isDragging = false;
    }
    
    function drag(e) {
      if (isDragging) {
        e.preventDefault();
        currentX = e.clientX - initialX;
        currentY = e.clientY - initialY;
    
        xOffset = currentX;
        yOffset = currentY;
        if (currentX < 0) {
          currentX = 0;
        }
        if (currentY < 0) {
          currentY = 0;
        }
        if (currentX + draggable.offsetWidth > this_elem.offsetWidth) {
          currentX = this_elem.offsetWidth - draggable.offsetWidth;
        }
        if (currentY + draggable.offsetHeight > this_elem.offsetHeight) {
          currentY = this_elem.offsetHeight - this_elem.offsetHeight;
        }
    
        setTranslate(currentX, currentY, draggable);
      }
    }
    
    function setTranslate(xPos, yPos, el) {
      el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
    }
  });
}

drag_all_windows()








/**
 ----------------Dragge and resize Options -----end--------------------------------------------
*/












/**
 ----------------desktop rep -----start--------------------------------------------
*/

function open_app_inside(insideapp){
  console.log("open_app_inside");
  console.log(dict);
  console.log("list_num_box_desktop : " + list_num_box_desktop);
  console.log("list_name_files : " + list_name_files);
  console.log("direction_path : " + direction_path)
  //console.log("curent_pos_path : " + curent_pos_path);
}



function dragOver(e) {
  e.preventDefault();
  //console.log(draggableTodo);
  //console.log("dragOver");
};
function dragEnter() {
  this.style.backgroundColor = "var(--hover-color-file)";
  //console.log("dragEnter");
  //console.log(draggableTodo);
};
function dragLeave() {
  this.style.border = "none";
  //console.log("dragLeave");
  this.style.backgroundColor = "";
};
function dragEnd() {
  //console.log(this);
  setTimeout(() => {
    this.style.display = "block";
  }, 0);
  draggableTodo = '';
  exported_box = null;
  //console.log("dragEnd");
};

var all_boxs = document.querySelectorAll(".filebox");
var draggableTodo;
var exported_box;
var li_box;
var parent_box;

function dragStart(event) {
  var element = event.target;
  var parentElement = element.parentNode;
  li_box = event.target;
  //console.log(element);
  //console.log(parentElement);
  parent_box = parentElement;
  setTimeout(() => {
    li_box.style.display = "none";
  }, 0);
  draggableTodo = element.children[0].getAttribute("file-id");
  exported_box = element;
  //console.log(draggableTodo);
  //console.log(element.children[0]);  
};


all_boxs.forEach((status) => {
  status.addEventListener("dragover", dragOver);
  status.addEventListener("dragenter", dragEnter);
  status.addEventListener("dragleave", dragLeave);
  status.children[0].addEventListener("dragend",dragEnd);
  status.addEventListener("drop", ()=>{
    var dest_box = status;
    dest_box.style.border = "none";
    dest_box.style.backgroundColor = "";

        var part = draggableTodo.split("_");
        var num_id = part[1];
        var dest_pos_num = Array.from(all_boxs).indexOf(status);
        if(num_id == dest_pos_num){
          console.log("nothing moved");
        }
        else if(dest_box.children[0].innerHTML == "" && (num_id != dest_pos_num)){
          
          //console.log("part :" + part);

          //console.log("num_id :" + num_id);
          
          //console.log(dest_pos_num);
          var file_name = part[0] + "_" + dest_pos_num;
          document.getElementById(draggableTodo).setAttribute("id",file_name);
          exported_box.children[0].setAttribute("file-id",file_name);
          //exported_box.children[1].innerHTML = file_name;
          dest_box.prepend(exported_box);
          dest_box.children[1].remove();
          for (let i = 0; i < list_num_box_desktop.length; i++) {
            if (list_num_box_desktop[i] == num_id) {
              list_num_box_desktop[i] = dest_pos_num;
            }
          }
          //console.log(list_num_box_desktop);
          list_num_box_desktop.sort((a, b)=> a - b);
          //console.log(list_num_box_desktop);
          var para = document.createElement("li");
          para.setAttribute("class","todo");
          para.setAttribute("ondragstart","dragStart(event)");
          parent_box.appendChild(para);
          

          //dict['newKey'] = dict['originalKey'];
          //delete dict['originalKey'];






        }else{
          //list_num_box_desktop.splice(part[1],1);
          //console.log(list_num_box_desktop);  

          //console.log(document.getElementById(draggableTodo).outerHTML);   
          if (dest_box.children[0].children[0].getAttribute("file-icon") == "fa-folder"){
            console.log("not empty");
            var deplace_content = document.getElementById(draggableTodo);
            deplace_content.setAttribute("id","toplace_content");
            var deplace_dest = document.getElementById(dest_box.children[0].children[0].getAttribute("file-id"));
            deplace_dest.children[0].children[0].children[2].children[1].insertAdjacentHTML('beforeend', new_filebox_part);
            document.getElementById("toplace").children[0].append(exported_box.children[0]);
            document.getElementById("toplace").children[0].append(exported_box.children[0]);
            exported_box.removeAttribute("draggable");
            var all_file_main = document.querySelectorAll(".filebox");
            var dest_pos = Array.from(all_file_main).indexOf(document.getElementById("toplace"));
            //console.log("dest_pos : " + dest_pos);
            deplace_content.setAttribute("id",part[0]+"_"+dest_pos);
            deplace_content.setAttribute("file_path",curent_pos_path + dest_box.children[0].children[1].textContent);
            var old_path = document.getElementById("toplace").children[0].children[0].getAttribute("file_path");
            document.getElementById("toplace").setAttribute("draggable","True");
            document.getElementById("toplace").children[0].children[0].setAttribute("file_path",curent_pos_path + dest_box.children[0].children[1].textContent);
            document.getElementById("toplace").children[0].children[0].setAttribute("file-id",part[0]+"_"+dest_pos);
            document.getElementById("toplace").children[0].children[0].setAttribute("onclick","open_app_inside(this)");
            
            
            for (let i = 0; i < list_num_box_desktop.length; i++) {
              if (list_num_box_desktop[i] == part[1]) {
                list_num_box_desktop[i] = dest_pos;
                break;
              }
            }
            
            for (let i = 0; i < list_name_files.length; i++) {
              if (list_name_files[i] == old_path + document.getElementById("toplace").children[0].children[1].textContent) {
                list_name_files[i] = curent_pos_path + dest_box.children[0].children[1].textContent + "/" + document.getElementById("toplace").children[0].children[1].textContent;
                break;
              }
            }
            //console.log(document.getElementById("toplace").children[0].children[1].textContent);
            document.getElementById("toplace").removeAttribute("id");
            //list_num_box_desktop.push(dest_pos);
            direction_path[part[0]+"_"+dest_pos] = [curent_pos_path + dest_box.children[0].children[1].textContent , curent_pos_path + dest_box.children[0].children[1].textContent];
            //console.log(direction_path[part[0]+"_"+dest_pos]);
            //console.log(Object.keys(direction_path));



            






















            list_num_box_desktop.sort((a, b)=> a - b);
          }else{
            console.log("impossible it is a file ")
          };// fin test file type
        };








update_variable();
//console.log(list_num_box_desktop);
//console.log(list_name_files);
    li_box.style.display = "block";
    draggableTodo = '';
    exported_box = null;
    li_box = null;
    //all_boxs.forEach((tuto) => {
    //console.log(tuto.children[0]);
    //});
});



});// end foreeach








/**
 ----------------desktop rep -----end--------------------------------------------
*/




/**
 ----------------Right Clicks Options -----start--------------------------------------------
*/


//console.log(desktop_elem[0]);
var msg_info = document.getElementById('info-msg');
var msg_success = document.getElementById('success-msg-1');
var msg_warning = document.getElementById('warning-msg');
var msg_error = document.getElementById('error-msg-1');
var for_option=undefined;
var class_app_desk=undefined;


function isValidEmail(name) {
  return /[^A-Za-z0-9_\-()]/.test(name);
};
function cancel_change_name(){
  document.getElementById('change_name_block').style.display = "none";
};
function chose_box_name(){
  //console.log(x5);
  var block_name = '<div> <p>Change Name</p> <input type="text" id="change_name_inputField"  placeholder="New File" autocomplete="off"> </div> <div> <button id="change_name_buttonField" class="btn-style-15"  onclick="Apply_name()">Apply</button> <a onclick="cancel_change_name()">Cancel</a> </div>';
  document.getElementById("change_name_pop_block").innerHTML = block_name;
  document.getElementById('change_name_block').style.display = "block";
  var inputField = document.getElementById('change_name_inputField');
  var submitButton = document.getElementById('change_name_buttonField');

  // add event listener to input field to listen for changes
  inputField.addEventListener('input', function() {
    //console.log(typeof(inputField.value));
    //console.log(inputField.value);
    // check if input is valid (in this example, checking if it's a valid email address)
    if (isValidEmail(inputField.value)) {
      // name invalid
      submitButton.disabled = true;
      inputField.style.color = 'red';
      inputField.style.animation = 'shake 350ms';
    } else {
      // name valid
      submitButton.disabled = false;
      inputField.style.color = '';
    };
    return;
  });
};
function Apply_name(){
  var submitButton = document.getElementById('change_name_buttonField');
  submitButton.addEventListener('click',()=>{
    var inputField = document.getElementById('change_name_inputField');
    //var old_name = x5.children[1].innerHTML;
    //console.log(old_name);
    document.getElementById('change_name_block').style.display = "none";
    var string_value = inputField.value;
    //console.log(inputField.value);
    
    document.getElementById("change_name_pop_block").children[0].remove();
    //console.log(list_name_files);
    var x77;
    if(optionapp == "Folder"){
      x77="folder_";
    }else if(optionapp == "File"){
      x77="File_";
    };
  if(string_value == ""){
    var filteredList = list_name_files.filter(item => item.startsWith(curent_pos_path + "New" + x77)).sort();
    //console.log("filteredList : " + filteredList);
    var nexist = 0;
    var counter = 1;
    
    var check = curent_pos_path + "New" + x77 + counter.toString();;
    if (filteredList.length > 0){
      while(nexist == 0){
        for (var i = 0; i < filteredList.length; i++){
          //console.log("__________________");
          //console.log(typeof(filteredList[i]));
          //console.log(typeof(check));
          if (filteredList[i] === check){

            counter = counter + 1;
            check = curent_pos_path + "New" + x77 + counter.toString();
           // console.log("not break");
            //console.log(check);
          }
          if(filteredList[i] != check){
            nexist = nexist + 1;
          };
    
        };//end for
        //console.log(counter);
      }
    }//end if
    //console.log(counter);
      string_value ="New" + x77 + counter.toString();
      list_name_files.push(check);

  }else{
    list_name_files.push(curent_pos_path + string_value);
  };
  //console.log(list_name_files);
  //console.log("filteredList : " + filteredList);
    Newboxs(optionapp,string_value);
    inputField.value = "";
    check ='';
  });
  return;
};
function Apply_rename(){
  var submitButton = document.getElementById('change_name_buttonField');
  submitButton.addEventListener('click',()=>{
    var inputField = document.getElementById('change_name_inputField');
    //var old_name = x5.children[1].innerHTML;
    //console.log(old_name);
    document.getElementById('change_name_block').style.display = "none";
    var string_value = inputField.value;
    //console.log(inputField.value);
    
    document.getElementById("change_name_pop_block").children[0].remove();
    //console.log(list_name_files);

  if(string_value != ""){
    if (!list_name_files.includes(curent_pos_path + string_value)){
      var old_name = for_option.children[0].children[1].textContent;
      //console.log(string_value);
      var check = curent_pos_path + old_name;
      for (var i = 0; i < list_name_files.length; i++){
  
        if (string_value == list_name_files[i]){
          //console.log("name exist : " + string_value);
          break;
        }
        if (list_name_files[i] == check){
          list_name_files[i] = curent_pos_path + string_value;
          //console.log(string_value);
          //console.log("list_name_files : " + list_name_files);
          for_option.children[0].children[1].textContent = string_value;
          break;
        }
      }
    }
  };




  });
};

function chose_box_rename(){
  //console.log(x5);
  var block_name = '<div> <p>Change Name</p> <input type="text" id="change_name_inputField"  placeholder="New File" autocomplete="off"> </div> <div> <button id="change_name_buttonField" class="btn-style-15"  onclick="Apply_rename()">Apply</button> <a onclick="cancel_change_name()">Cancel</a> </div>';
  document.getElementById("change_name_pop_block").innerHTML = block_name;
  document.getElementById('change_name_block').style.display = "block";
  var inputField = document.getElementById('change_name_inputField');
  var submitButton = document.getElementById('change_name_buttonField');

  // add event listener to input field to listen for changes
  inputField.addEventListener('input', function() {
    //console.log(typeof(inputField.value));
    //console.log(inputField.value);
    // check if input is valid (in this example, checking if it's a valid email address)
    if (isValidEmail(inputField.value)) {
      // name invalid
      submitButton.disabled = true;
      inputField.style.color = 'red';
      inputField.style.animation = 'shake 350ms';
    } else {
      // name valid
      submitButton.disabled = false;
      inputField.style.color = '';
    };
    return;
  });
};
desktop_elem.forEach((desk_app) => {
    desk_app.addEventListener('contextmenu', function(event) {
        // Prevent the default context menu from appearing
        //alert('You right-clicked!');
        var xPos_cursor = event.clientX;
        var yPos_cursor = event.clientY;
        //console.log(xPos_cursor);
        //console.log(yPos_cursor);
        //console.log(this.children[0].children.length);
        if(this.children[0].children.length == 0){
             class_app_desk = document.getElementById('drop-menu-1');
             document.getElementById('drop-menu-2').style.display = "none";
            //console.log(class_app_desk);
            //console.log("menu_1");
        }else{
             class_app_desk = document.getElementById('drop-menu-2');
             document.getElementById('drop-menu-1').style.display = "none";
            //console.log(class_app_desk);
            //console.log("menu_2");
        };
        class_app_desk.style.display = "block";
        class_app_desk.style.left = (xPos_cursor-150) + "px";
        class_app_desk.style.top = yPos_cursor + "px";
        for_option=this;
        //console.log(for_option);
        event.preventDefault();
      });// end contextmenu
});//end each

function paste_boxs(x3,curent_pos_path_loc,x4,list_c){
  var to_paste_continer_loc = x3.cloneNode(true);
  let texte = to_paste_continer_loc.children[1].textContent;
  //console.log("thelist : " +list_name_files);
  //var Type_file = to_paste_continer_loc.children[0].getAttribute("file-icon");
  var indice_pos_exist= list_name_files.indexOf(curent_pos_path + texte);
  //console.log(indice_pos_exist);
  if (indice_pos_exist > -1){
    let num = 0;
    var indice_pos = 2;
    while(indice_pos > 0){
      num = num + 1;
      indice_pos = list_name_files.indexOf(curent_pos_path + texte + "(" + num + ")");
      //console.log("indice_pos" + indice_pos);
    };
    texte += "(" + num + ")";

  };
  to_paste_continer_loc.children[1].textContent = texte;
  list_name_files.push(curent_pos_path + texte);
  list_name_files.sort();





  



















  var copy_content_continer_loc = x4.cloneNode(true);
  //console.log(to_paste_continer_loc);
  //console.log("copy_content_continer_loc" + copy_content_continer_loc);
  var y =0;
  var x = 0;
  if (list_num_box_desktop.length >0){
    while(y != -1) {
      if(list_num_box_desktop.indexOf(x) == -1)  {
        y = -1;
      }else{  
        x= x + 1;
      } ;
    };
  };
  var the_file_icon = to_paste_continer_loc.children[0].getAttribute("file-icon");
  //console.log(to_paste_continer_loc.children[0]);
  //console.log(the_file_icon);
  var content = '';
  var file_id;
  if(the_file_icon == "fa-folder"){
    file_id = "folder_" + x ;
      content = copy_content_continer_loc.children[0].children[0].children[2].children[1];
      content.innerHTML += "  to  " + file_id;
      copy_content_continer_loc.setAttribute("file_path",curent_pos_path_loc);
  };
  if(the_file_icon == "fa-file"){
      file_id="File_" + x;
      copy_content_continer_loc.setAttribute("id",file_id);
      to_paste_continer_loc.children[0].setAttribute("file-id",file_id);
      var newp = document.createElement('p');
      newp.innerHTML += "  to  " + file_id;
      content = copy_content_continer_loc.children[0].children[0].children[2];
      content.appendChild(newp);
  };
  copy_content_continer_loc.setAttribute("id",file_id);
  to_paste_continer_loc.children[0].setAttribute("file-id",file_id);
  //console.log(copy_content_continer_loc);
  document.body.appendChild(copy_content_continer_loc);
  list_num_box_desktop.push(x);
  //console.log(content);
  //console.log(copy_continer_loc);
  list_c[x].appendChild(to_paste_continer_loc);
  list_c[x].children[0].remove();

  update_variable();
  drag_all_windows();
  //console.log(list_c[x]);
  x = 0;
  console.log(list_name_files);
};
function Newboxs(optionapp,string_value){
  var x1;
  var x2;
  var x4;
  if(optionapp == "Folder"){
    x1="fa-folder";
    x2="folder_";
    x4=string_value;
  }else if(optionapp == "File"){
    x1="fa-file";
    x2="File_";
    x4=string_value;
  };
  var y =0;
  var x = 0;
  if (list_num_box_desktop.length >0){
    while(y != -1) {
      if(list_num_box_desktop.indexOf(x) == -1)  {
        //console.log("No, the value is absent.");
        //console.log(x);
        //console.log(list_num_box_desktop);
        y = -1;
        
      }else{  
        //console.log("Yes, the value exists!" + list_num_box_desktop.indexOf(x));
        x= x + 1;
      } ;
    };
  };
  //all_boxs.forEach((box) => {
  //console.log(all_boxs[x]);
  //console.log(box); list_num_box_desktop
  all_boxs[x].children[0].setAttribute("draggable","true");
  all_boxs[x].children[0].innerHTML = '<i class="fa-solid ' + x1 +'" onclick="open_app(this)" file_path="' + curent_pos_path + '" file-id="' + x2 + x + '"file-icon="' + x1 +'"></i><p>'+ x4 +'</p>';
  var newDiv = document.createElement('div');
  newDiv.setAttribute("id",x2 + x);
  newDiv.setAttribute("file-icon",x1);
  newDiv.style.display = "none";
  newDiv.setAttribute("class","window-app");
  newDiv.setAttribute("file_path",curent_pos_path);
  var htmlBlock;
  if (x2 == "File_"){
    htmlBlock = '<div id="window-content"> <div id="window-interface"> <div class="win-left"> <li><i class="fa-solid ' + x1 + '"></i></li> </div> <div class="win-right"> <ul> <li onclick="winMin()"><i class="fa-solid fa-window-minimize"></i></li> <li onclick="winResize()"><svg fill="none" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg"> <path class="p1" d="m4.5 3c-.82843 0-1.5.67157-1.5 1.5v7c0 .8284.67157 1.5 1.5 1.5h7c.8284 0 1.5-.6716 1.5-1.5v-7c0-.82843-.6716-1.5-1.5-1.5zm0 1h7c.2761 0 .5.22386.5.5v7c0 .2761-.2239.5-.5.5h-7c-.27614 0-.5-.2239-.5-.5v-7c0-.27614.22386-.5.5-.5z" fill="var(--third-color)" /> </svg></li> <li onclick="winClose()"><i class="fa-solid fa-xmark"></i></li> </ul> </div> <div class="win-main text_editor color_theme_third_color"> <div id="text-input" contenteditable="true"></div> </div> </div> </div>';
  }
  else if (x2 == "folder_"){
    htmlBlock = '<div id="window-content"> <div id="window-interface"> <div class="win-left"> <li><i class="fa-solid ' + x1 + '"></i></li> </div> <div class="win-right"> <ul> <li onclick="winMin()"><i class="fa-solid fa-window-minimize"></i></li> <li onclick="winResize()"><svg fill="none" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg"> <path class="p1" d="m4.5 3c-.82843 0-1.5.67157-1.5 1.5v7c0 .8284.67157 1.5 1.5 1.5h7c.8284 0 1.5-.6716 1.5-1.5v-7c0-.82843-.6716-1.5-1.5-1.5zm0 1h7c.2761 0 .5.22386.5.5v7c0 .2761-.2239.5-.5.5h-7c-.27614 0-.5-.2239-.5-.5v-7c0-.27614.22386-.5.5-.5z" fill="var(--third-color)" /> </svg></li> <li onclick="winClose()"><i class="fa-solid fa-xmark"></i></li> </ul> </div> <div class="win-main color_theme_third_color"> <div class="search_path_section"> <ul class="option-nav"> <li><i class="fa-solid fa-left"></i></li> <li><i class="fa-solid fa-right"></i></li> <li><i class="fa-solid fa-house"></i></i> </li> </ul> <div class="file_search_path"> <input type="text" class="searchTerm" placeholder="'+ curent_pos_path + x4 + '"> <button type="submit" class="searchButton"><i class="fa fa-search"></i></button> </div> </div> <div id="file_main" class="file_main"></div> </div> </div> </div>';//' + x4 + '
  };
  newDiv.innerHTML = htmlBlock;
  //console.log(htmlBlock);
  //console.log(newDiv);
  document.body.appendChild(newDiv);
  list_num_box_desktop.push(x);
  update_variable();
  drag_all_windows();
  newDiv="";
  htmlBlock="";
  optionapp = '';
  x = 0;
};
var copy_continer;
//var copy_path_continer;
var copy_content_continer;
var optionapp;
option_elem.forEach((option_desk) => {
    option_desk.addEventListener('click', function() {
        class_app_desk.style.display = "none";
        if(this.getAttribute("optionapp") =="Delete"){
            var pivot_option =  document.getElementById(for_option.children[0].children[0].getAttribute('file-id'));
            //console.log(pivot_option.id);
            var test_x=0;
            for (var key in dict) {
                if (dict[key] == pivot_option.id) {
                  //console.log("La valeur existe dans l'objet.");
                  test_x=(-1);
                  break; // Sortir de la boucle car la valeur a été trouvée
                };
            };
            if (test_x == 0){
                var parts = pivot_option.id.split("_"); // split the string at "_"
                var num = parseInt(parts[1]); // parse the second part as an integer
                var name_app = for_option.children[0].children[1].textContent;
                console.log(name_app);
                console.log(list_name_files.indexOf(curent_pos_path + name_app));
                list_name_files.splice(list_name_files.indexOf(curent_pos_path + name_app), 1); 
                console.log(list_name_files);

                
                var numIndex = list_num_box_desktop.indexOf(num);
                list_num_box_desktop.splice(numIndex, 1);
                list_num_box_desktop.sort((a, b)=> a - b);
                //console.log(list_num_box_desktop);
                pivot_option.remove();
                while (for_option.children[0].firstChild) {
                    for_option.children[0].removeChild(for_option.children[0].firstChild);
                };
                for_option.children[0].removeAttribute('draggable');
                //console.log(msg_success);
                msg_success.style.display = "block";
                setTimeout(function() {
                    msg_success.style.display = "none";
                  }, 1000);
            };
            if (test_x == (-1)){
                msg_error.style.display = "block";
                setTimeout(function() {
                    msg_error.style.display = "none";
                    }, 1000);
                    test_x =0;
            };
        };//end delete
        if(this.getAttribute("optionapp") =="Change_Background"){
            var background_image = document.getElementById('main-d');
            if(image_counter == list_name_image.length - 1){
              image_counter=0;
            }else{
              image_counter = image_counter + 1;
            }

            background_image.style.backgroundImage = "url('../images/" + list_name_image[image_counter]; +"')";
            var bg=background_image .style.backgroundImage;
            console.log(bg);
        };
        if(this.getAttribute("optionapp") == "Folder"){
          //console.log("create Folder");
          optionapp = "Folder";
          chose_box_name();
          //console.log("inputField.value : " + file_name);
          
          //console.log(list_num_box_desktop);
        };
        if(this.getAttribute("optionapp") == "File"){
          //console.log("create File");
          optionapp = "File";
          chose_box_name();
          //console.log(list_num_box_desktop);
        };
        if(this.getAttribute("optionapp") =="Copy"){
          //console.log(option_desk);
          //console.log(for_option);
          if(document.getElementById("tocopy")){
            document.getElementById("tocopy").remove();
          };
          copy_continer = for_option.children[0].cloneNode(true);
          //copy_path_continer = curent_pos_path;
          copy_content_continer = document.getElementById(copy_continer.children[0].getAttribute("file-id")).cloneNode(true);
          copy_content_continer.setAttribute("id","tocopy");
          //console.log(copy_continer);
          //console.log(copy_path_continer);
          //console.log(copy_content_continer);
        };//end copy option
        if(this.getAttribute("optionapp") =="Cut"){
          if(document.getElementById("tocopy")){
            document.getElementById("tocopy").remove();
          };
          //console.log(option_desk);
          copy_continer = for_option.children[0];
          //console.log(list_name_files);
          list_name_files.splice(list_name_files.indexOf(curent_pos_path + copy_continer.children[1].textContent), 1); 
          //console.log(list_name_files);
          console.log(list_name_files.sort());
          list_name_files.sort();
          parent_continer = copy_continer.parentNode;
          //copy_path_continer = curent_pos_path;
          //console.log(copy_path_continer);
          var continer_pos = Array.from(all_boxs).indexOf(parent_continer);
          //console.log(continer_pos);
          for (let i = 0; i < list_num_box_desktop.length; i++) {
            if (list_num_box_desktop[i] == continer_pos) {
              list_num_box_desktop.splice(i,1);
            }
          }
          list_num_box_desktop.sort((a, b)=> a - b);
          //console.log(list_num_box_desktop);
          var cara = document.createElement("li");
          cara.setAttribute("class","todo");
          cara.setAttribute("ondragstart","dragStart(event)");
          parent_continer.appendChild(cara);
          parent_continer.children[0].remove();
          copy_content_continer = document.getElementById(copy_continer.children[0].getAttribute("file-id"));
          copy_content_continer.setAttribute("id","tocopy");
          copy_continer.children[0].setAttribute("file-id","tocopy");
          console.log(copy_continer);
          //console.log(copy_path_continer);
          console.log(copy_content_continer);
        };//end cut
        if(this.getAttribute("optionapp") =="Paste"){
          paste_boxs(copy_continer,curent_pos_path,copy_content_continer,all_boxs);
        };
        if(this.getAttribute("optionapp") =="Rename"){
          //var todo_continer = for_option.children[0];
          chose_box_rename();
          //change_box_name(todo_continer);


        };



        pivot_option = '';
    });//end click
});//endforeach  



//close drop-menu 1&2
window.onclick = (e) => {
  if (!e.target.matches('#drop-menu-1')) {
    document.getElementById('drop-menu-1').style.display = "none";
  }
  if (!e.target.matches('#drop-menu-2')) {
    document.getElementById('drop-menu-2').style.display = "none";
  }
  if ((!e.target.matches('#drop-menu-3')) && ((!e.target.matches('#user_profil')))) {
    document.getElementById('drop-menu-3').style.display = "none";
  }
  
  if ((!e.target.matches('#notif_box')) && ((!e.target.matches('#notif')))) {
    document.getElementById('notif_box').style.display = "none";
  }
  //if ((!e.target.matches('#notification_block')) && ((!e.target.matches('#notif')))) {
    //document.getElementById("notification_block").style.display = "none";
  //}

};
/**
 ----------------Right Clicks Options -----end--------------------------------------------
*/


















/**
 ----------------app bar -----start--------------------------------------------
*/
  apps.forEach(item => {
    item.addEventListener('dragstart', dragStartApp);
    item.addEventListener('dragover', dragOverApp);
    item.addEventListener('dragenter', dragEnterApp);
    item.addEventListener('dragleave', dragLeaveApp);
    item.addEventListener('drop', dropApp);
    item.addEventListener('dragend', dragEndApp);
  });
  var initial_app="";
  // Define the drag and drop functions
  let drag_app = null;
  function dragStartApp(event) {
    drag_app = this;
    initial_app=drag_app.id;
    //console.log(drag_app.id);
    //console.log(initial_app);
  }
  
  function dragOverApp(event) {
    event.preventDefault();
  };
  
  function dragEnterApp(event) {
    event.preventDefault();
    this.classList.add('over');
    //console.log(this);
    
  };
  
  function dragLeaveApp(event) {
    this.classList.remove('over');
    //console.log("dragleave");
    //console.log(this);
  };
  
  function dropApp(event) {
    this.classList.remove('over');
    //console.log("drop");
    //console.log(this);
    if(dict[this.id]!=dict[initial_app]){
    var app_change = dict[this.id];
    dict[this.id]=dict[initial_app];
    dict[initial_app]=app_change;
    app_change="";
    var app_i_1= document.getElementById(this.id);
    var classList_1 = app_i_1.children[0].classList;
    if (classList_1.length == 2) {
        var classe_1=classList_1.item(1);
        //console.log(classe_1);
        classList_1.remove(classList_1.item(1));
    }
    var app_i_2= document.getElementById(initial_app);
    var classList_2 = app_i_2.children[0].classList;
    if (classList_2.length == 2) {
        var classe_2=classList_2.item(1);
        //console.log(classe_2);
        classList_2.remove(classList_2.item(1));
    }
    app_i_1.children[0].classList.add(classe_2);
    app_i_2.children[0].classList.add(classe_1);
    //console.log(this.id);
    //dynamic_app.insertBefore(drag_app, this);
  }
    console.log(dict);
  };
  
  function dragEndApp(event) {
    drag_app = null;
  };
/**
 ----------------app bar -----end--------------------------------------------
*/


/**
 ---------------- notification  -----start--------------------------------------------
*/
 function  open_notif_box(){
  var notif= document.getElementById("notif_box");


  if(notif.style.display == "block"){
    notif.style.display = "none";
  }else {
    notif.style.display = "block";
  };
 };


 function close_notif(){
  document.getElementById("notification_block").style.display = "none";
  document.getElementById("notif-interface").style.backgroundColor = "";
};
  function open_notif(er){
    
    //console.log(er);
    //console.log(er.classList[0]);
    
    

  document.getElementById("notif-interface").style.backgroundColor = "var(--hover-color-file)";
    //var cookies = document.cookie;
    //console.log(cookies);
    //console.log(er.getAttribute("id_notif"));
    //var idValue = getCookie('id_cookie');
    //console.log(idValue); 
    var id_notif = er.getAttribute("id_notif"); 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert("jasser : " + xhttp.responseText);
        if (xhttp.responseText != "0" ){

          document.getElementById("icon_parent").innerHTML = '<div id="notif_cercle">' + xhttp.responseText +'</div>' ;
        }else{
          document.getElementById("icon_parent").innerHTML = '' ;
    }
        
      }
    };
    xhttp.open("POST", "php/update_status.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id_notif=" + id_notif);

          
    var h1Element = (er.querySelector('.' + (er.classList[0]) + ' h1')).textContent;
    //console.log(h1Element);

    var pElement = (er.querySelector('.' + (er.classList[0]) + ' p')).textContent;
    //console.log(pElement);
    var h4Element = (er.querySelector('.' + (er.classList[0]) + ' h4')).textContent;
    //console.log(h4Element);








    var text ='<h1>' + h1Element +'</h1><br><h3>' + h4Element + '</h3><br>' + '<p>' + pElement + '</p>';
    //document.getElementById("notif_box").style.display = "none";
    document.getElementById("notification_block").style.display = "block";
    document.getElementById("notif_pop_block_content").innerHTML = text;
  };


  setInterval(function(){

    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let responseText = this.responseText;
     // let toBeRemove = "<!-- PHP code (in notification.php) -->\r\n";
      //responseText = responseText.replace(toBeRemove,'');

        //var data = JSON.parse(responseText);
        //console.log(data); // will output ["apple", "banana", "orange"]
        //console.log(data);
        //console.log(this);
        
        var jsonResponse = JSON.parse(responseText);
        //console.log(jsonResponse);
        //console.log(jsonResponse[0][1]);
        var text ="";
        var nb_non_read = 0;
        //document.getElementById("notif_cercle").innerHTML = jsonResponse.length;
        for(var i = 0; i < jsonResponse.length; i++){
          var vstyle = '';
          if(jsonResponse[i][3] == "1"){
            $_status="Not read";
            nb_non_read = nb_non_read + 1;
            vstyle = 'style="background-color: var(--primary-color) !important;"'
        }else if(jsonResponse[i][3] == "0"){
            $_status="Readed";
            vstyle = 'style="background-color: var(--third-color) !important;"'
        }
        
        text +=  '<div id="notif_msg_box" ' + vstyle + ' class="notif_msg_box" onclick="open_notif(this)" id_notif="' + jsonResponse[i][4] + '"> <div class="notif_msg_box_left"><img src="/images/system.svg"></img></div><div class="notif_msg_box_right"><h1>' + jsonResponse[i][0] + '</h1><h4>' + jsonResponse[i][1] + '</h4><div class="notif_msg-box_right_bottom"><p>' + jsonResponse[i][2] + '</p><p>' + $_status + '</p></div></div></div>';

        }
        if (nb_non_read !=0 ){
          document.getElementById("icon_parent").innerHTML = '<div id="notif_cercle">' + nb_non_read +'</div>' ;
        }else{
          document.getElementById("icon_parent").innerHTML = '' ;
    }
        
        document.getElementById("notif_box").innerHTML=text;
      }
    };
    
    xmlhttp.open("GET", "php/notification.php", true);
    xmlhttp.send();

  },4000);










/**
 ---------------- notification  -----end--------------------------------------------
*/
