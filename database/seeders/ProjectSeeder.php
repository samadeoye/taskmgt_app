<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            ['title' => 'Recruitment Portal', 'status' => 1],
            ['title' => 'Student Portal', 'status' => 1],
            ['title' => 'Loan System', 'status' => 1],
            ['title' => 'Marketplace App', 'status' => 1],
            ['title' => 'CBT System', 'status' => 1],
            ['title' => 'Banking API', 'status' => 1],
            ['title' => 'VTU Portal', 'status' => 1],
            ['title' => 'Calculator App', 'status' => 1],
            ['title' => 'Blog App', 'status' => 1],
            ['title' => 'CRM System', 'status' => 1],
            ['title' => 'EMR App', 'status' => 1],
            ['title' => 'Collaboration System', 'status' => 1],
            ['title' => 'Employee Records System', 'status' => 1],
            ['title' => 'Staff Payroll App', 'status' => 1],
            ['title' => 'iOS Game', 'status' => 1],
        ];
        foreach($projects as $project){
            Project::create($project);
        }
    }
}
