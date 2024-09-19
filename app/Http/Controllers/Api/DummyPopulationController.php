<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DummyPopulationController extends Controller
{

    public function getTotalPopulation()
    {
        return response()->json(
            [
                [
                    "Total_Population" =>  23256
                ]
            ]
        );
    }
    public function getNumberOfChildren()
    {
        return response()->json(
            [
                [
                    "Number_of_Children" =>  32545
                ]
            ]
        );
    }

    public function getNumberOfAdults()
    {
        return response()->json(
            [
                [
                    "Number_of_Adults" =>  98364
                ]
            ]
        );
    }

    public function getNumberOfElderly()
    {
        return response()->json(
            [
                [
                    "Number_of_Elderly" =>  34578
                ]
            ]
        );
    }

    public function getAgeGroups()
    {
        $ageGroups = [
            ["age_group" => "0-4", "number_of_people" => 279235],
            ["age_group" => "5-9", "number_of_people" => 265000],
            ["age_group" => "10-14", "number_of_people" => 273004],
            ["age_group" => "15-19", "number_of_people" => 251209],
            ["age_group" => "20-24", "number_of_people" => 238765],
            ["age_group" => "25-29", "number_of_people" => 224456],
            ["age_group" => "30-34", "number_of_people" => 210987],
            ["age_group" => "35-39", "number_of_people" => 198765],
            ["age_group" => "40-44", "number_of_people" => 187654],
            ["age_group" => "45-49", "number_of_people" => 176543],
            ["age_group" => "50-54", "number_of_people" => 165432],
            ["age_group" => "55-59", "number_of_people" => 154321],
            ["age_group" => "60-64", "number_of_people" => 143210],
            ["age_group" => "65-69", "number_of_people" => 132109],
            ["age_group" => "70-74", "number_of_people" => 121098],
            ["age_group" => "75-79", "number_of_people" => 110987],
            ["age_group" => "80-84", "number_of_people" => 100876],
            ["age_group" => "85-89", "number_of_people" => 90876],
            ["age_group" => "90+", "number_of_people" => 80987]
        ];

        return response()->json($ageGroups);
    }


    public function getAgeGenderGroups()
    {
        $dummyData = [
            ["age_group" => "0-4", "gender" => "2", "number_of_people" => 50000],
            ["age_group" => "0-4", "gender" => "1", "number_of_people" => 51000],
            ["age_group" => "5-9", "gender" => "2", "number_of_people" => 48000],
            ["age_group" => "5-9", "gender" => "1", "number_of_people" => 49000],
            ["age_group" => "10-14", "gender" => "2", "number_of_people" => 45000],
            ["age_group" => "10-14", "gender" => "1", "number_of_people" => 46000],
            ["age_group" => "15-19", "gender" => "2", "number_of_people" => 43000],
            ["age_group" => "15-19", "gender" => "1", "number_of_people" => 44000],
            ["age_group" => "20-24", "gender" => "2", "number_of_people" => 42000],
            ["age_group" => "20-24", "gender" => "1", "number_of_people" => 43000],
            ["age_group" => "25-29", "gender" => "2", "number_of_people" => 41000],
            ["age_group" => "25-29", "gender" => "1", "number_of_people" => 42000],
            ["age_group" => "30-34", "gender" => "2", "number_of_people" => 40000],
            ["age_group" => "30-34", "gender" => "1", "number_of_people" => 41000],
            ["age_group" => "35-39", "gender" => "2", "number_of_people" => 39000],
            ["age_group" => "35-39", "gender" => "1", "number_of_people" => 40000],
            ["age_group" => "40-44", "gender" => "2", "number_of_people" => 38000],
            ["age_group" => "40-44", "gender" => "1", "number_of_people" => 39000],
            ["age_group" => "45-49", "gender" => "2", "number_of_people" => 37000],
            ["age_group" => "45-49", "gender" => "1", "number_of_people" => 38000],
            ["age_group" => "50-54", "gender" => "2", "number_of_people" => 36000],
            ["age_group" => "50-54", "gender" => "1", "number_of_people" => 37000],
            ["age_group" => "55-59", "gender" => "2", "number_of_people" => 35000],
            ["age_group" => "55-59", "gender" => "1", "number_of_people" => 36000],
            ["age_group" => "60-64", "gender" => "2", "number_of_people" => 34000],
            ["age_group" => "60-64", "gender" => "1", "number_of_people" => 35000],
            ["age_group" => "65-69", "gender" => "2", "number_of_people" => 33000],
            ["age_group" => "65-69", "gender" => "1", "number_of_people" => 34000],
            ["age_group" => "70-74", "gender" => "2", "number_of_people" => 32000],
            ["age_group" => "70-74", "gender" => "1", "number_of_people" => 33000],
            ["age_group" => "75-79", "gender" => "2", "number_of_people" => 31000],
            ["age_group" => "75-79", "gender" => "1", "number_of_people" => 32000],
            ["age_group" => "80-84", "gender" => "2", "number_of_people" => 30000],
            ["age_group" => "80-84", "gender" => "1", "number_of_people" => 31000],
            ["age_group" => "85-89", "gender" => "2", "number_of_people" => 29000],
            ["age_group" => "85-89", "gender" => "1", "number_of_people" => 30000],
            ["age_group" => "90+", "gender" => "2", "number_of_people" => 28000],
            ["age_group" => "90+", "gender" => "1", "number_of_people" => 29000]
        ];

        return response()->json($dummyData);
    }

    public function getAgeGenderMaritalGroups(Request $request)
    {
        $ageGroups = [];
        $genders = [1, 2];
        $ageRanges = [
            "0-4",
            "5-9",
            "10-14",
            "15-19",
            "20-24",
            "25-29",
            "30-34",
            "35-39",
            "40-44",
            "45-49",
            "50-54",
            "55-59",
            "60-64",
            "65-69",
            "70-74",
            "75-79",
            "80-84",
            "85-89",
            "90+"
        ];

        $maritalStatus = $request->marital_status;

        if (in_array($maritalStatus, ["married", "single", "widowed", "separated"])) {
            foreach ($ageRanges as $ageRange) {
                foreach ($genders as $gender) {
                    $ageGroups[] = [
                        "age_group" => $ageRange,
                        "gender" => $gender,
                        "number_of_people" => rand(100, 300)
                    ];
                }
            }
        } else {
            foreach ($ageRanges as $ageRange) {
                foreach ($genders as $gender) {
                    $ageGroups[] = [
                        "age_group" => $ageRange,
                        "gender" => $gender,
                        "number_of_people" => rand(50, 200)
                    ];
                }
            }
        }

        return response()->json($ageGroups);
    }


    // public function getAgeGenderMaritalGroups()
    // {
    //     $dummyData = [
    //         ["age_group" => "0-4", "gender" => "0", "marital_status" => "6", "number_of_people" => 7],
    //         ["age_group" => "0-4", "gender" => "0", "marital_status" => "9", "number_of_people" => 4],
    //         ["age_group" => "0-4", "gender" => "1", "marital_status" => "6", "number_of_people" => 5],
    //         ["age_group" => "0-4", "gender" => "1", "marital_status" => "9", "number_of_people" => 3],
    //         ["age_group" => "5-9", "gender" => "0", "marital_status" => "6", "number_of_people" => 15],
    //         ["age_group" => "5-9", "gender" => "0", "marital_status" => "9", "number_of_people" => 10],
    //         ["age_group" => "5-9", "gender" => "1", "marital_status" => "6", "number_of_people" => 12],
    //         ["age_group" => "5-9", "gender" => "1", "marital_status" => "9", "number_of_people" => 8],
    //         ["age_group" => "10-14", "gender" => "0", "marital_status" => "6", "number_of_people" => 25],
    //         ["age_group" => "10-14", "gender" => "0", "marital_status" => "9", "number_of_people" => 18],
    //         ["age_group" => "10-14", "gender" => "1", "marital_status" => "6", "number_of_people" => 20],
    //         ["age_group" => "10-14", "gender" => "1", "marital_status" => "9", "number_of_people" => 15],
    //         ["age_group" => "15-19", "gender" => "0", "marital_status" => "6", "number_of_people" => 30],
    //         ["age_group" => "15-19", "gender" => "0", "marital_status" => "9", "number_of_people" => 25],
    //         ["age_group" => "15-19", "gender" => "1", "marital_status" => "6", "number_of_people" => 28],
    //         ["age_group" => "15-19", "gender" => "1", "marital_status" => "9", "number_of_people" => 22],
    //         ["age_group" => "20-24", "gender" => "0", "marital_status" => "6", "number_of_people" => 35],
    //         ["age_group" => "20-24", "gender" => "0", "marital_status" => "9", "number_of_people" => 30],
    //         ["age_group" => "20-24", "gender" => "1", "marital_status" => "6", "number_of_people" => 32],
    //         ["age_group" => "20-24", "gender" => "1", "marital_status" => "9", "number_of_people" => 28],
    //         ["age_group" => "25-29", "gender" => "0", "marital_status" => "6", "number_of_people" => 40],
    //         ["age_group" => "25-29", "gender" => "0", "marital_status" => "9", "number_of_people" => 35],
    //         ["age_group" => "25-29", "gender" => "1", "marital_status" => "6", "number_of_people" => 38],
    //         ["age_group" => "25-29", "gender" => "1", "marital_status" => "9", "number_of_people" => 32],
    //         ["age_group" => "30-34", "gender" => "0", "marital_status" => "6", "number_of_people" => 45],
    //         ["age_group" => "30-34", "gender" => "0", "marital_status" => "9", "number_of_people" => 40],
    //         ["age_group" => "30-34", "gender" => "1", "marital_status" => "6", "number_of_people" => 42],
    //         ["age_group" => "30-34", "gender" => "1", "marital_status" => "9", "number_of_people" => 38],
    //         ["age_group" => "35-39", "gender" => "0", "marital_status" => "6", "number_of_people" => 50],
    //         ["age_group" => "35-39", "gender" => "0", "marital_status" => "9", "number_of_people" => 45],
    //         ["age_group" => "35-39", "gender" => "1", "marital_status" => "6", "number_of_people" => 48],
    //         ["age_group" => "35-39", "gender" => "1", "marital_status" => "9", "number_of_people" => 42],
    //         ["age_group" => "40-44", "gender" => "0", "marital_status" => "6", "number_of_people" => 55],
    //         ["age_group" => "40-44", "gender" => "0", "marital_status" => "9", "number_of_people" => 50],
    //         ["age_group" => "40-44", "gender" => "1", "marital_status" => "6", "number_of_people" => 52],
    //         ["age_group" => "40-44", "gender" => "1", "marital_status" => "9", "number_of_people" => 48],
    //         ["age_group" => "45-49", "gender" => "0", "marital_status" => "6", "number_of_people" => 60],
    //         ["age_group" => "45-49", "gender" => "0", "marital_status" => "9", "number_of_people" => 55],
    //         ["age_group" => "45-49", "gender" => "1", "marital_status" => "6", "number_of_people" => 58],
    //         ["age_group" => "45-49", "gender" => "1", "marital_status" => "9", "number_of_people" => 52],
    //         ["age_group" => "50-54", "gender" => "0", "marital_status" => "6", "number_of_people" => 65],
    //         ["age_group" => "50-54", "gender" => "0", "marital_status" => "9", "number_of_people" => 60],
    //         ["age_group" => "50-54", "gender" => "1", "marital_status" => "6", "number_of_people" => 62],
    //         ["age_group" => "50-54", "gender" => "1", "marital_status" => "9", "number_of_people" => 55],
    //         ["age_group" => "55-59", "gender" => "0", "marital_status" => "6", "number_of_people" => 70],
    //         ["age_group" => "55-59", "gender" => "0", "marital_status" => "9", "number_of_people" => 65],
    //         ["age_group" => "55-59", "gender" => "1", "marital_status" => "6", "number_of_people" => 68],
    //         ["age_group" => "55-59", "gender" => "1", "marital_status" => "9", "number_of_people" => 60],
    //         ["age_group" => "60-64", "gender" => "0", "marital_status" => "6", "number_of_people" => 75],
    //         ["age_group" => "60-64", "gender" => "0", "marital_status" => "9", "number_of_people" => 70],
    //         ["age_group" => "60-64", "gender" => "1", "marital_status" => "6", "number_of_people" => 72],
    //         ["age_group" => "60-64", "gender" => "1", "marital_status" => "9", "number_of_people" => 65],
    //         ["age_group" => "65-69", "gender" => "0", "marital_status" => "6", "number_of_people" => 80],
    //         ["age_group" => "65-69", "gender" => "0", "marital_status" => "9", "number_of_people" => 75],
    //         ["age_group" => "65-69", "gender" => "1", "marital_status" => "6", "number_of_people" => 78],
    //         ["age_group" => "65-69", "gender" => "1", "marital_status" => "9", "number_of_people" => 70],
    //         ["age_group" => "70-74", "gender" => "0", "marital_status" => "6", "number_of_people" => 85],
    //         ["age_group" => "70-74", "gender" => "0", "marital_status" => "9", "number_of_people" => 80],
    //         ["age_group" => "70-74", "gender" => "1", "marital_status" => "6", "number_of_people" => 82],
    //         ["age_group" => "70-74", "gender" => "1", "marital_status" => "9", "number_of_people" => 75],
    //         ["age_group" => "75-79", "gender" => "0", "marital_status" => "6", "number_of_people" => 90],
    //         ["age_group" => "75-79", "gender" => "0", "marital_status" => "9", "number_of_people" => 85],
    //         ["age_group" => "75-79", "gender" => "1", "marital_status" => "6", "number_of_people" => 88],
    //         ["age_group" => "75-79", "gender" => "1", "marital_status" => "9", "number_of_people" => 80],
    //         ["age_group" => "80-84", "gender" => "0", "marital_status" => "6", "number_of_people" => 95],
    //         ["age_group" => "80-84", "gender" => "0", "marital_status" => "9", "number_of_people" => 90],
    //         ["age_group" => "80-84", "gender" => "1", "marital_status" => "6", "number_of_people" => 92],
    //         ["age_group" => "80-84", "gender" => "1", "marital_status" => "9", "number_of_people" => 85],
    //         ["age_group" => "85-89", "gender" => "0", "marital_status" => "6", "number_of_people" => 100],
    //         ["age_group" => "85-89", "gender" => "0", "marital_status" => "9", "number_of_people" => 95],
    //         ["age_group" => "85-89", "gender" => "1", "marital_status" => "6", "number_of_people" => 98],
    //         ["age_group" => "85-89", "gender" => "1", "marital_status" => "9", "number_of_people" => 90],
    //         ["age_group" => "90+", "gender" => "0", "marital_status" => "6", "number_of_people" => 110],
    //         ["age_group" => "90+", "gender" => "0", "marital_status" => "9", "number_of_people" => 100],
    //         ["age_group" => "90+", "gender" => "1", "marital_status" => "6", "number_of_people" => 105],
    //         ["age_group" => "90+", "gender" => "1", "marital_status" => "9", "number_of_people" => 95]
    //     ];

    //     return response()->json($dummyData);
    // }

    public function getSingleAgeGenderGroups()
    {
        $dummyData = [
            ["age_group" => "0-4", "gender" => "1", "number_of_people" => 7],
            ["age_group" => "0-4", "gender" => "2", "number_of_people" => 7],
            ["age_group" => "0-4", "gender" => "1", "number_of_people" => 136],
            ["age_group" => "5-9", "gender" => "2", "number_of_people" => 10],
            ["age_group" => "5-9", "gender" => "1", "number_of_people" => 145],
            ["age_group" => "10-14", "gender" => "2", "number_of_people" => 15],
            ["age_group" => "10-14", "gender" => "1", "number_of_people" => 152],
            ["age_group" => "15-19", "gender" => "2", "number_of_people" => 20],
            ["age_group" => "15-19", "gender" => "1", "number_of_people" => 160],
            ["age_group" => "20-24", "gender" => "2", "number_of_people" => 25],
            ["age_group" => "20-24", "gender" => "1", "number_of_people" => 168],
            ["age_group" => "25-29", "gender" => "2", "number_of_people" => 30],
            ["age_group" => "25-29", "gender" => "1", "number_of_people" => 175],
            ["age_group" => "30-34", "gender" => "2", "number_of_people" => 35],
            ["age_group" => "30-34", "gender" => "1", "number_of_people" => 182],
            ["age_group" => "35-39", "gender" => "2", "number_of_people" => 40],
            ["age_group" => "35-39", "gender" => "1", "number_of_people" => 190],
            ["age_group" => "40-44", "gender" => "2", "number_of_people" => 45],
            ["age_group" => "40-44", "gender" => "1", "number_of_people" => 197],
            ["age_group" => "45-49", "gender" => "2", "number_of_people" => 50],
            ["age_group" => "45-49", "gender" => "1", "number_of_people" => 205],
            ["age_group" => "50-54", "gender" => "2", "number_of_people" => 55],
            ["age_group" => "50-54", "gender" => "1", "number_of_people" => 212],
            ["age_group" => "55-59", "gender" => "2", "number_of_people" => 60],
            ["age_group" => "55-59", "gender" => "1", "number_of_people" => 220],
            ["age_group" => "60-64", "gender" => "2", "number_of_people" => 65],
            ["age_group" => "60-64", "gender" => "1", "number_of_people" => 227],
            ["age_group" => "65-69", "gender" => "2", "number_of_people" => 70],
            ["age_group" => "65-69", "gender" => "1", "number_of_people" => 235],
            ["age_group" => "70-74", "gender" => "2", "number_of_people" => 75],
            ["age_group" => "70-74", "gender" => "1", "number_of_people" => 242],
            ["age_group" => "75-79", "gender" => "2", "number_of_people" => 80],
            ["age_group" => "75-79", "gender" => "1", "number_of_people" => 250],
            ["age_group" => "80-84", "gender" => "2", "number_of_people" => 85],
            ["age_group" => "80-84", "gender" => "1", "number_of_people" => 257],
            ["age_group" => "85-89", "gender" => "2", "number_of_people" => 90],
            ["age_group" => "85-89", "gender" => "1", "number_of_people" => 265],
            ["age_group" => "90+", "gender" => "2", "number_of_people" => 95],
            ["age_group" => "90+", "gender" => "1", "number_of_people" => 272]
        ];

        return response()->json($dummyData);
    }
}
