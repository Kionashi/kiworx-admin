<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function index(){
        try {
            $step1Questions = [
                [
                    'id' => 1,
                    'name' => 'I have a kind word for everyone.'
                ],
                [
                    'id' => 2,
                    'name' => 'I am always prepared.'
                ],
                [
                    'id' => 3,
                    'name' => 'I feel comfortable around people.'
                ],
                [
                    'id' => 4,
                    'name' => 'I often feel blue.'
                ],
                [
                    'id' => 6,
                    'name' => 'I feel I am better than other people.'
                ],
                [
                    'id' => 7,
                    'name' => 'I avoid taking on a lot of responsibility.'
                ],
                [
                    'id' => 8,
                    'name' => 'I make friends easily.'
                ],
                [
                    'id' => 9,
                    'name' => 'There are many things that I do not like about myself.'
                ],
                [
                    'id' => 10,
                    'name' => 'I am interested in the meaning of things.'
                ],
                [
                    'id' => 11,
                    'name' => 'I treat everyone with kindness and sympathy.'
                ],
                [
                    'id' => 12,
                    'name' => 'I get chores done right away.'
                ],
                [
                    'id' => 13,
                    'name' => 'I am skilled in handling social situations.'
                ],
            ];
            $step2Questions = [
                [
                    'id' => 14,
                    'name' => 'I am often troubled by negative thoughts.'
                ],
                [
                    'id' => 15,
                    'name' => 'I enjoy going to art museums.'
                ],
                [
                    'id' => 16,
                    'name' => 'I accept people the way they are.'
                ],
                [
                    'id' => 17,
                    'name' => 'It’s important to me that people are on time.'
                ],
                [
                    'id' => 18,
                    'name' => 'I am the life of the party.'
                ],
                [
                    'id' => 19,
                    'name' => 'My moods change easily.'
                ],
                [
                    'id' => 20,
                    'name' => 'I have a vivid imagination.'
                ],
                [
                    'id' => 21,
                    'name' => 'I take care of other people before taking care of myself.'
                ],
                [
                    'id' => 22,
                    'name' => 'I make plans and stick to them.'
                ],
                [
                    'id' => 23,
                    'name' => 'I don\'t like to draw attention to myself.'
                ],
                [
                    'id' => 24,
                    'name' => 'I enjoy hearing new ideas.'
                ],
                [
                    'id' => 25,
                    'name' => 'I start arguments just for the fun of it.'
                ],
                [
                    'id' => 26,
                    'name' => 'I always make good use of my time.'
                ],
            ];
            $step3Questions = [
                [
                    'id' => 27,
                    'name' => 'I have a lot to say.'
                ],
                [
                    'id' => 28,
                    'name' => 'I often worry that I am not good enough.'
                ],
                [
                    'id' => 29,
                    'name' => 'I am not interested in abstract ideas.'
                ],
                [
                    'id' => 30,
                    'name' => 'I criticize other people.'
                ],
                [
                    'id' => 31,
                    'name' => 'I find it difficult to get to work.'
                ],
                [
                    'id' => 32,
                    'name' => 'I stay in the background.'
                ],
                [
                    'id' => 33,
                    'name' => 'I seldom feel blue.'
                ],
                [
                    'id' => 34,
                    'name' => 'I do not like art.'
                ],
                [
                    'id' => 35,
                    'name' => 'I stop what I am doing to help other people.'
                ],
                [
                    'id' => 36,
                    'name' => 'I change my plans frequently.'
                ],
                [
                    'id' => 37,
                    'name' => 'I don\'t talk a lot.'
                ],
            ];
            $step4Questions = [
                [
                    'id' => 38,
                    'name' => 'I feel comfortable with myself.'
                ],
                [
                    'id' => 39,
                    'name' => 'I avoid philosophical discussions.'
                ],
                [
                    'id' => 40,
                    'name' => 'Original'
                ],
                [
                    'id' => 41,
                    'name' => 'Systematic'
                ],
                [
                    'id' => 42,
                    'name' => 'Shy'
                ],
                [
                    'id' => 43,
                    'name' => 'Soft-Hearted'
                ],
                [
                    'id' => 44,
                    'name' => 'Tense'
                ],
                [
                    'id' => 45,
                    'name' => 'Inquisitive'
                ],
                [
                    'id' => 46,
                    'name' => 'Forgetful'
                ],
                [
                    'id' => 47,
                    'name' => 'Reserved'
                ],
                [
                    'id' => 48,
                    'name' => 'Agreeable'
                ],
                [
                    'id' => 49,
                    'name' => 'Nervous'
                ],
                [
                    'id' => 50,
                    'name' => 'Creative'
                ],
                [
                    'id' => 51,
                    'name' => 'Self-Disciplined'
                ],
                [
                    'id' => 52,
                    'name' => 'Outgoing'
                ],
                [
                    'id' => 53,
                    'name' => 'Charitable'
                ],
                [
                    'id' => 54,
                    'name' => 'Moody'
                ],
                [
                    'id' => 55,
                    'name' => 'Imaginative'
                ],
                [
                    'id' => 56,
                    'name' => 'Organized'
                ],
                [
                    'id' => 57,
                    'name' => 'Talkative'
                ],
                [
                    'id' => 58,
                    'name' => 'Humble'
                ],
                [
                    'id' => 59,
                    'name' => 'Pessimistic'
                ],
            ];
//             $res = $this->client->get(env('API_BASE_URL').'admin/questions');
//             $questions = json_decode($res->getBody(),true);
            
            return view('pages.public.test')
                ->with('step1Questions', $step1Questions)
                ->with('step2Questions', $step2Questions)
                ->with('step3Questions', $step3Questions)
                ->with('step4Questions', $step4Questions)
            ;
        } catch(RequestException $e){
            dd($e->getCode());
            return $this->handleError($e->getCode());
        }
    }

    public function submitTest(Request $request){
        dd('exito', $request->all());
    }
}
