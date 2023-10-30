<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    public function filterRecords(Request $request)
    {
        $duration = $request->input('duration', '7days');
        $rows = $request->input('rows', 25);

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if ($duration == 'today') {
            $filteredRecords = Ticket::whereDate('created_at', $today)->paginate($rows);
        } elseif ($duration == 'yesterday') {
            $filteredRecords = Ticket::whereDate('created_at', $yesterday)->paginate($rows);
        } elseif ($duration == 'all') {
            $filteredRecords = Ticket::paginate($rows);
        } else {
            $durationDays = intval($duration);
            $startDate = $today->copy()->subDays($durationDays);
            $filteredRecords = Ticket::whereBetween('created_at', [$startDate, $today])->paginate($rows);
        }

        // Do something with the filtered records
        return view('your_view', compact('filteredRecords'));
    }

    public function updateTicketStatus(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $status = $request->input('status');

        // Validate the input status if necessary
        // Add any other necessary validations

        $ticket->status = $status;
        $ticket->save();

        return response()->json(['message' => 'Ticket status updated successfully', 'ticket' => $ticket], 200);
    }
}
