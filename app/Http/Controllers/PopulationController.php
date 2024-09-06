<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopulationController extends Controller
{
    public function getFirstAndLastName()
    {
        
        $data =  DB::table('coded_census')
        ->where(DB::raw('CAST(SUBSTR(kilde, 8) AS INTEGER)'), '=' , 1910)
        ->where('etnisitet_fars_etnisitet_i_1875', 4100)
        ->select('fornavn', 'etternavn')
        ->get();
        return response()->json($data);
        

        //example of raw query
        /*$data = DB::select('SELECT * FROM coded_census WHERE CAST(SUBSTR(kilde, 8) AS INTEGER) = 1910 AND etnisitet_fars_etnisitet_i_1875 = 4100');
        return response()->json($data);
        */
    }

    public function getPoulationByReligion(){
        $data = DB::table('coded_census')
        ->select('religion', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('religion')
        ->get();
        return response()->json($data);
    }

    public function getPopulationByEthnicity(){
        $data = DB::table('coded_census')
        ->select('etnisitet_fars_etnisitet_i_1875', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('etnisitet_fars_etnisitet_i_1875')
        ->get();
        return response()->json($data);

    }

    public function getPopulationByAge(){
        $data = DB::table('coded_census')
        ->select('kjonn', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->whereBetween(
            DB::raw('1910 - CAST(faar AS INTEGER)'), 
            [20, 30]
        )
        ->groupBy('kjonn')
        ->get();
        return response()->json($data);

    }

    public function getPopulationByGender(){
        $data = DB::table('coded_census')
        ->select('kjonn', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('kjonn')
        ->get();
        return response()->json($data);
    }

    public function getPopulationByFamilyPosition(){
        $data = DB::table('coded_census')
        ->select('famstatus_pos_en', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('famstatus_pos_en')
        ->get();
        return response()->json($data);
    }

    public function getPopulationByMaritalStatus(){
        $data = DB::table('coded_census')
        ->select('sivilstatus', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('sivilstatus')
        ->get();
        return response()->json($data);
    }

    public function getTotalPopulation(){
        $data = DB::table('coded_census')
            ->select(DB::raw('COUNT(*) as Total_Population'))
            ->where('kilde', 'census_1910')
            ->get();
            
        return response()->json($data);
    }

    public function getNumberOfChildren() {
        $data = DB::table('coded_census')
            ->select(DB::raw('COUNT(*) as Number_of_Children'))
            ->where('kilde', 'census_1910')
            ->where(DB::raw('1910 - CAST(faar AS INTEGER)'), '<', 18)
            ->get();
            
        return response()->json($data);
    }

    public function getNumberOfAdults() {
        $data = DB::table('coded_census')
            ->select(DB::raw('COUNT(*) as Number_of_Adults'))
            ->where('kilde', 'census_1910')
            ->whereBetween(DB::raw('1910 - CAST(faar AS INTEGER)'), [18, 79])
            ->get();
            
        return response()->json($data);
    }

    public function getNumberOfElderly(){
        $data = DB::table('coded_census')
        ->select(DB::raw('COUNT(*) as Number_of_Elderly'))
        ->where('kilde', 'census_1910')
        ->whereRaw('(1910 - CAST(faar AS INTEGER)) >= 80')
        ->get();
    
    return response()->json($data);
    }


    public function getPersonsGroupedByPrimaryOccupation(){
        $data = DB::table('coded_census')
        ->select('occ_hierarkisk_hovedyrke', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('occ_hierarkisk_hovedyrke')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedBySecondaryOccupation(){
        $data = DB::table('coded_census')
        ->select('occ_hierarkisk_biyrke', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('occ_hierarkisk_biyrke')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByMunicipality(){
        $data = DB::table('coded_census')
        ->select('kommunenr', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('kommunenr')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByEnumerationDistrict(){
        $data = DB::table('coded_census')
        ->select('kretsnummer', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('kretsnummer')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByResidence(){
        $data = DB::table('coded_census')
        ->select('bostedsnummer', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('bostedsnummer')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByMedicalCondition(){
        $data = DB::table('coded_census')
        ->select('sykdom', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('sykdom')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByLanguage(){
        $data = DB::table('coded_census')
        ->select('spraak', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('spraak')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByCitizenship(){
        $data = DB::table('coded_census')
        ->select('statsborgerskap', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('statsborgerskap')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByBirthRegion(){
        $data = DB::table('coded_census')
        ->select('fsted', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('fsted')
        ->get();
    
        return response()->json($data);
    }

    public function getPersonsGroupedByResidenceStatus(){
        $data = DB::table('coded_census')
        ->select('bostatus', DB::raw('COUNT(*) as Number_of_Persons'))
        ->where('kilde', 'census_1910')
        ->groupBy('bostatus')
        ->get();
    
        return response()->json($data);
    }

    





    



    
    
    

}