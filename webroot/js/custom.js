var applyClassesToHeaders = function (grid) {
    // Use the passed in grid as context,
    // in case we have more than one table on the page.
    var trHead = jQuery("thead:first tr", grid.hdiv);
    var colModel = grid.getGridParam("colModel");

    for (var iCol = 0; iCol < colModel.length; iCol++) {
        var columnInfo = colModel[iCol];
        if (columnInfo.classes) {
            var headDiv = jQuery("th:eq(" + iCol + ")", trHead);
            headDiv.addClass(columnInfo.classes);
        }
    }
};
