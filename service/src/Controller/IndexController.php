<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Replicate\Webhook\Prediction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IndexController extends AbstractController
{
    #[Route('/{route}', name: 'dashboard_index', requirements: ['route' => '.+'], defaults: ['route' => ''], methods: ['GET'], priority: -10000)]
    public function index(string $route): Response
    {
        return $this->render(
            'app/index.html.twig',
            [
                'route' => '/' . $route
            ]
        );
    }


    #[Route('/tests', name: 'dashboard_tests', methods: ['GET'], priority: 1)]
    public function tests(SerializerInterface $serializer): Response
    {
        $data = '{"id":"v66ds73bdmriqqanmvvdtkdi5a","version":"35042c9a33ac8fd5e29e27fb3197f33aa483f72c2ce3b0b9d201155c7fd2a287","input":{"prompt":"Generate 5 marketing taglines for promoting an hair dresser in Windsor","system_prompt":"You are a helpful, respectful and honest marketing assistant. You are funny and relaxed. \n Always output your answer in JSON. No pre-amble. No explanations.\n Your answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content. \n Please ensure that your responses are socially unbiased and positive in nature.\n "},"logs":"Your formatted prompt is:\n[INST] \u003c\u003cSYS\u003e\u003e\nYou are a helpful, respectful and honest marketing assistant. You are funny and relaxed.\nAlways output your answer in JSON. No pre-amble. No explanations.\nYour answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content.\nPlease ensure that your responses are socially unbiased and positive in nature.\n\u003c\u003c/SYS\u003e\u003e\nGenerate 5 marketing taglines for promoting an hair dresser in Windsor [/INST]\nNot using LoRA\nhostname: model-35042c9a-9eed970841a8c836-gpu-a100-67bfb5847-9x7g6\n","output":[""," {","\n","\"","Tag","line"," ","1","\":"," \"","Get"," roy","ally"," rest","y","led"," at"," our"," W","inds","or"," hair"," sal","on","!","\",","\n","\"","Tag","line"," ","2","\":"," \"","W","inds","or","\'","s"," top"," sty","lists"," await"," -"," come"," for"," a"," visit","ation"," crown","!","\",","\n","\"","Tag","line"," ","3","\":"," \"","Un","lock"," your"," royal"," potential"," with"," our"," W","inds","or"," hair"," dress","ers","!","\",","\n","\"","Tag","line"," ","4","\":"," \"","Ex","per","ience"," the"," op","ul","ence"," of"," W","inds","or"," through"," our"," lux","ur","ious"," ha","irst","yles","!","\",","\n","\"","Tag","line"," ","5","\":"," \"","Step"," into"," reg","ality"," with"," our"," expert"," hair"," services"," in"," W","inds","or",".\"","\n","}"],"error":null,"status":"succeeded","created_at":"2023-09-12T14:10:37.017395Z","started_at":"2023-09-12T14:10:37.052301Z","completed_at":"2023-09-12T14:10:53.968467Z","webhook":"https://2782-2001-818-db86-5900-20ca-18f0-965c-d001.ngrok-free.app/webhook/replicate/prediction","metrics":{"predict_time":16.916166},"urls":{"cancel":"https://api.replicate.com/v1/predictions/v66ds73bdmriqqanmvvdtkdi5a/cancel","get":"https://api.replicate.com/v1/predictions/v66ds73bdmriqqanmvvdtkdi5a"}}';
        $data = '{"id":"3at4milbzi2rxuunkmagr5qlae","version":"35042c9a33ac8fd5e29e27fb3197f33aa483f72c2ce3b0b9d201155c7fd2a287","input":{"prompt":"Generate 5 marketing taglines for promoting ButcherGenerate 5 marketing taglines for promoting Butcher in Ascot","system_prompt":"You are a helpful, respectful and honest marketing assistant. You are funny and relaxed. \n Always output your answer in JSON. No pre-amble. No explanations.\n Your answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content. \n Please ensure that your responses are socially unbiased and positive in nature.\n "},"logs":"Your formatted prompt is:\n[INST] \u003c\u003cSYS\u003e\u003e\nYou are a helpful, respectful and honest marketing assistant. You are funny and relaxed.\nAlways output your answer in JSON. No pre-amble. No explanations.\nYour answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content.\nPlease ensure that your responses are socially unbiased and positive in nature.\n\u003c\u003c/SYS\u003e\u003e\nGenerate 5 marketing taglines for promoting ButcherGenerate 5 marketing taglines for promoting Butcher in Ascot [/INST]\nNot using LoRA\nhostname: model-35042c9a-9eed970841a8c836-gpu-a100-57cc5d777-vqsnt\n","output":[""," Sure",","," here"," are"," five"," market","ing"," tag","lines"," for"," prom","oting"," But","cher"," in"," As","cot",":","\n","\n","1","."," \"","Get"," your"," meat"," on"," at"," But","cher"," in"," As","cot"," -"," the"," prime"," cut"," above"," the"," rest","!\"","\n","2","."," \"","A","sc","ot","\'","s"," fin","est"," but","ch","ery"," -"," served"," with"," a"," side"," of"," s","ass","\"","\n","3","."," \"","But","cher",":"," where"," quality"," meets"," qu","irk","iness"," in"," the"," heart"," of"," As","cot","\"","\n","4","."," \"","For"," the"," love"," of"," meat",","," come"," to"," But","cher"," in"," As","cot","\"","\n","5","."," \"","T","aste"," the"," difference"," at"," But","cher"," in"," As","cot"," -"," home"," of"," the"," happ","iest"," c","ows"," in"," town","\""],"error":null,"status":"succeeded","created_at":"2023-09-12T14:37:01.794592Z","started_at":"2023-09-12T14:37:01.831327Z","completed_at":"2023-09-12T14:37:18.762512Z","webhook":"https://2782-2001-818-db86-5900-20ca-18f0-965c-d001.ngrok-free.app/webhook/replicate/prediction","metrics":{"predict_time":16.931185},"urls":{"cancel":"https://api.replicate.com/v1/predictions/3at4milbzi2rxuunkmagr5qlae/cancel","get":"https://api.replicate.com/v1/predictions/3at4milbzi2rxuunkmagr5qlae"}}';
        $data = '{"id":"ogbagrdbzrjrhqgtiwssklwstu","version":"35042c9a33ac8fd5e29e27fb3197f33aa483f72c2ce3b0b9d201155c7fd2a287","input":{"prompt":"Generate 5 marketing taglines for promoting a Butcher in Ascot","system_prompt":"You are a helpful, respectful and honest marketing assistant. You are funny and relaxed. \n Always output your answer in JSON. No pre-amble. No explanations.\n Your answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content. \n Please ensure that your responses are socially unbiased and positive in nature.\n "},"logs":"Your formatted prompt is:\n[INST] \u003c\u003cSYS\u003e\u003e\nYou are a helpful, respectful and honest marketing assistant. You are funny and relaxed.\nAlways output your answer in JSON. No pre-amble. No explanations.\nYour answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content.\nPlease ensure that your responses are socially unbiased and positive in nature.\n\u003c\u003c/SYS\u003e\u003e\nGenerate 5 marketing taglines for promoting a Butcher in Ascot [/INST]\nNot using LoRA\nhostname: model-35042c9a-9eed970841a8c836-gpu-a100-57cc5d777-vqsnt\n","output":[""," {","\n","\"","But","cher"," in"," As","cot",":"," Qu","ality"," Me","ats"," for"," the"," Modern"," Pal","ate","\"","\n","\"","T","aste"," the"," D","ifference"," with"," Our"," Prem","ium"," C","uts","\"","\n","\"","A","sc","ot","\'","s"," Fin","est"," But","ch","ery",":"," Ex","pert","ly"," C","raft","ed"," Me","at"," Product","s","\"","\n","\"","From"," Farm"," to"," Table",":"," F","resh",","," S","ust","ain","able"," Me","ats","\"","\n","\"","Ex","per","ience"," the"," Art"," of"," But","ch","ery"," at"," Its"," Fin","est","\"","\n","}"],"error":null,"status":"succeeded","created_at":"2023-09-12T14:44:38.384275Z","started_at":"2023-09-12T14:44:38.41673Z","completed_at":"2023-09-12T14:44:50.808692Z","webhook":"https://2782-2001-818-db86-5900-20ca-18f0-965c-d001.ngrok-free.app/webhook/replicate/prediction","metrics":{"predict_time":12.391962},"urls":{"cancel":"https://api.replicate.com/v1/predictions/ogbagrdbzrjrhqgtiwssklwstu/cancel","get":"https://api.replicate.com/v1/predictions/ogbagrdbzrjrhqgtiwssklwstu"}}';
        var_dump($data);
        $prediction = $serializer->deserialize(
            $data,
            Prediction::class,
            'json'
        );
        var_dump($prediction);
        $predictionData = $serializer->serialize($prediction, 'json');
        $update = new Update(
            'predictions/update/' . $prediction->getId(),
            $predictionData
        );
        var_dump($predictionData);
        exit;
    }

}
