{!! Html::script ('assets/site/js/persian-date-0.1.8.min.js') !!}
{!! Html::script ('assets/site/js/persian-datepicker-0.4.5.min.js') !!}
{!! Html::script ('assets/site/js/states.js') !!}
{!! Html::script ('assets/libs/jquery.form.min.js') !!}
{!! Html::script ('assets/js/forms.js') !!}


<div class="row">
    <div class="col-xs-12">
        <div class="container">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row text-center">
                    <img src="{{ url('') }}/assets/site/images/card.png" alt="کارت اهدای عضو" class="ehda-card-image">
                </div>
                <div class="row">
                        {!! Form::open([
                            'url'	=> 'register/checkData' ,
                            'method'=> 'post',
                            'class' => 'clearfix ehda-card-form js',
                            'name' => 'registerForm',
                            'id' => 'registerForm',
                        ]) !!}

                        <div class="form-group">
                            <div>اطلاعات فردی</div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="txtRegisterFirstName">نام: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-persian" id="txtRegisterFirstName" name="txtRegisterFirstName" data-toggle="tooltip" data-placement="top" placeholder="(حروف فارسی)" title="مثال: محمد" minlength="2">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="txtRegisterLastName">نام خانوادگی: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-persian" id="txtRegisterLastName" name="txtRegisterLastName" data-toggle="tooltip" data-placement="top" placeholder="(حروف فارسی)" title="مثال: احمدی" minlength="2">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="cbRegisterGender">جنسیت: <span class="text-danger">*</span></label>
                                    <select class="form-control form-required" id="cbRegisterGender" name="cbRegisterGender" data-toggle="tooltip" data-placement="top" title="مثال: آقا">
                                        <option value="0">انتخاب کنید...</option>
                                        <option value="2">خانم</option>
                                        <option value="1">آقا</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="txtRegisterFatherName">نام پدر: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-persian" id="txtRegisterFatherName" name="txtRegisterFatherName" data-toggle="tooltip" data-placement="top" placeholder="(حروف فارسی)" title="مثال: حسین" minlength="2">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="txtRegisterIDNumber">شماره شناسنامه: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-number" id="txtRegisterIDNumber" name="txtRegisterIDNumber" data-toggle="tooltip" data-placement="top" placeholder="(فقط عدد)" title="مثال: 137458" minlength="1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="txtRegisterNationalCode">کد ملی: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-national" id="txtRegisterNationalCode" name="txtRegisterNationalCode" data-toggle="tooltip" data-placement="top" maxlength="10" minlength="10" placeholder="(10 رقم، فقط عدد)" title="مثال: 1122114488">
                                    <input type="hidden" name="txtDbCheck" id="txtDbCheck" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="cbRegisterBirthDate">تاریخ تولد: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-datepicker" id="cbRegisterBirthDate" name="cbRegisterBirthDate" data-toggle="tooltip" data-placement="top" placeholder="ترجیحاً از جدول درج خودکار فوق یا با فرمت 1350/9/25 وارد نمائید" title="مثال: 1364/12/22">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="txtRegisterPlaceOfBirth">محل تولد: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-persian" id="txtRegisterPlaceOfBirth" name="txtRegisterPlaceOfBirth" data-toggle="tooltip" data-placement="top" placeholder="(حروف فارسی)" title="شیراز" minlength="2">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="cbRegisterEducation">میزان تحصیلات: <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="cbRegisterEducation" name="cbRegisterEducation" data-toggle="tooltip" data-placement="top" title="مثال: لیسانس">
                                            <option value="0">انتخاب کنید...</option>
                                            <option value="1">زیر دیپلم</option>
                                            <option value="2">دیپلم</option>
                                            <option value="3">کاردانی</option>
                                            <option value="4">کارشناسی</option>
                                            <option value="5">کارشناسی&zwnj;ارشد</option>
                                            <option value="6">دکترا و بالاتر</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="txtRegisterJob">شغل: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-persian" id="txtRegisterJob" name="txtRegisterJob" data-toggle="tooltip" data-placement="top" placeholder="(حروف فارسی)" title="مثال: کارمند بانک" minlength="2">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>اطلاعات تماس</div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="txtRegisterMobile">تلفن همراه: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-mobile" id="txtRegisterMobile" name="txtRegisterMobile" data-toggle="tooltip" data-placement="top" maxlength="11" minlength="11" placeholder="(11 رقم، فقط عدد)" title="مثال: 09121234567">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="txtRegisterTel">تلفن ثابت: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-phone" id="txtRegisterTel" name="txtRegisterTel" data-toggle="tooltip" data-placement="top" maxlength="11" minlength="11" placeholder="(11 رقم، فقط عدد)" title="مثال: 02122334455">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="cbRegisterState" class="input-group-addon">استان: <span class="text-danger">*</span></label>
                                        <select class="form-control form-required" id="cbRegisterState" name="cbRegisterState" data-toggle="tooltip" data-placement="top" onchange="selectCity();" title="مثال: تهران"><option value="0">انتخاب کنید...</option><option value="1">آذربایجان شرقی</option><option value="2">آذربایجان غربی</option><option value="3">اردبیل</option><option value="4">اصفهان</option><option value="5">البرز</option><option value="6">ایلام</option><option value="7">بوشهر</option><option value="8">تهران</option><option value="9">چهار محال و بختیاری</option><option value="10">خراسان جنوبی</option><option value="11">خراسان رضوی</option><option value="12">خراسان شمالی</option><option value="13">خوزستان</option><option value="14">زنجان</option><option value="15">سمنان</option><option value="16">سیستان و بلوچستان</option><option value="17">فارس</option><option value="18">قزوین</option><option value="19">قم</option><option value="20">کردستان</option><option value="21">کرمان</option><option value="22">کرمانشاه</option><option value="23">کهگیلویه و بویراحمد</option><option value="24">گلستان</option><option value="25">گیلان</option><option value="26">لرستان</option><option value="27">مازندران</option><option value="28">مرکزی</option><option value="29">هرمزگان</option><option value="30">همدان</option><option value="31">یزد</option></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="cbRegisterCity" class="input-group-addon">شهر: <span class="text-danger">*</span></label>
                                        <select class="form-control form-required" id="cbRegisterCity" name="cbRegisterCity" data-toggle="tooltip" data-placement="top" title="مثال: تهران">
                                            <option value="0">انتخاب کنید...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="txtRegisterEmail" class="input-group-addon">ایمیل:</label>
                                        <input type="email" class="form-control form-email" id="txtRegisterEmail" name="txtRegisterEmail" maxlength="256" data-toggle="tooltip" data-placement="top" placeholder="ایمیل خود را بدون www وارد نمائید" title="مثال: you@site.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>اطلاعات ورود به سامانه</div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="txtRegisterPassword" class="input-group-addon">رمز عبور: <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control form-password" id="txtRegisterPassword" name="txtRegisterPassword" maxlength="256" minlength="8" placeholder="(حروف انگلیسی یا عدد حداقل 8 کاراکتر)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="txtRegisterPasswordVerify" class="input-group-addon">تکرار رمز عبور: <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="txtRegisterPasswordVerify" name="txtRegisterPasswordVerify" maxlength="256" placeholder="(تکرار رمز عبور)">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <label class="col-12 control-label">
                                <span id="organCheck">مایلم</span>
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-12 body-items">
                                <p>
                                    <input type="checkbox" id="chRegisterAll" name="chRegisterAll">
                                    <label for="chRegisterAll" class="form-control-label">
                                        همه&zwnj;ی اعضا و نسوج قابل اهدا
                                    </label>
                                </p>
                                <input type="checkbox" id="chRegisterHeart" name="chRegisterHeart">
                                <label for="chRegisterHeart" class="form-control-label">
                                    قلب
                                </label>
                                <input type="checkbox" id="chRegisterLung" name="chRegisterLung">
                                <label for="chRegisterLung" class="form-control-label">
                                    ریه
                                </label>
                                <input type="checkbox" id="chRegisterLiver" name="chRegisterLiver">
                                <label for="chRegisterLiver" class="form-control-label">
                                    کبد
                                </label>
                                <input type="checkbox" id="chRegisterKidney" name="chRegisterKidney">
                                <label for="chRegisterKidney" class="form-control-label">
                                    کلیه
                                </label>
                                <input type="checkbox" id="chRegisterPancreas" name="chRegisterPancreas">
                                <label for="chRegisterPancreas" class="form-control-label">
                                    پانکراس
                                </label>
                                <input type="checkbox" id="chRegisterTissues" name="chRegisterTissues">
                                <label for="chRegisterTissues" class="form-control-label">
                                    نسوج
                                </label>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <p>
                                را در زمان مرگم اهدا کنم<br>
                                باشد که ادامه ی زندگی اجزای وجودم ، نجات بخش زندگی دیگری باشد.
                            </p>
                        </div>
                    @include('forms.feed')
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-link submit" data-toggle="tooltip" title="ارسال اطلاعات و انجام ثبت نام" data-placement="bottom">
                                <img src="{{ url('') }}/assets/site/images/form-submit.png" width="190" height="190">
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>