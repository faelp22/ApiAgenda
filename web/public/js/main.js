(function() {
    'use strict';
    var version = 'Agenda V-1_04042017';
    console.log(version);
    var time = new Date().getTime();

    $(document.body).bind("mousemove keypress", function(e) {
        time = new Date().getTime();
    });

    function refresh() {
        if (new Date().getTime() - time >= 300000) {
            window.location.reload(true);
        } else {
            setTimeout(refresh, 10000);
        }
    }
    setTimeout(refresh, 10000);
})();