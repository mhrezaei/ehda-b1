@if(\App\Providers\SettingServiceProvider::get_volunteer_data())
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
            <td>ردیف</td>
            <td>نام و نام خانوادگی</td>
            <td>نام پدر</td>
            <td>کدملی</td>
            {{--<td>تاریخ تولد</td>--}}
            <td>تحصیلات</td>
            <td>رشته تحصیلی</td>
            <td>محل سکونت</td>
            <td>آدرس</td>
            <td>تلفن</td>
            <td>موبایل</td>
            <td>ایمیل</td>
            {{--<td>تاریخ ثبت نام</td>--}}
            <td>وضعیت ثبت نام</td>
            <td>تمایلات</td>
        </tr>
        <?php $row = 1; ?>
        @foreach(\App\Providers\SettingServiceProvider::get_volunteer_data() as $u)
            <tr>
                <td>{{ $row++ }}</td>
                <td>{{ $u->name_first . ' ' . $u->name_last }}</td>
                <td>{{ $u->name_father }}</td>
                <td>{{ $u->code_melli }}</td>
                {{--                    <td>{{ $u->say('birth_date') }}</td>--}}
                <td>{{ $u->say('edu_level') }}</td>
                <td style="width: 600px;">{{ $u->say('edu_field') }}</td>
                <td>{{ $u->say('home_city') }}</td>
                <td>{{ $u->home_address }}</td>
                <td>{{ $u->home_tel }}</td>
                <td>{{ $u->tel_mobile }}</td>
                <td>{{ $u->email }}</td>
                {{--                    <td>{{ $u->say('volunteer_registered_at') }}</td>--}}
                <td>{{ $u->volunteerStatus() }}</td>
                <td>
                    @if(is_array($u->say('activities')) and count($u->say('activities')) > 0)
                        @foreach($u->say('activities') as $key => $value)
                            {{ $value }} ||
                        @endforeach
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endif