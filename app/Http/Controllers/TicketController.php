<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Jobs\SendEmailJob;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Models\ServiceDetail;
use App\Mail\AwaitingPartsEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    
    public function new_tickets(){
        return view('retailer.tickets.new_tickets');
    }
    
    public function updateTicketStatus(Request $request)
    {
        
        $ticketId = $request->input('ticketId');
        $status = $request->input('status');
       

      

        $ticket = Ticket::where('id', $ticketId)->first();

        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'Ticket not found'], 404);
        }


        // Validate the input status if necessary
        // Add any other necessary validations
        if($status == 'awaiting_collection'){
            // Mail::to('zeeshan.wpdev@gmail.com')->send(new AwaitingPartsEmail($ticket));
            SendEmailJob::dispatch('zeeshan.wpdev@gmail.com', new AwaitingPartsEmail($ticket))->onQueue('emails');
        }
       
        $ticket->ticket_status = $status;
        if ($ticket->save()) {
            $message = "Status Updated Successfully";
         
            return response()->json(['status' => 'success', 'message' => $message], 200);
        } else {
            $message = "Failed to Update Status";
            return response()->json(['status' => 'error', 'message' => $message], 500);
        }
    }


    public function tickets()
    {
        $allTickets = Ticket::with(['serviceDetail.deviceIssue','customer'])->orderBy('id','desc')->get();
        $pendingTickets = Ticket::with(['serviceDetail.deviceIssue','customer'])->where('ticket_status', 'pending')->orderBy('id','desc')->get();
        $inProgressTickets = Ticket::with(['serviceDetail.deviceIssue','customer'])->where('ticket_status', 'in_progress')->orderBy('id','desc')->get();
        $completedTickets = Ticket::with(['serviceDetail.deviceIssue','customer'])->where('ticket_status', 'completed')->orderBy('id','desc')->get();
        
        return view('retailer.tickets.index', compact('allTickets', 'pendingTickets', 'inProgressTickets', 'completedTickets'));
    }

    public function searchTickets(Request $request, $status = 'all')
    {
        $searchQuery = $request->input('searchQuery');

        $ticketsQuery = Ticket::query();

        if ($searchQuery) {
            $ticketsQuery->where(function ($query) use ($searchQuery) {
                $query->where('ticket_id', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('customer', function ($query) use ($searchQuery) {
                        $query->where('first_name', 'like', '%' . $searchQuery . '%')
                            ->orWhere('last_name', 'like', '%' . $searchQuery . '%');
                    });
            });
        }


        // Apply conditions based on status
        if ($status !== 'all') {
            $ticketsQuery->where('ticket_status', $status);
        }

        // Assuming you have a relationship between Ticket and Customer
        $ticketsQuery->with('serviceDetail.deviceIssue','customer');
        
        // Get the final result
        $tickets = $ticketsQuery->orderBy('id','desc')->get();
        return response()->json(['tickets' => $tickets]);
    }

    public function printTicket($ticketId){
        if($ticketId){
            $billDetails = BillDetail::where('ticket_id', $ticketId)->first();
            $ticket = Ticket::where('id', $ticketId)->first();
           if(!$billDetails){

            return response()->json(['error' => 'Bill details not found.'], 404);

           }else{
            $pdf = PDF::loadView('retailer.print_bill', ['billDetails' => $billDetails]);
            $pdfContent = $pdf->output();
    
            // Convert the PDF content to base64
            $base64Pdf = base64_encode($pdfContent);
    
            // Return the base64-encoded PDF content in the response
            return response()->json(['pdf' => $base64Pdf]);

           }
        }else{

            return redirect()->back()->with('error','Error Occur! No Ticket Found');
        }

    }

    public function printLabel($ticketId){
        if($ticketId){
            $billDetails = BillDetail::where('ticket_id', $ticketId)->first();
            $ticket = Ticket::where('id', $ticketId)->first();
           if(!$billDetails){

            return response()->json(['error' => 'Bill details not found.'], 404);

           }else{
            $pdf = PDF::loadView('retailer.print_bill', ['billDetails' => $billDetails]);
            $pdfContent = $pdf->output();
    
            // Convert the PDF content to base64
            $base64Pdf = base64_encode($pdfContent);
    
            // Return the base64-encoded PDF content in the response
            return response()->json(['pdf' => $base64Pdf]);

           }
        }else{

            return redirect()->back()->with('error','Error Occur! No Ticket Found');
        }

    }
}
