<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function updateTicketStatus(Request $request)
    {
        $ticketId = $request->input('ticketId');
        $status = $request->input('status');

        $ticket = Ticket::where('id',$ticketId)->first();

        if (!$ticket) {
            return response()->json(['status'=>'erro','message' => 'Ticket not found'], 404);
            
        }


        // Validate the input status if necessary
        // Add any other necessary validations

        $ticket->ticket_status = $status;
        if ($ticket->save()) {
            $message = "Status Updated Successfully";
            return response()->json(['status'=>'success','message' => $message], 200);
        } else {
            $message = "Failed to Update Status";
            return response()->json(['status'=>'error','message' => $message], 500);
        }
    }


    public function tickets(){
        $auth_user = Auth::user();
        $tickets = Ticket::where('user_id', $auth_user->id)->get();
        if(sizeof($tickets) > 0){
            foreach($tickets as $t => $ticket){
               $service_detail =  ServiceDetail::where('id', $ticket->service_detail_id)->first();
               $ticket->service_detail = $service_detail;
            }
        }
        
        return view('retailer.tickets',compact('tickets'));
    }
}
