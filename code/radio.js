$(document).ready(function() {
    // By Default Disable radio button
    $(".subclasse").attr('disabled', true);
    $(".wrap").css('opacity', '.2'); // This line is used to lightly hide label for disable radio buttons.
    // Disable radio buttons function on Check Disable radio button.
    $("input:radio").change(function() {
    if ($(this).val() == "guerreiro"){
    $(".subclasse").attr('disabled', false);
    $(".wrap").css('opacity', '1');
    }
    // Else Enable radio buttons.
    else {
    $(".subclasse").attr('disabled', true);
    $(".subclasse").attr('checked', false);
    $(".wrap").css('opacity', '.2');
    }
    });
    });

    $('input:radio').on("click", ".disabled", function(event) {
        event.preventDefault();
        return false;
    });