var input_hoten = document.getElementById('hoten');
var input_tentaikhoan = document.getElementById('tentaikhoan');
var input_matkhau = document.getElementById('matkhau');
var input_nhaplai_matkhau = document.getElementById('nhaplai_matkhau');
var input_email = document.getElementById('email');
var input_sdt = document.getElementById('sdt');
var input_anhdaidien = document.getElementById('anhdaidien');

//lay duoi file trong hinh anh
function getExtension(filename){
    var parts =  filename.split('.');
    return parts[parts.length - 1];
}

//kiem tra hinh anh
function isImage(filename){
    var ext =  getExtension(filename);
    switch (ext.toLowerCase()){
        case 'jpg':
        case 'gif':
        case 'bmp':
        case 'png':
            return true;
    }
    return false;
}

function kiemTraFormDangKy(){
    //kiem tra ho va ten:
    var cheack_tentaikhoan = /^[A-Za-z][A-Za-z0-9]{5,14}$/;
    var cheak_matkhau = new RegExp("^(?=.*[A-Za-z])(?=.*[0-9])(?=.{5,})");
    var cheack_mail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var cheack_phone = /^[0-9]{10}$/;
    var stop_sever = true;
    //Kiem tra dang nhap ho va ten;
    var hoten = input_hoten.value;
    if(hoten == ''){
        input_hoten.style.borderColor = 'red';
        document.getElementById('error_hoten').innerHTML = 'Yêu cầu nhập họ và tên đầy đủ';
        stop_sever  = false;
    }else{
        input_hoten.style.borderColor = 'blue';
        document.getElementById('error_hoten').innerHTML = '';
    }
    //kiem tra ten tai khoan
    var tentaikhoan = input_tentaikhoan.value;
    if(tentaikhoan == ''){
        input_tentaikhoan.style.borderColor = 'red';
        document.getElementById('error_tentaikhoan').innerHTML = 'Yêu cầu nhập tên tải khoản';
        stop_sever  = false;
    }else{
        if(cheack_tentaikhoan.test(tentaikhoan)){
            input_tentaikhoan.style.borderColor = 'blue';
            document.getElementById('error_tentaikhoan').innerHTML = '';
        }else{
            input_tentaikhoan.style.borderColor = 'red';
            document.getElementById('error_tentaikhoan').innerHTML = 'Từ 6 kí tự trở lên bắt đầu bằng chữ cái';
            stop_sever  = false;
        }
    }
    //Kiem tra mat khau
    var matkhau = input_matkhau.value;
    if(matkhau == ''){
        input_matkhau.style.borderColor = 'red';
        document.getElementById('error_matkhau').innerHTML = 'Yêu cầu nhập mật khẩu';
        stop_sever = false;
    }else{
        if(cheak_matkhau.test(matkhau)){
            input_matkhau.style.borderColor = 'blue';
            document.getElementById('error_matkhau').innerHTML = '';
        }else{
            input_matkhau.style.borderColor = 'red';
            document.getElementById('error_matkhau').innerHTML = 'Mật khẩu bao gồm chữ cả số';
            stop_sever = false;
        }
    }
    //kiem tra nhap lai mật khẩu
    var nhaplaimatkhau = input_nhaplai_matkhau.value;
    if(nhaplaimatkhau == ''){
        input_nhaplai_matkhau.style.borderColor = 'red';
        document.getElementById('error_nhaplaimatkhau').innerHTML = 'Yêu cầu nhập lại mật khẩu';
        stop_sever = false;
    }else{
        if(nhaplaimatkhau == matkhau){
            input_nhaplai_matkhau.style.borderColor = 'blue';
            document.getElementById('error_nhaplaimatkhau').innerHTML = '';
        }else{
            input_nhaplai_matkhau.style.borderColor = 'red';
            document.getElementById('error_nhaplaimatkhau').innerHTML = 'Mật khẩu nhập lại không đúng';
            stop_sever = false;
        }
    }

    //kiem tra định dạng email

    var email = input_email.value;
    if(email == ''){
        input_email.style.borderColor = 'red';
        document.getElementById('error_email').innerHTML = 'Yêu cầu nhập email';
        stop_sever = false;
    }else{
        if(cheack_mail.test(email)){
            input_email.style.borderColor = 'blue';
            document.getElementById('error_email').innerHTML = '';
        }else{
            input_email.style.borderColor = 'red';
            document.getElementById('error_email').innerHTML = 'Địa chỉ mail không hợp lệ - Example@gmail.com';
            stop_sever = false;
        }
    }

    //kiem tra dinh dạng số điện thoại
    var sodienthoai = input_sdt.value;
    if(sodienthoai == ''){
        input_sdt.style.borderColor = 'red';
        document.getElementById('error_sdt').innerHTML = 'Yêu cầu nhập số điện thoại';
        stop_sever = false;
    }else{
        if(cheack_phone.test(sodienthoai)){
            input_sdt.style.borderColor = 'blue';
            document.getElementById('error_sdt').innerHTML = '';
        }else{
            input_sdt.style.borderColor = 'red';
            document.getElementById('error_sdt').innerHTML = 'Yêu cầu nhập đúng định dạng số điện thoại';
            stop_sever = false;
        }

    }
    //kiểm tra định dạng hình ảnh
    var fileanh = input_anhdaidien.value;
    if(fileanh == ''){
        input_anhdaidien.style.borderColor = 'red';
        document.getElementById('error_fileanh').innerHTML = 'Yêu cầu thêm ảnh đại diện';
        stop_sever = false;
    }else{
        if(isImage(fileanh)){
            input_anhdaidien.style.borderColor = 'blue';
            document.getElementById('error_fileanh').innerHTML = '';
        }else{
            input_anhdaidien.style.borderColor = 'red';
            document.getElementById('error_fileanh').innerHTML = 'Chọn đúng địng dạng file ảnh';
            stop_sever = false;
        }
    }
    return stop_sever;
}

