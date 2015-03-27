jQuery(document).ready(function() {
    
    $dt = jQuery('#kingsrrf_faq dt');
    $dd = jQuery('#kingsrrf_faq dd');
    
    $dd.addClass('displaynone');
    
    $dt.click(function(){
        $dd.addClass('displaynone');
        jQuery(this).next($dd).removeClass('displaynone');
    });
});