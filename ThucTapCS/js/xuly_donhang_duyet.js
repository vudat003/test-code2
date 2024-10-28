function xuly_donhang_duyet() {
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementsByClassName("chuaduyet").innerHTML=xmlhttp.responseText; 
        } 
    }   
    xmlhttp.open("GET", "../ajax/xuly_donhang_duyet.php", true);
    xmlhttp.send();
}