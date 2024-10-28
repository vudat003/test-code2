var input_hoten = document.getElementById('hoten');
var input_sdt = document.getElementById('sdt');
var input_email = document.getElementById('email');

function danhgiasp(){
    var stop_server = true;    

    var hoten = input_hoten.value;
    var sdt = input_sdt.value;
    var email = input_email.value;

    if(hoten == ''){
        input_hoten.style.borderColor = 'red';
        stop_server = false;
    }else{
        input_hoten.style.borderColor = 'blue';
    }

    if(sdt == ''){
        input_sdt.style.borderColor = 'red';
        stop_server = false;
    }else{
        input_sdt.style.borderColor = 'blue';
    }


    if(email == ''){
        input_email.style.borderColor = 'red';
        stop_server = false;
    }else{
        input_email.style.borderColor = 'blue';
    }
    return stop_server;
}

