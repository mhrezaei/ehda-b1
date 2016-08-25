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