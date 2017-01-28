<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    html, body, table{
        direction: rtl;
        font-family: Tahoma;
        text-align: right;
        line-height: 15px;
    }
</style>
<table>
    <tr>
        <td>Card-No</td>
        <td>Name</td>
        <td>Father</td>
        <td>Code Melli</td>
        <td>Birth Date</td>
        <td>Card Issue</td>
    </tr>
    @foreach(\App\Providers\TahaServiceProvider::getExcelExport() as $row)
        <tr>
            <td>@pd($row->user->card_no )</td>
            <td>{{ $row->user->fullName() }}</td>
            <td>{{ $row->user->name_father }}</td>
            <td>@pd($row->user->code_melli)</td>
            <td>{{ $row->user->say('birth_date_on_card') }}</td>
            <td>{{ $row->user->say('register_date_on_card') }}</td>
        </tr>
    @endforeach
</table>