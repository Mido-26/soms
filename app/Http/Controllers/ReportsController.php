<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    // Display Monthly Reports
    public function monthlyReports()
    {
        // Example of data for the graph (replace with actual data)
        $data = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'values' => [10, 20, 30, 40, 50, 60],
        ];

        return view('reports.monthly', compact('data'));
    }

    // Display Annual Reports
    public function annualReports()
    {
        // Example of data for the graph (replace with actual data)
        $data = [
            'labels' => ['2020', '2021', '2022', '2023'],
            'values' => [100, 150, 200, 250],
        ];

        return view('reports.index', compact('data'));
    }

    // Display Custom Reports
    public function customReports()
    {
        // Example of data for the graph (replace with actual data)
        $data = [
            'labels' => ['Q1', 'Q2', 'Q3', 'Q4'],
            'values' => [15, 25, 35, 45],
        ];

        return view('reports.custom', compact('data'));
    }
}
