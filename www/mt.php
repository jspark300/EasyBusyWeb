<!DOCTYPE html>  
<html>  
<head>  
  <title>File API Demo</title> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
</head> 
<body>  

  <h1>File API Demo</h1> 
  <h3>파일(들)을 선택해 주세요.</h3> 
  <input id="files-upload" type="file" multiple accept="image/*"> 
   
  <h3>Uploaded files</h3>  
  <ul id="file-list">  
    <li class="no-items">(파일이 선택되지 않음)</li>  
  </ul> 

  <script> 
    var filesUpload = document.getElementById("files-upload"), 
        fileList = document.getElementById("file-list"); 
     
    function traverseFiles (files) { 
      var li, 
          file, 
          fileInfo; 
      fileList.innerHTML = ""; 
         
      for (var i=0, il=files.length; i<il; i++) { 
        li = document.createElement("li"); 
        file = files[i]; 
        fileInfo = "<div><strong>Name:</strong> "
                     + file.name + "</div>"; 
        fileInfo += "<div><strong>Size:</strong> "
                      + file.size + " bytes</div>"; 
        fileInfo += "<div><strong>Type:</strong> "
                      + file.type + "</div>"; 
        li.innerHTML = fileInfo; 
        fileList.appendChild(li); 
      }; 
    }; 
     
    filesUpload.onchange = function () { 
      traverseFiles(this.files); 
    }; 
  </script> 
</body>  
</html>