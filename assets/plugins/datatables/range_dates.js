$.fn.dataTableExt.afnFiltering.push(
function( oSettings, aData, iDataIndex ) {

    var filterstart =$("#mindate").val();
    var filterend = $("#maxdate").val();
    var iStartDateCol = 1; //using column 2 in this instance
    var iEndDateCol = 1;
    var tabledatestart = aData[iStartDateCol];
    var tabledateend= aData[iEndDateCol]; 

    if ( filterstart === "" && filterend === "" )
    {
        return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && filterend === "")
    {
        return true;
    }
    else if ((moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)) && filterstart === "")
    {
        return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && (moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)))
    {
        return true;
    }
    return false;
}
);
