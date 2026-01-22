function fechaMes() {
    
    var mes   = document.getElementById("cmbmes").value;
    var tipo  = document.getElementById("cmbtipo").value;
    var fecha = new Date();
    var anio  = fecha.getFullYear();

    mes = mes-1    
    var fechaini = new Date(anio,mes,1);
    var fechafin = new Date(fechaini.getFullYear(),fechaini.getMonth()+1,0);

    if (tipo=="Q"){
        fechafin.setDate(fechaini.getDate()+14);
    }

    document.getElementById("dfechaini").value = formatDateIni(fechaini);
    document.getElementById("dfechafin").value = formatDateFin(fechafin);
    
}

function formatDateIni(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

function formatDateFin(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}