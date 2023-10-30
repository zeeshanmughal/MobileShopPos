<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::all();
        return view('user.team_members', compact('teamMembers'));
    }

    public function create()
    {
        // return view('team_members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'required' // Assuming 'user_id' is sent from the form
            // Add validation for other fields as needed
        ]);

        TeamMember::create($request->all());

        // return redirect()->route('team-members.index');
    }

    public function show(TeamMember $teamMember)
    {
        // return view('team_members.show', compact('teamMember'));
    }

    public function edit(TeamMember $teamMember)
    {
        // return view('team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'required' // Assuming 'user_id' is sent from the form
            // Add validation for other fields as needed
        ]);

        $teamMember->update($request->all());

        // return redirect()->route('team-members.index');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        // return redirect()->route('team-members.index');
    }
}
