(function($) {
    'use strict';

    // Add smooth animation when hovering over the WhatsApp button
    $('.whatsapp-icon-button').hover(
        function() {
            $(this).css('transform', 'scale(1.1)');
        },
        function() {
            $(this).css('transform', 'scale(1)');
        }
    );

    // Optional: Add click tracking if Google Analytics is available
    $('.whatsapp-icon-button').on('click', function() {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'click', {
                'event_category': 'WhatsApp',
                'event_label': 'WhatsApp Button Click'
            });
        }
    });

})(jQuery); 