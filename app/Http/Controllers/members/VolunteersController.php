<?php

namespace App\Http\Controllers\members;

use App\models\Meta;
use App\Models\Post;
use App\Models\User;
use App\Providers\SecKeyServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            else if ($user->volunteer_status == 1)
            {
                if ($user->exam_passed_at)
                {
                    if (Carbon::parse($user->exam_passed_at)->addDay(1) <= Carbon::now())
                    {
                        $return = $this->jsonFeedback(null, [
                            'ok' => 1,
                            'message' => trans('site.global.going_to_volunteer_exam_page'),
                            'redirect' => url('/volunteers/exam'),
                            'redirectTime' => 2000,
                        ]);
                    }
                    else
                    {
                        $return = $this->jsonFeedback(null, [
                            'ok' => 0,
                            'message' => trans('site.global.volunteer_exam_limit'),
                        ]);
                    }
                }
            }
            else if($user->volunteer_status == 2)
            {
                $return = $this->jsonFeedback(null, [
                    'ok' => 1,
                    'message' => trans('forms.feed.wait'),
                    'redirect' => url('/volunteers/final_step'),
                ]);
            }
            else if($user->volunteer_status == 3)
            {
                if ($user->exam_passed_at)
                {
                    $return = $this->jsonFeedback(null, [
                        'ok' => 0,
                        'message' => trans('site.global.volunteer_account_not_confirm'),
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
        if (Auth::check())
        {
            $user = Auth::user();
            if ($user->isActive('volunteer') and $user->exam_passed_at)
            {
                return redirect('/manage');
            }
            elseif ($user->volunteer_status == 3 and $user->exam_passed_at)
            {
                return redirect('/');
            }
        }
        elseif (Session::get('volunteer_first_step'))
        {
            $data = Session::get('volunteer_first_step');
            $user = User::selectBySlug($data['code_melli'], 'code_melli');
            if ($user)
            {
                if ($user->volunteer_status == 2 or $user->volunteer_status > 3 or $user->volunteer_status < 0)
                {
                    return redirect('/');
                }
                elseif ($user->volunteer_status == 1)
                {
                    if (! Carbon::parse($user->exam_passed_at)->addDay(1) <= Carbon::now())
                        return redirect('/');
                }
                elseif ($user->volunteer_status == 3)
                {
                    if ($user->exam_passed_at)
                        return redirect('/');
                }
            }
        }
        else
        {
            return redirect('/');
        }

        $exam = Post::selector('tests')->limit(30)->inRandomOrder()->get() ;
        $volunteer = Post::findBySlug('volunteers_detail');
        if (! $volunteer or ! $exam)
            return view('errors.404');

        $tests = [] ;

        foreach($exam as $test) {
            $metas = $test->metas()
                ->whereIn('key', [
                    'option_wrong_1',
                    'option_wrong_2',
                    'option_wrong_3',
                    'option_true',
                ])
                ->inRandomOrder()->get()->toArray() ;

            $tests[] = [
                'question' => $test->text ,
                'id' => $test->id ,
                'options' => [
                    'A' => [$metas[0]['value'] , $metas[0]['key']] ,
                    'B' => [$metas[1]['value'] , $metas[1]['key']] ,
                    'C' => [$metas[2]['value'] , $metas[2]['key']] ,
                    'D' => [$metas[3]['value'] , $metas[3]['key']] ,
                ]
            ];

        }

        return view('site.volunteers.volunteers_exam.0', compact('volunteer', 'tests'));
    }

    public function register_second_step(Requests\site\volunteer\VolunteerSecondStepRequest $request)
    {
        $input = $request->toArray();

        $data = [];
        $count = 0;
        $true_answer = 0;
        foreach ($input as $key => $value)
        {
            if (str_contains($key, 'answer-'))
            {
                $id = explode('-', $key);
                $data[$count]['id'] = $id[1];

                $answer = decrypt($value);
                if ($answer == 'option_true')
                {
                    $data[$count]['status'] = 1;
                    $true_answer++;
                }
                else
                {
                    $data[$count]['status'] = 0;
                }
                $count++;
            }
        }

        $store = Session::pull('volunteer_first_step');
        $store['exam_passed_at'] = Carbon::now()->toDateTimeString();
        $store['exam_sheet'] = json_encode($data);
        $store['exam_result'] = ceil(($true_answer * 100) / 30);
        dd($store);
    }
}
