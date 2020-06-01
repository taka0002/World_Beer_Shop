$(function() {
    $('.item_description').on('click',function(){
        $(this).nextAll('.popup').addClass('show').fadeIn();
    });
});
$(function() {
    $('.close').on('click',function(){
        $('.popup').fadeOut();
    });
});
