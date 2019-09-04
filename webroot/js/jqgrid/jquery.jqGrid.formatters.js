function statusFormatter(cellValue, options, rowObject) {
    if (cellValue == 'A') {
        return 'Activo';
    } else if (cellValue == 'I') {
        return 'Inactivo';
    } else {
        return '';
    }
}

function genderFormatter(cellValue, options, rowObject) {
    if (cellValue == 'F') {
        return 'Femenino';
    } else if (cellValue == 'M') {
        return 'Masculino';
    } else {
        return '';
    }
}

function typeFormatter(cellValue, options, rowObject) {
    if (cellValue == 'P') {
        return 'Participante';
    } else if (cellValue == 'E') {
        return 'Expositor';
    } else if (cellValue == 'T') {
        return 'Tutor';
    }
    else if (cellValue == 'O') {
        return 'Organizador';
    } else {
        return '';
    }
}

function printedFormatter(cellValue, options, rowObject) {
    if (cellValue == 'Y') {
        return 'Impreso';
    } else if (cellValue == 'N') {
        return 'Sin imprimir';
    } else {
        return '';
    }
}

function yesOrNotFormatter(cellValue, options, rowObject) {
    if (cellValue == true) {
        return "<span class='label label-success'>Si</span>";
    }else{
        return "<span class='label label-warning'>No</span>";
    }
}