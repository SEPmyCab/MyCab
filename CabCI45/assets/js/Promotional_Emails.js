

function checkAll(element) {
     var checkboxes = document.getElementsByTagName('input');
     if (element.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
 
 
 
 function getRecipients() {
    var checkboxes = document.getElementsByName('emails');
    var vals = "";
    var count = 0;
    for (var i=0, n=checkboxes.length;i<n;i++) {
      if (checkboxes[i].checked) 
      {
      vals +=", ";    
      vals +=checkboxes[i].value;
      count++;
      }
    }
    vals = vals.substring(2);
    
    document.getElementById("recipients").value = vals;
    if(!vals){
        
        alert("Please Select Recipients!!");
        document.getElementById("emailSpan").textContent=0;
    }
    else{
        document.getElementById("spanCount").textContent="Send "+count+" Emails";
    }

 }
 


