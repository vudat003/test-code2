function thanhtoan() {
    var check_muasp = document.getElementById("tamtinh").innerHTML;
    if (check_muasp == "Tạm tính: 0 Đ") {
        Swal.fire('Yêu cầu chọn sản phẩm trước khi mua hàng');
        return false;
    }
    if (confirm("Bạn có chắc chắn thanh toán sản phẩm")) {
        swalWithBootstrapButtons.fire(
            'Đã thanh toán',
            'Your file has been deleted.',
            'success'
        )
        return true;
    } else {
        return false;
    }
}  