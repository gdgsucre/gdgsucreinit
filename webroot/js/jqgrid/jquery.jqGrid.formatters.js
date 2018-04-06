function statusFormatter(cellValue, options, rowObject)
{
    if (cellValue == 'A') {
        return 'Activo';
    } else if (cellValue == 'I') {
        return 'Inactivo';
    } else {
        return '';
    }
}

function accountTypesFormatter(cellValue, options, rowObject)
{
    if (cellValue == 'B') {
        return 'Ambos';
    } else if (cellValue == 'I') {
        return 'Ingreso';
    } else if (cellValue == 'E') {
        return 'Egreso';
    } else {
        return '';
    }
}

function paymentMethods(cellValue, options, rowObject)
{
    if (cellValue == 'E') {
        return 'Efectivo';
    } else if (cellValue == 'D') {
        return 'Depósito';
    } else if (cellValue == 'C') {
        return 'Cheque';
    } else if (cellValue == 'T') {
        return 'Transferencia';
    } else if (cellValue == 'G') {
        return 'Cortesía';
    } else {
        return '';
    }
}

function movementStates(cellValue, options, rowObject)
{
    if (cellValue == 'V') {
        return 'Válido';
    } else if (cellValue == 'A') {
        return 'Anulado';
    } else {
        return '';
    }
}

function checkStatus(cellValue, options, rowObject)
{
    if (cellValue == 'G') {
        return 'Generado';
    } else if (cellValue == 'P') {
        return 'Impreso';
    } else if (cellValue == 'D') {
        return 'Entregado';
    } else {
        return '';
    }
}

function backwardFormatter(cellValue, options, rowObject)
{
    if (cellValue == 'Y') {
        return 'Si';
    } else if (cellValue == 'N') {
        return 'No';
    } else {
        return '';
    }
}
