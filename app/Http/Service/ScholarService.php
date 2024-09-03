<?php

namespace App\Http\Service;
use App\Http\Controllers\Controller;
use App\Models\User;
use Goutte\Client;

class ScholarService
{

    private $scheme = "https";

    public function __construct()
    {
    }

    public function getInfo($scholarId){
        $client = new Client();
        $url = ($this->scheme."://scholar.google.com/citations?hl=en&user=".$scholarId);
        $page = $client->request('GET', $url);
        $citations = $this->collectCitationAllYears($page);
        $index = $this->collectGeneralInfo($page);
        return [$citations, $index];
    }

    public function collectGeneralInfo($page){
        //gsc_rsb_std
        $index = $page->filter('.gsc_rsb_std')->each(function ($item){
            return (int)$item->text();
        });
        $generalInfo = [
            "full_citation" => $index[0],
            "hIndex" => $index[2],
            "i10-index" => $index[4]
        ];
        return $generalInfo;
    }

    public function collectCitationAllYears($page){
        $yearsPopulated = $page->filter('.gsc_g_t')->each(function ($item){
            return (int)$item->text();
        });
        $citations = $page->filter('a.gsc_g_a')->each(function ($item){
            $style = $item->attr("style");
            $zIndex = $this->getStyleValue($style, 'z-index');
            return [
                $item->text(),
                $zIndex
            ];
        });
        $yearsPopulated = array_reverse($yearsPopulated);
        $citations = array_reverse($citations);
        $output = [];
        for ($i = 1; $i <= count($yearsPopulated); $i++){
            if (($yearsPopulated[$i-1]) > 2014){
                $output[$i - 1]["year"] = $yearsPopulated[$i - 1];
                $output[$i - 1]["num_of_citation"] = $this->findCorrespondingCitation($citations, $i);
            }
        }
        return $output;
    }

    public function getCitationInYear($citations, $year){
        foreach ($citations as $citation){
            if ($citation["year"] == $year) {
                return $citation;
            }
        }
        return ["year" => $year, "num_of_citation" => 0];
    }

    public function test(){
        $user = User::find(1);
        $this->getInfo($user->lecturer->scholar_id,2025);
    }

    private function findCorrespondingCitation($citations, $i){
        foreach ($citations as $citation){
            if ($i == $citation[1]) {
                return (int)$citation[0];
            }
        }
        return 0;
    }

    private function getStyleValue($style, $property)
    {
        preg_match("/$property\s*:\s*([^;]+);?/", $style, $matches);
        return $matches[1] ?? null;
    }
}
