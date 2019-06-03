var position = $(window).scrollTop();
var temp;
var section2;
var ctr = 0;
var myVar;
function loadingScene() {
    myVar = setTimeout(showPage, 1000);
}
function showPage() {
    $('#loader').css('filter', 'opacity(0)');
    $('.body-content').css('display', 'block');
    setTimeout(done, 600);
}
function done() {
    $('#loader').css('display', 'none');
}
function divreach(a) {


}
$(document).ready(function () {
    var hT = $('#home-div').offset().top,
        hH = $('#home-div').outerHeight(),
        wH = $(window).height();
    section2 = hT + hH - wH;

    $('.upreveal-1').css('animation', 'upreveal 1s ease-in-out');
    $('.rightreveal-1').css('animation', 'rightreveal 1s ease-in-out')
    let opentoggle = () => {
        $(".btn-burger").toggleClass("btn-burger-toggle");
        $('.navbar').toggleClass('navbar-mobile');
        ctr++;
        // $(".my-nav").toggleClass("nav-container");
        $(".section-navbar").toggleClass("section-navbar-left");
    };

    $(".btn-burger").click(function () {
        opentoggle();
    });
    $(".section-navbar-list").click(function () {
        opentoggle();
    });
    $('.carousel').carousel({
        interval: 1500
    });


});