function kiemTraDonHang(giatri){
    if(giatri == 0){ //don hang chua duyet
        document.getElementById('hoadonChuaDuyet').style.display='block';
        document.getElementById('hoadonDaDuyet').style.display='none';
        document.getElementById('chuaduyet').style.backgroundColor= 'white';
        document.getElementById('chuaduyet').style.color= 'black';
        document.getElementById('daduyet').style.backgroundColor= 'black';
        document.getElementById('daduyet').style.color= 'white';
    }else{
        document.getElementById('hoadonDaDuyet').style.display='block';
        document.getElementById('hoadonChuaDuyet').style.display='none';
        document.getElementById('chuaduyet').style.backgroundColor= 'black';
        document.getElementById('chuaduyet').style.color= 'white';
        document.getElementById('daduyet').style.backgroundColor= 'white';
        document.getElementById('daduyet').style.color= 'black';
    }

    // alert("Hehe")
}   