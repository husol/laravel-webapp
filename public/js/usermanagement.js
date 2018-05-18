$(document).ready(function() {
    // Remove the # from the hash, as different browsers may or may not include it
    var anchorHash = location.hash.replace('#','');
    if(anchorHash != ''){
        // Show the hash if it's set
        $('.'+anchorHash).tab('show');
        // Clear the hash in the URL
        location.hash = '';
    } else {
        $('.NTT-quantri-content > .container ul.nav-pills > li:visible:first-child > a').trigger('click');
    }

});