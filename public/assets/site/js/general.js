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

function volunteer_register_step_one($mode)
{
    if ($mode == 'start')
    {
        $('.stepOneBtn').hide();
        $('.pdf-book').hide();
        $('.stepOneForm').slideToggle();
        $('#name_first').focus();
    }
    else if($mode == 'stop')
    {
        $('.stepOneBtn').show();
        $('.pdf-book').show();
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

function editForm_validate()
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

function register_step_second(string) {
    var $formID = '#registerForm';
    var $form = $($formID);

    $('#db-check').val(string);

    $($formID + ' input').prop('disabled', true);
    $($formID + ' select').prop('disabled', true);
    $($formID + ' .dropdown-toggle').prop('disabled', true);
    $($formID + ' .step_one_btn').slideToggle();

    $('#register_third_step').slideToggle();

    $('.btn-db-check').on('click', function () {
        $($formID + ' input').prop('disabled', false);
        $($formID + ' select').prop('disabled', false);
        $($formID + ' .dropdown-toggle').prop('disabled', false);
        $($formID + ' .step_one_btn').slideToggle();
        $($formID + ' .form-feed').hide();

        $('#register_third_step').hide();
    });
}

function register_third_step_validate() {
    $("#registerForm .form-feed").hide();
    return 0;
}