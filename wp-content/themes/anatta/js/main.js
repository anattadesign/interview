(function($){
    $(document).ready(function(){
        if ( $('body').hasClass('page-template-page-questions-paper-php') ) {
            var showed_alert = false;
            setInterval( function () {
                var currentTime = parseInt( $('.exam_timer').data('time_in_second') );
                if ( currentTime < 16 && currentTime > 10 && !showed_alert ) {
                    showed_alert = true;
                    alert( 'after ' + currentTime + ' second your exam will be submitted' );
                }

                if ( currentTime <= 0 ) {
                    if ( currentTime > -3 ) {
                        $('form[name="question-paper"]').submit();
                    }
                    $('.exam_timer').data('time_in_second', -3 );

                    return ;
                }

                if ( currentTime ) {
                    currentTime = currentTime - 1;
                }

                $('.exam_timer').data('time_in_second', currentTime)

                var timeInMinute = ( currentTime / 60 );

                $('.exam_timer').html('Exam Time:- ' + timeInMinute.toFixed(2) + ' Minutes' );


            }, 1000 );
        }
    });
})(jQuery);
