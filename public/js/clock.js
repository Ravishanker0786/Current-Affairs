function currentTime() {
  var date = new Date(); /* creating object of Date class */
  var year = date.getFullYear();
  var month = updateTime((date.getMonth()+1));
  var day = updateTime(date.getDate());
  var hour = date.getHours();
  var min = date.getMinutes();
  var sec = date.getSeconds();
  hour = updateTime(hour);
  min = updateTime(min);
  sec = updateTime(sec);
  // alert(month);
  
  document.getElementById("clock").innerText = day+"-"+month+"-"+year+" "+hour + ":" + min + ":" + sec; /* adding time to the div */
    var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
}

function updateTime(k) {
  if (k < 10) {
    return "0" + k;
  }
  else {
    return k;
  }
}

currentTime(); /* calling currentTime() function to initiate the process */


// https://bitbucket.org/parshant78655/lottery/pull-requests/new?source=Saurabh&t=1