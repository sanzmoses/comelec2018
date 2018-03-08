$("input[name=Councilor]").change(function(){
    var max= 7;
    if( $("input[name=Councilor]:checked").length == max ){
        $("input[name=Councilor]").attr('disabled', 'disabled');
        $("input[name=Councilor]:checked").removeAttr('disabled');
    }else{
