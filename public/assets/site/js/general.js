function register_card_step_one($mode)
{
    if ($mode == 'start')
    {
        $('.stepOneBtn').hide();
        $('.stepOneForm').slideToggle();
        $('#name_first').focus();
    }
    else if($mode == 'stop')
    {
        $('.stepOneBtn').show();
        $('.stepOneForm').slideToggle();
    }
    else
    {
        alert('Error!');
    }
}

function registerForm_validate()
{
    if ($('#chRegisterAll').is(":checked") || $('#chRegisterHeart').is(":checked") || $('#chRegisterLung').is(":checked") ||
        $('#chRegisterLiver').is(":checked") || $('#chRegisterKidney').is(":checked") || $('#chRegisterPancreas').is(":checked") ||
        $('#chRegisterTissues').is(":checked"))
    {
        return 0;
    }
    else 
    {
        return $('#chRegisterAll').attr('error-value');
    }
}

function register_step_second() {
    var $formID = '#registerForm';
    var $form = $($formID);

    $($formID + 'input').prop('disabled', true);
    alert(1234);

}