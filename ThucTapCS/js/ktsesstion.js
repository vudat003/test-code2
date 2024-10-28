function ktsession() {
    var dangky = document.getElementById("dangky").innerHTML;
    if (dangky == "Đăng ký") {
        Swal.fire({
            title: 'Yêu cầu đăng nhập trước khi thêm vào giỏ hàng',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đăng nhập'
          }).then((result) => {
            if (result.isConfirmed) {
            //   Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            //   )
                window.location = 'form_dangnhap.php';
            }
          })
        return false;
    }
}