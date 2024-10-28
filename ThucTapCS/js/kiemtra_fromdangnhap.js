var input_tentaikhoan = document.getElementById('tentaikhoan');
var input_matkhau = document.getElementById('matkhau');


function kiemTraFormDangNhap(){
    var stopt_server = true;

    //Kiem tra ten dang nhap
    var tendangnhap = input_tentaikhoan.value;
    if(tendangnhap == ''){
        input_tentaikhoan.style.borderColor = 'red';
        document.getElementById('error_tentaikhoan').innerHTML = 'Nhập tên đăng nhập';
        stopt_server = false;
    }else{
        input_tentaikhoan.style.borderColor = 'blue';
    }

    //Kiem tra mat khau
    var matkhau = input_matkhau.value;
    if(matkhau == ''){
        input_matkhau.style.borderColor = 'red';
        document.getElementById('error_matkhau').innerHTML = 'Nhập mật khẩu';
        stopt_server = false;
    }else{
        input_matkhau.style.borderColor = 'blue';
    }
    
    return stopt_server;
}