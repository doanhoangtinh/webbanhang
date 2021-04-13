<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<html>

<body>

  <button type="button" onclick="postForm('\<span><span>\');">Request data</button>


  <p id="demo"> </p>

  <?php 
    if (($_POST["id"]==1))
   echo " <span style='color: red;'>Chào,></span>"
  ?>

  <script>

function postForm(){
		$.post("",
			    {
			    	id: "1",
			    },
			    function(data,status){
			    	document.getElementById("demo").innerHTML =  data;
			     });
	}

    function loadDoc() {

      var data = new FormData();
      data.append('id', '1');

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
       
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("demo").innerHTML =  this.responseText;
        }
      };
      xmlhttp.open("POST", " ", true);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send(data);
    }
  </script>

</body>

</html>