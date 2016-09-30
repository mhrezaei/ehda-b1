<?php

namespace App\Http\Controllers\members;

use App\models\Meta;
use App\Models\Post;
use App\Providers\SecKeyServiceProvider;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VolunteersController extends Controller
{
    use TahaControllerTrait;

    public function index()
    {
        $captcha = SecKeyServiceProvider::getQuestion('fa');
        $volunteer = Post::findBySlug('volunteers_detail');
        if (! $volunteer)
            return view('errors.404');

        return view('site.volunteers.volunteers_info.0', compact('volunteer', 'captcha'));
    }

    public function register_first_step(Requests\site\volunteer\VolunteerFirstStepRequest $request)
    {
        $input = $request->toArray();
        $user = User::selectBySlug($input['code_melli'], 'code_melli');
        if ($user)
        {
            if ($user->isActive('volunteer') and $user->isActive('card'))
            {
                $return = $this->jsonFeedback(null, [
                    'redirect' => url('relogin'),
                    'ok' => 1,
                    'message' => trans('forms.feed.wait'),
                ]);
            }
            else if ($user->volunteer_status < 0 or $user->card_status < 0)
            {
                $return = $this->jsonFeedback(null, [
                    'ok' => 0,
                    'message' => trans('forms.feed.not_allowed'),
                ]);
            }
            else
            {
                $return = $this->jsonFeedback(null, [
                    'ok' => 1,
                    'message' => trans('site.global.going_to_volunteer_exam_page'),
                    'redirect' => url('/volunteers/exam'),
                    'redirectTime' => 2000,
                ]);
            }
        }
        else
        {
            $return = $this->jsonFeedback(null, [
                'ok' => 1,
                'message' => trans('site.global.going_to_volunteer_exam_page'),
                'redirect' => url('/volunteers/exam'),
                'redirectTime' => 2000,
            ]);
        }

        unset($input['_token']);
        unset($input['security']);
        unset($input['key']);
        Session::put('volunteer_first_step', $input);

        return $return;
    }

    public function exam()
    {
        $exam = Post::selector('tests')->orderBy('id', 'random')->limit(30)->get();
        $volunteer = Post::findBySlug('volunteers_detail');
        if (! $volunteer or ! $exam)
            return view('errors.404');

        $tests = '';
        $count = 0;
        foreach ($exam as $test)
        {
            $tests[$count]['title'] = $test->text;
            $tests[$count]['id'] = $test->id;
            $tests[$count]['answer'] = Meta::where('record_id', $test->id)
                ->where('key', '!=', 'additional_info')
                ->where('key', '!=', 'post_photos')
                ->orderByRaw("RAND()")
                ->get();
            $count++;
        }

        return view('site.volunteers.volunteers_exam.0', compact('volunteer', 'tests'));
    }

    public function register_second_step(Requests\site\volunteer\VolunteerSecondStepRequest $request)
    {
        $input = $request->toArray();
        
        return view('templates.say' , ['array'=>$input]);
    }
}
