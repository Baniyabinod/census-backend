<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopulationController extends Controller
{
    public function getFirstAndLastName()
    {

        $data =  DB::table('coded_census')
            ->where(DB::raw('CAST(SUBSTR(kilde, 8) AS INTEGER)'), '=', 1910)
            ->where('etnisitet_fars_etnisitet_i_1875', 4100)
            ->select('fornavn', 'etternavn')
            ->get();
        return response()->json($data);


        //example of raw query
        /*$data = DB::select('SELECT * FROM coded_census WHERE CAST(SUBSTR(kilde, 8) AS INTEGER) = 1910 AND etnisitet_fars_etnisitet_i_1875 = 4100');
        return response()->json($data);
        */
    }

    public function getPopulationByGroup(Request $request)
    {
        // Retrieve the grouping field from the request, default to 'religion'
        $groupByField = $request->input('group_by', 'religion');

        // Validate the grouping field to ensure it's one of the expected values
        if (!in_array($groupByField, ['religion', 'etnisitet_fars_etnisitet_i_1875', 'famstatus_pos_en', 'sivilstatus', 'occ_hierarkisk_hovedyrke', 'occ_hierarkisk_biyrke', 'sykdom', 'spraak', 'statsborgerskap'])) {
            return response()->json(['error' => 'Invalid group by field'], 400);
        }

        // Log the grouping field for debugging
        \Log::info("Grouping by: $groupByField");

        try {
            // Execute the query with dynamic grouping
            $data = DB::table('coded_census')
                ->select($groupByField, DB::raw('COUNT(*) as Number_of_Persons'))
                ->where('kilde', 'census_1910')
                ->groupBy($groupByField)
                ->get();

            // Log the query result
            \Log::info("Query Result: " . json_encode($data));

            return response()->json($data);
        } catch (\Exception $e) {
            // Log any exception that occurs
            \Log::error("Query Error: " . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }





    public function getPopulationByAgeRange(Request $request)
    {
        // Retrieve and cast parameters to integer
        $min_age = (int) $request->input('min_age', 20);
        $max_age = (int) $request->input('max_age', 30);

        try {
            // Execute the query
            $data = DB::table('coded_census')
                ->select('kjonn', DB::raw('COUNT(*) as Number_of_Persons'))
                ->where('kilde', 'census_1910')
                ->whereBetween(
                    DB::raw('1910 - CAST(faar AS INTEGER)'),
                    [$min_age, $max_age]
                )
                ->groupBy('kjonn')
                ->get();

            return response()->json($data);
        } catch (\Exception $e) {
            // Log any exception that occurs
            \Log::error("Query Error: " . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }






    public function getPopulationByGender()
    {
        $data = DB::table('coded_census')
            ->select('kjonn', DB::raw('COUNT(*) as Number_of_Persons'))
            ->where('kilde', 'census_1910')
            ->groupBy('kjonn')
            ->get();
        return response()->json($data);
    }


    public function getTotalPopulation()
    {
        $data = DB::table('coded_census')
            ->select(DB::raw('COUNT(*) as Total_Population'))
            ->where('kilde', 'census_1910')
            ->get();

        return response()->json($data);
    }

    public function getNumberOfChildren()
    {
        $data = DB::table('coded_census')
            ->select(DB::raw('COUNT(*) as Number_of_Children'))
            ->where('kilde', 'census_1910')
            ->where(DB::raw('1910 - CAST(faar AS INTEGER)'), '<', 18)
            ->get();

        return response()->json($data);
    }

    public function getNumberOfAdults()
    {
        $data = DB::table('coded_census')
            ->select(DB::raw('COUNT(*) as Number_of_Adults'))
            ->where('kilde', 'census_1910')
            ->whereBetween(DB::raw('1910 - CAST(faar AS INTEGER)'), [18, 79])
            ->get();

        return response()->json($data);
    }

    public function getNumberOfElderly()
    {
        $data = DB::table('coded_census')
            ->select(DB::raw('COUNT(*) as Number_of_Elderly'))
            ->where('kilde', 'census_1910')
            ->whereRaw('(1910 - CAST(faar AS INTEGER)) >= 80')
            ->get();

        return response()->json($data);
    }



    public function getPersonsGroupedByMunicipality()
    {
        $data = DB::table('coded_census')
            ->select('kommunenr', DB::raw('COUNT(*) as Number_of_Persons'))
            ->where('kilde', 'census_1910')
            ->groupBy('kommunenr')
            ->get();

        return response()->json($data);
    }

    public function getPersonsGroupedByEnumerationDistrict()
    {
        $data = DB::table('coded_census')
            ->select('kretsnummer', DB::raw('COUNT(*) as Number_of_Persons'))
            ->where('kilde', 'census_1910')
            ->groupBy('kretsnummer')
            ->get();

        return response()->json($data);
    }

    public function getPersonsGroupedByResidence()
    {
        $data = DB::table('coded_census')
            ->select('bostedsnummer', DB::raw('COUNT(*) as Number_of_Persons'))
            ->where('kilde', 'census_1910')
            ->groupBy('bostedsnummer')
            ->get();

        return response()->json($data);
    }



    public function getPersonsGroupedByBirthRegion()
    {
        $data = DB::table('coded_census')
            ->select('fsted', DB::raw('COUNT(*) as Number_of_Persons'))
            ->where('kilde', 'census_1910')
            ->groupBy('fsted')
            ->get();

        return response()->json($data);
    }

    public function getPersonsGroupedByResidenceStatus()
    {
        $data = DB::table('coded_census')
            ->select('bostatus', DB::raw('COUNT(*) as Number_of_Persons'))
            ->where('kilde', 'census_1910')
            ->groupBy('bostatus')
            ->get();

        return response()->json($data);
    }

    public function getAgeGroups()
    {
        $ageGroups = DB::table('coded_census')
            ->select(DB::raw("
                CASE 
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 0 AND 4 THEN '0-4'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 5 AND 9 THEN '5-9'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 10 AND 14 THEN '10-14'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 15 AND 19 THEN '15-19'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 20 AND 24 THEN '20-24'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 25 AND 29 THEN '25-29'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 30 AND 34 THEN '30-34'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 35 AND 39 THEN '35-39'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 40 AND 44 THEN '40-44'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 45 AND 49 THEN '45-49'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 50 AND 54 THEN '50-54'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 55 AND 59 THEN '55-59'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 60 AND 64 THEN '60-64'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 65 AND 69 THEN '65-69'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 70 AND 74 THEN '70-74'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 75 AND 79 THEN '75-79'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 80 AND 84 THEN '80-84'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 85 AND 89 THEN '85-89'
                    WHEN (1910 - CAST(faar AS INTEGER)) >= 90 THEN '90+'
                    ELSE 'Unknown'
                END AS age_group,
                COUNT(*) AS number_of_people
            "))
            ->where('kilde', 'census_1910')
            ->groupBy('age_group')
            ->orderBy('age_group')
            ->get();
        return response()->json($ageGroups);
    }

    public function getAgeGenderGroups()
    {
        $ageGenderGroups = DB::table('coded_census')
            ->select(DB::raw("
                CASE 
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 0 AND 4 THEN '0-4'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 5 AND 9 THEN '5-9'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 10 AND 14 THEN '10-14'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 15 AND 19 THEN '15-19'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 20 AND 24 THEN '20-24'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 25 AND 29 THEN '25-29'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 30 AND 34 THEN '30-34'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 35 AND 39 THEN '35-39'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 40 AND 44 THEN '40-44'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 45 AND 49 THEN '45-49'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 50 AND 54 THEN '50-54'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 55 AND 59 THEN '55-59'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 60 AND 64 THEN '60-64'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 65 AND 69 THEN '65-69'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 70 AND 74 THEN '70-74'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 75 AND 79 THEN '75-79'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 80 AND 84 THEN '80-84'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 85 AND 89 THEN '85-89'
                    WHEN (1910 - CAST(faar AS INTEGER)) >= 90 THEN '90+'
                    ELSE 'Unknown'
                END AS age_group,
                kjonn AS gender,
                COUNT(*) AS number_of_people
            "))
            ->where('kilde', 'census_1910')
            ->groupBy('age_group', 'gender')
            ->orderBy('age_group')
            ->orderBy('gender')
            ->get();
        return response()->json($ageGenderGroups);
    }


    public function getAgeMaritalGroups()
    {
        $ageMaritalGroups = DB::table('coded_census')
            ->select(DB::raw("
                CASE 
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 0 AND 4 THEN '0-4'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 5 AND 9 THEN '5-9'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 10 AND 14 THEN '10-14'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 15 AND 19 THEN '15-19'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 20 AND 24 THEN '20-24'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 25 AND 29 THEN '25-29'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 30 AND 34 THEN '30-34'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 35 AND 39 THEN '35-39'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 40 AND 44 THEN '40-44'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 45 AND 49 THEN '45-49'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 50 AND 54 THEN '50-54'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 55 AND 59 THEN '55-59'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 60 AND 64 THEN '60-64'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 65 AND 69 THEN '65-69'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 70 AND 74 THEN '70-74'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 75 AND 79 THEN '75-79'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 80 AND 84 THEN '80-84'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 85 AND 89 THEN '85-89'
                    WHEN (1910 - CAST(faar AS INTEGER)) >= 90 THEN '90+'
                    ELSE 'Unknown'
                END AS age_group,
                sivilstatus AS marital_status,
                COUNT(*) AS number_of_people
            "))
            ->where('kilde', 'census_1910')
            ->groupBy('age_group', 'marital_status')
            ->orderBy('age_group')
            ->orderBy('marital_status')
            ->get();
        return response()->json($ageMaritalGroups);
    }

    public function getAgeGenderMaritalGroups(Request $request)
    {
        $maritalStatus = $request->input('marital_status');

        $maritalStatusCodes = [];
        switch ($maritalStatus) {
            case 'married':
                $maritalStatusCodes = [1, 2];
                break;
            case 'single':
                $maritalStatusCodes = [6];
                break;
            case 'widowed':
                $maritalStatusCodes = [5];
                break;
            case 'separated':
                $maritalStatusCodes = [3, 4];
                break;
            default:
                $maritalStatusCodes = [9]; // default ma chai unknown.
                break;
        }

        $ageMaritalGroups = DB::table('coded_census')
            ->select(DB::raw("
                CASE 
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 0 AND 4 THEN '0-4'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 5 AND 9 THEN '5-9'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 10 AND 14 THEN '10-14'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 15 AND 19 THEN '15-19'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 20 AND 24 THEN '20-24'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 25 AND 29 THEN '25-29'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 30 AND 34 THEN '30-34'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 35 AND 39 THEN '35-39'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 40 AND 44 THEN '40-44'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 45 AND 49 THEN '45-49'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 50 AND 54 THEN '50-54'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 55 AND 59 THEN '55-59'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 60 AND 64 THEN '60-64'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 65 AND 69 THEN '65-69'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 70 AND 74 THEN '70-74'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 75 AND 79 THEN '75-79'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 80 AND 84 THEN '80-84'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 85 AND 89 THEN '85-89'
                    WHEN (1910 - CAST(faar AS INTEGER)) >= 90 THEN '90+'
                    ELSE 'Unknown'
                END AS age_group,
                kjonn AS gender,
                COUNT(*) AS number_of_people
            "))
            ->where('kilde', 'census_1910')
            ->whereIn('sivilstatus', $maritalStatusCodes)
            ->whereIn('kjonn', [1, 2])
            ->groupBy('age_group', 'kjonn')
            ->orderBy('age_group')
            ->orderBy('kjonn')
            ->get();

        return response()->json($ageMaritalGroups);
    }

    // public function getAgeGenderMaritalGroups()
    // {
    //     $ageGenderMaritalGroups = DB::table('coded_census')
    //         ->select(DB::raw("
    //             CASE 
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 0 AND 4 THEN '0-4'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 5 AND 9 THEN '5-9'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 10 AND 14 THEN '10-14'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 15 AND 19 THEN '15-19'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 20 AND 24 THEN '20-24'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 25 AND 29 THEN '25-29'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 30 AND 34 THEN '30-34'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 35 AND 39 THEN '35-39'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 40 AND 44 THEN '40-44'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 45 AND 49 THEN '45-49'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 50 AND 54 THEN '50-54'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 55 AND 59 THEN '55-59'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 60 AND 64 THEN '60-64'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 65 AND 69 THEN '65-69'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 70 AND 74 THEN '70-74'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 75 AND 79 THEN '75-79'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 80 AND 84 THEN '80-84'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 85 AND 89 THEN '85-89'
    //                 WHEN (1910 - CAST(faar AS INTEGER)) >= 90 THEN '90+'
    //                 ELSE 'Unknown'
    //             END AS age_group,
    //             kjonn AS gender,
    //             sivilstatus AS marital_status,
    //             COUNT(*) AS number_of_people
    //         "))
    //         ->where('kilde', 'census_1910')
    //         ->groupBy('age_group', 'gender', 'marital_status')
    //         ->orderBy('age_group')
    //         ->orderBy('gender')
    //         ->orderBy('marital_status')
    //         ->get();
    //     return response()->json($ageGenderMaritalGroups);
    // }

    public function getSingleAgeGenderGroups()
    {
        $singleAgeGenderGroups = DB::table('coded_census')
            ->select(DB::raw("
                CASE 
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 0 AND 4 THEN '0-4'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 5 AND 9 THEN '5-9'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 10 AND 14 THEN '10-14'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 15 AND 19 THEN '15-19'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 20 AND 24 THEN '20-24'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 25 AND 29 THEN '25-29'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 30 AND 34 THEN '30-34'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 35 AND 39 THEN '35-39'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 40 AND 44 THEN '40-44'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 45 AND 49 THEN '45-49'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 50 AND 54 THEN '50-54'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 55 AND 59 THEN '55-59'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 60 AND 64 THEN '60-64'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 65 AND 69 THEN '65-69'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 70 AND 74 THEN '70-74'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 75 AND 79 THEN '75-79'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 80 AND 84 THEN '80-84'
                    WHEN (1910 - CAST(faar AS INTEGER)) BETWEEN 85 AND 89 THEN '85-89'
                    WHEN (1910 - CAST(faar AS INTEGER)) >= 90 THEN '90+'
                    ELSE 'Unknown'
                END AS age_group,
                kjonn AS gender,
                COUNT(*) AS number_of_people
            "))
            ->where('sivilstatus', '6') // Assuming '6' represents 'Single'
            ->where('kilde', 'census_1910')
            ->groupBy('age_group', 'gender')
            ->orderBy('age_group')
            ->orderBy('gender')
            ->get();
        return response()->json($singleAgeGenderGroups);
    }
}
