function profil_img_change(){
  document.getElementById('image_form').style.display = "block"
}
function profil_img_btn(){
  document.getElementById('image_form').style.display = "none"
}
function uploadImage() {
  var fileInput = document.getElementById('file_input');
  var file = fileInput.files[0];
  var formData = new FormData();
  formData.append('file', file);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      //var jsonResponse = JSON.parse(xhr); // parse the JSON response
      //string.split(delimiter, limit)
      //console.log(xhr);
      //document.getElementById('image_preview').innerHTML = jsonResponse.myString_1 + "<br>" + jsonResponse.myString_2; // display the response
      //document.getElementById('image_preview').innerHTML = jsonResponse;
      let responseText = xhr.responseText;
      let toBeRemove = "<!-- PHP code (in upload.php) -->\r\n";
      responseText = responseText.replace(toBeRemove,'');

      var jsonResponse = JSON.parse(responseText);

      var myString1Value = jsonResponse.myString_1;
      var myString2Value = jsonResponse.myString_2;

      if(myString2Value == "Your profile photo was successfully modified"){
        //document.getElementById('image_preview').innerHTML = myString2Value;
        document.getElementById('image_form').style.display = "none"
        document.getElementById("success-msg-2").style.display = "block";
        setTimeout(function() {
            document.getElementById("success-msg-2").style.display = "none";
        }, 1000);
        var new_image_url="../php/" + myString1Value;
        document.getElementById("profile_img").style.backgroundImage = "url(" + new_image_url + ")";
      }else{
        document.getElementById('image_preview').innerHTML = jsonResponse.myString_1 + "<br><br>" + jsonResponse.myString_2;
      }
      //console.log(myString1Value); // "uploads/ezfff.PNG"
      //console.log(myString2Value); // "Your profile photo was successfully modified"

    }
  };
  xhr.open('POST', 'php/upload.php', true);
  xhr.send(formData);
}




