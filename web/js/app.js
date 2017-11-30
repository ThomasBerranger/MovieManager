/* --------------------- Materialize --------------------- */
$('.button-collapse').sideNav({
        menuWidth: 300, // Default is 240
        closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
);

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'dd-mm-yyyy'
});

$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
});

$(document).ready(function() {
    $('select').material_select();
});

$(document).ready(function() {
    var options = [{
        selector: '#scrollFireDiv',
        offset: 300,
        callback: function(el) {
            Materialize.showStaggeredList($(el));
        }
    }, {
        selector: '#scrollFirePic',
        offset: 300,
        callback: function(el) {
            Materialize.fadeInImage($(el));
        }
    }];

    Materialize.scrollFire(options);
});