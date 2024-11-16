var dict = {App_1: "",App_2: "",App_3: "",App_4: "",App_5: "",App_6: "",App_7: ""};
var list_num_box_desktop=[];
var list_name_files = [];
var image_counter=0;
var list_name_image = ["1.jpg","2.jpg","3.jpg","4.jpg","5.jpg"];
var test_file=false;
function open_app(elm) {
  //console.log("dict open_app");
  //console.log(dict);
  var app_open= elm;
  //console.log(app_open);
  for (const property in dict) {
    test_file=false;
    //console.log(`dict.${property}: ${dict[property]}`);
    if(dict[property]==app_open.getAttribute("file-id")){
      //console.log('App is running');
      test_file=true;
      var elemnt= document.getElementById(dict[property]);
      elemnt.style.display = "block";
      var property_element_id = document.getElementById(property);
      property_element_id.style.backgroundColor = "var(--primary-color-hover)";
      property_element_id.style.borderLeft ="5px solid var(--third-color)";
      var pivot= document.getElementById(property);
      (pivot.children[0]).classList.add(app_open.getAttribute("file-icon"));
      break;
    }
  }

  if(test_file === false){
    for (const property in dict) {
      //console.log(property);
      //console.log(`dict.${property}: ${dict[property]}`);
      if(dict[property] ==""){
        dict[property]=app_open.getAttribute("file-id");
        //console.log(app_open.getAttribute("file-id"));
        //console.log(dict[property]);
        test_file=false;
        var element= document.getElementById(dict[property]);
        element.style.display = "block";
        var property_element_id = document.getElementById(property);
        property_element_id.style.backgroundColor = "var(--primary-color-hover)";
        property_element_id.style.borderLeft ="5px solid var(--third-color)";
        var pivot= document.getElementById(property);
        //console.log(pivot.children[0]);
        (pivot.children[0]).classList.add(app_open.getAttribute("file-icon"));
        console.log('App Opened');

        break;
      }
    }
  }
}
/**
 ----------------  bar btns Click window -----start--------------------------------------------
*/
const Apps = document.getElementById("Apps");
const menu_apps = document.getElementById("menu_apps");



function winM() {
  if(window.getComputedStyle(menu_apps).display === "none")
    {
      menu_apps.style.display = "block";
      Apps.style.backgroundColor = "var(--primary-color-hover)";
      Apps.style.borderLeft ="5px solid var(--third-color)";
    }
    else{
      menu_apps.style.display = "none";
      Apps.style.backgroundColor = "";
      Apps.style.borderLeft ="";
    }
}
function winMin() {
  var app_to_min= event.target.parentNode.parentNode.parentNode.parentNode.parentNode;
  app_to_min.style.display = "none";
  var app_to_min_id= event.target.parentNode.parentNode.parentNode.parentNode.parentNode.id;
  var value_window_min =Object.keys(dict).find(key => dict[key] === app_to_min_id);
  var class_window_min= document.getElementById(value_window_min);
  //console.log(value_window);
  class_window_min.style.backgroundColor = "transparent";
}
function winT(elem) {
  var app_clicked= elem;
  if(dict[app_clicked] != ""){
    //console.log(app_clicked);
    //console.log(dict[app_clicked]);
    if(window.getComputedStyle(menu_apps).display != "none")
    {
      menu_apps.style.display = "none";
      Apps.style.backgroundColor = "";
      Apps.style.borderLeft ="";
    }
    var App_curent = document.getElementById(app_clicked);
    var App_curent_id = document.getElementById(dict[app_clicked]);
      if(window.getComputedStyle(App_curent_id).display === "none")
      {
        App_curent_id.style.display = "block";
        App_curent.style.backgroundColor = "var(--primary-color-hover)";
        //console.log(App_curent);
        App_curent.style.borderLeft ="5px solid var(--third-color)";
      }
      else{
        App_curent_id.style.display = "none";
        App_curent.style.backgroundColor = "";
      }
  }
}

function winResize() {
  var app_R= event.target.parentNode.parentNode.parentNode;
  var app_R_id= event.target.parentNode.parentNode.parentNode.id;
  //console.log(app_R);
  //console.log(app_R_id);
  if ((app_R.style.height === "500px") || (app_R.style.width === "800px" )) {
    app_R.style.top = "0px";
    app_R.style.left = "0px";
    app_R.style.height = "100%";
    app_R.style.width = "100%";
  } else {
    app_R.style.height = "500px";
    app_R.style.width = "800px";
  }
}

function winClose() {
  var app_to_close= event.target.parentNode.parentNode.parentNode.parentNode.parentNode;
  var app_to_colse_id= event.target.parentNode.parentNode.parentNode.parentNode.parentNode.id;
  //console.log(app_to_close);
  //console.log(app_to_colse_id);
  if(app_to_colse_id=="terminal-app"){
    commander("clear");
  };
  var sidebar_app_pos_id =Object.keys(dict).find(key => dict[key] === app_to_colse_id);
  app_to_close.style.display = "none";
  dict[sidebar_app_pos_id] = "";
  var list_of_app = Object.values(dict);
  for (const key in dict) {
    //console.log(key);
    //console.log(`dict.${key}: ${dict[key]}`);
    var element= document.getElementById(key);
    var classList_w = element.children[0].classList;
    if (classList_w.length == 2) {
      classList_w.remove(classList_w.item(1));
      element.style.backgroundColor = "transparent";
      element.style.borderLeft ="5px solid transparent";
    }
     
  }
  //console.log(dict);
  //console.log(list_of_app);
  dict = {App_1: "",App_2: "",App_3: "",App_4: "",App_5: "",App_6: "",App_7: ""};
  //console.log(dict);
  for(var i = 0; i < list_of_app.length; i++){
    if(list_of_app[i]!=""){
      var id_app_to_open = document.getElementById(list_of_app[i]);
      //console.log(list_of_app[i]);
      //console.log(id_app_to_open);
      for (const key in dict) {
        //console.log(key);
        //console.log(`dict.${key}: ${dict[key]}`);
        if(dict[key] ==""){
          var id_side_to_open = document.getElementById(key);
          dict[key]=list_of_app[i];
          test_file=false;
          id_side_to_open.children[0].classList.add(id_app_to_open.getAttribute("file-icon"));
          id_side_to_open.style.borderLeft ="5px solid var(--third-color)";
          break;
        }
      }
    }
  }
  //console.log("dict close_win");
  //console.log(dict);
  //return dict;
}

function winUser(){
  var drop_menu= document.getElementById("drop-menu-3");
  var user_profil= document.getElementById("user_profil");
  if(drop_menu.style.display == "block"){
    drop_menu.style.display = "none";
    user_profil.style.backgroundColor = "";
    user_profil.style.borderLeft ="";
  }else{
    drop_menu.style.display = "block";
    user_profil.style.backgroundColor = "var(--primary-color-hover)";
    user_profil.style.borderLeft ="5px solid var(--third-color)";
  }



}

function winUser_profil(){
  var user_profil= document.getElementById("user_profil");
  var drop_menu= document.getElementById("drop-menu-3");
  var profile_page= document.getElementById("profile_page");
  if(profile_page.style.display == "block"){

  }else{
    profile_page.style.display = "block";
  }
  drop_menu.style.display = "none";
  user_profil.style.backgroundColor = "transparent";
  user_profil.style.borderLeft ="5px solid transparent";
}

function close_profile() {
  var profile_page= document.getElementById("profile_page");
  profile_page.style.display = "none";
}

/**
 ---------------- bar btns Click window  -----end--------------------------------------------
*/
