function congtru(str, idsp) {
    var so = document.getElementById(idsp).value;
    so = parseInt(so);
    if (str == 1) {
        if (so >= 1)
            so = so + 1;
        else
            so = 1;
    }
    if (str == -1) {
        if (so == 1)
            so = 1;
        else
            so = so - 1;
    }
    document.getElementById(idsp).value = so;
}