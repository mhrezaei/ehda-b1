<div class="form-group text-center">
    <label class="col-12 control-label">
        <span id="organCheck">{{ trans('site.global.organ_detail_line1') }}</span>
        <span class="text-danger" style="display: none;">*</span>
    </label>
</div>
<div class="form-group text-center">
    <div class="col-12 body-items">
        <p>
            <input type="checkbox" id="chRegisterAll" name="chRegisterAll" error-value="{{ trans('validation.javascript_validation.organs') }}">
            <label for="chRegisterAll" class="form-control-label">
                {{ trans('people.organs.all') }}
            </label>
        </p>
        <input type="checkbox" id="chRegisterHeart" name="chRegisterHeart">
        <label for="chRegisterHeart" class="form-control-label">
            {{ trans('people.organs.heart') }}
        </label>
        <input type="checkbox" id="chRegisterLung" name="chRegisterLung">
        <label for="chRegisterLung" class="form-control-label">
            {{ trans('people.organs.lung') }}
        </label>
        <input type="checkbox" id="chRegisterLiver" name="chRegisterLiver">
        <label for="chRegisterLiver" class="form-control-label">
            {{ trans('people.organs.liver') }}
        </label>
        <input type="checkbox" id="chRegisterKidney" name="chRegisterKidney">
        <label for="chRegisterKidney" class="form-control-label">
            {{ trans('people.organs.kidney') }}
        </label>
        <input type="checkbox" id="chRegisterPancreas" name="chRegisterPancreas">
        <label for="chRegisterPancreas" class="form-control-label">
            {{ trans('people.organs.pancreas') }}
        </label>
        <input type="checkbox" id="chRegisterTissues" name="chRegisterTissues">
        <label for="chRegisterTissues" class="form-control-label">
            {{ trans('people.organs.tissues') }}
        </label>
    </div>
</div>
<div class="form-group text-center">
    <p>
        {{ trans('site.global.organ_detail_line2') }}<br>
        {{ trans('site.global.organ_detail_line3') }}
    </p>
</div>
<script>
    $(document).ready(function () {
        var count = 0;
        @if(strpos(Auth::user()->organs, 'Heart') !== false)
            $('#chRegisterHeart').click(); count++;
        @endif
        @if(strpos(Auth::user()->organs, 'Lung') !== false)
            $('#chRegisterLung').click(); count++;
        @endif
        @if(strpos(Auth::user()->organs, 'Liver') !== false)
            $('#chRegisterLiver').click(); count++;
        @endif
        @if(strpos(Auth::user()->organs, 'Kidney') !== false)
            $('#chRegisterKidney').click(); count++;
        @endif
        @if(strpos(Auth::user()->organs, 'Pancreas') !== false)
            $('#chRegisterPancreas').click(); count++;
        @endif
        @if(strpos(Auth::user()->organs, 'Tissues') !== false)
            $('#chRegisterTissues').click(); count++;
        @endif

        if (count == 6)
        {
            $('#chRegisterAll').click();
        }
    });
</script>