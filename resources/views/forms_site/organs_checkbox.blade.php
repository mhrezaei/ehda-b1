<div class="form-group text-center">
    <label class="col-12 control-label">
        <span id="organCheck">{{ trans('site.global.organ_detail_line1') }}</span>
        <span class="text-danger" style="display: none;">*</span>
    </label>
</div>
<div class="form-group text-center">
    <div class="col-12 body-items">
        <p>
            <input type="checkbox" id="chRegisterAll" name="chRegisterAll" error-value="{{ trans('validation.javascript_validation.organs') }}"
                   @if(strpos(Auth::user()->organs, 'Heart Lung Liver Kidney Pancreas Tissues') !== false)
                       checked="checked"
                    @endif
            >
            <label for="chRegisterAll" class="form-control-label">
                {{ trans('people.organs.all') }}
            </label>
        </p>
        <input type="checkbox" id="chRegisterHeart" name="chRegisterHeart"
           @if(strpos(Auth::user()->organs, 'Heart') !== false)
               checked="checked"
            @endif
        >
        <label for="chRegisterHeart" class="form-control-label">
            {{ trans('people.organs.heart') }}
        </label>
        <input type="checkbox" id="chRegisterLung" name="chRegisterLung"
           @if(strpos(Auth::user()->organs, 'Lung') !== false)
                checked="checked"
            @endif
        >
        <label for="chRegisterLung" class="form-control-label">
            {{ trans('people.organs.lung') }}
        </label>
        <input type="checkbox" id="chRegisterLiver" name="chRegisterLiver"
               @if(strpos(Auth::user()->organs, 'Liver') !== false)
                    checked="checked"
                @endif
        >
        <label for="chRegisterLiver" class="form-control-label">
            {{ trans('people.organs.liver') }}
        </label>
        <input type="checkbox" id="chRegisterKidney" name="chRegisterKidney"
               @if(strpos(Auth::user()->organs, 'Kidney') !== false)
                    checked="checked"
                @endif
        >
        <label for="chRegisterKidney" class="form-control-label">
            {{ trans('people.organs.kidney') }}
        </label>
        <input type="checkbox" id="chRegisterPancreas" name="chRegisterPancreas"
               @if(strpos(Auth::user()->organs, 'Pancreas') !== false)
                    checked="checked"
                @endif
        >
        <label for="chRegisterPancreas" class="form-control-label">
            {{ trans('people.organs.pancreas') }}
        </label>
        <input type="checkbox" id="chRegisterTissues" name="chRegisterTissues"
               @if(strpos(Auth::user()->organs, 'Tissues') !== false)
                checked="checked"
                @endif
        >
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