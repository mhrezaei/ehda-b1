@if($user)
    <table style="width: 100%; font-family: Tahoma; font-size: 12px; border: 1px solid black; direction: rtl;">
        <thead>
            <th style="border: 1px solid black;">ردیف</th>
            <th style="border: 1px solid black;">نام و نام خانوادگی</th>
            <th style="border: 1px solid black;">نام پدر</th>
            <th style="border: 1px solid black;">کدملی</th>
            <th style="border: 1px solid black;">تاریخ تولد</th>
            <th style="border: 1px solid black;">تحصیلات</th>
            <th style="border: 1px solid black;">رشته تحصیلی</th>
            <th style="border: 1px solid black;">محل سکونت</th>
            <th style="border: 1px solid black;">آدرس</th>
            <th style="border: 1px solid black;">تلفن</th>
            <th style="border: 1px solid black;">موبایل</th>
            <th style="border: 1px solid black;">ایمیل</th>
            <th style="border: 1px solid black;">تمایلات</th>
        </thead>
        <tbody>
        <?php $row = 1; ?>
        @foreach($user as $u)
                <tr>
                    <th style="border: 1px solid black;">{{ $row++ }}</th>
                    <td style="border: 1px solid black;">{{ $u->name_first . ' ' . $u->name_last }}</td>
                    <td style="border: 1px solid black;">{{ $u->name_father }}</td>
                    <td style="border: 1px solid black;">{{ $u->code_melli }}</td>
                    <td style="border: 1px solid black;">{{ $u->say('birth_date') }}</td>
                    <td style="border: 1px solid black;">{{ $u->say('edu_level') }}</td>
                    <td style="border: 1px solid black;">{{ $u->say('edu_field') }}</td>
                    <td style="border: 1px solid black;">{{ $u->say('home_city') }}</td>
                    <td style="border: 1px solid black;">{{ $u->home_address }}</td>
                    <td style="border: 1px solid black;">{{ $u->home_tel }}</td>
                    <td style="border: 1px solid black;">{{ $u->mobile }}</td>
                    <td style="border: 1px solid black;">{{ $u->email }}</td>
                    <td style="border: 1px solid black;">
                        @if(is_array($u->say('activities')))
                            @foreach($u->say('activities') as $key => $value)
                                {{ $value }}
                                <hr>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif