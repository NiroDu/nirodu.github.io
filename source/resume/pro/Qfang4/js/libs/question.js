$(function() {
    //火箭按钮渐进渐出效果
    var $btn = $('<a class="return" href="javascript:"><img src="images/return.png"></a>');
    $('body').append($btn);
    $(window).scroll(function() {
        if ($(window).scrollTop() > 200) {
            $(".return").fadeIn(1000);
        } else {
            $('.return').fadeOut(600);
        }
    })

    $(".return").on("click", function() {
        $("html,body").animate({
            scrollTop: 0
        }, 300);

    });

    $('.question_left').find("a").on('click', function() {
        var i = $(this).parent('li').index();
        $(".question_main").find('li').attr('class', '')
        $('#question_content_left').find('div').css('display', 'none');
        $('#question_content_right').find('div').css('display', 'none');

        $(this).parent('li').attr('class', 'active')
        $('#question_content_left').find('div').eq(i).css('display', 'block');


    })
    $('.question_right').find("a").on('click', function() {
        var i = $(this).parent('li').index();
        $(".question_main").find('li').attr('class', '')
        $('#question_content_right').find('div').css('display', 'none');
        $('#question_content_left').find('div').css('display', 'none');

        $(this).parent('li').attr('class', 'active')
        $('#question_content_right').find('div').eq(i).css('display', 'block');

    })
})

