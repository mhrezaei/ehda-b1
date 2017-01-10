@if($user)
    <table style="width: 100%; font-family: Tahoma; font-size: 12px; border: 1px solid black; direction: rtl;">
        <thead>
            <th style="border: 1px solid black;">ردیف</th>
            <th style="border: 1px solid black;">مشخصات</th>
            <th style="border: 1px solid black;">اطلاعات تماس</th>
            <th style="border: 1px solid black;">تمایلات</th>
        </thead>
        <tbody>
        <?php $row = 1; ?>
        @foreach($user as $u)
                <tr>
                    <th style="border: 1px solid black;">{{ $row++ }}</th>
                    <td style="border: 1px solid black;">
                        نام و نام خانوادگی: {{ $u->name_first . ' ' . $u->name_last }}<hr>
                        نام پدر: {{ $u->name_father }}<hr>
                        کدملی: {{ $u->code_melli }}<hr>
                        تاریخ تولد: {{ $u->say('birth_date') }}<hr>
                        رشته تحصیلی: {{ $u->say('edu_field') }}
                    </td>
                    <td style="border: 1px solid black;">
                        آدرس: {{ $u->home_address }}<hr>
                        شماره تماس: {{ $u->home_tel }}<hr>
                        موبایل: {{ $u->mobile }}<hr>
                        استان و شهر: {{ $u->say('home_province') . ' ' . $u->say('home_city') }}
                    </td>
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