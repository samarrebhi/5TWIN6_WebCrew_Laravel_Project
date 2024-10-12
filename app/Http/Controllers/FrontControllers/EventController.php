<?php
namespace App\Http\Controllers\FrontControllers;
use App\Models\User; // Assurez-vous que le chemin est correct

use App\Http\Controllers\Controller;
use App\Models\EvenementCollecte; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class EventController extends Controller
{
    public function index()
    {
        $evenements = EvenementCollecte::paginate(10);
        return view('front.event.listevent', compact('evenements'));
    }

    public function show($id)
    {
        $event = EvenementCollecte::findOrFail($id);
        return view('Front.event.details', compact('event'));
    }

    public function exportPdf($id)
    {
        $event = EvenementCollecte::findOrFail($id);
        $pdf = PDF::loadView('Front.event_pdf', compact('event'));
        return $pdf->download('event_details.pdf');
    }

    public function participate($id)
    {
        $event = EvenementCollecte::findOrFail($id);
        $user = Auth::user();
    
        $participants = json_decode($event->participants, true);
    
        if (!is_array($participants)) {
            $participants = [];
        }
    
        if (in_array($user->id, $participants)) {
            return back()->with('error', 'You have already participated in this event.');
        }
    
        $participants[] = $user->id;
        $event->participants = json_encode($participants);
        $event->save();
    
        return back()->with('success', 'You have successfully participated in the event.');
    }











    public function allParticipants()
    {
        // Get the current user's ID (the admin)
        $adminId = auth()->id();
        
        // Retrieve all events created by the admin
        $evenements = EvenementCollecte::where('created_by', $adminId)->get();
        
        $participants = [];
        
        // Retrieve the details of participants for each event
        foreach ($evenements as $event) {
            $eventParticipants = json_decode($event->participants, true);
            
            if (is_array($eventParticipants)) {
                foreach ($eventParticipants as $userId) {
                    $user = User::find($userId);
                    if ($user) {
                        $participants[] = [
                            'user' => $user,
                            'event' => $event,
                            'event_creator' => User::find($event->created_by), // Fetch event creator
                            'participation_time' => $event->created_at, // or another date if you have a specific field
                        ];
                    }
                }
            }
        }
        
        // Return the view with filtered participants
        return view('evenement_collecte.participants', compact('participants'));
    }
    
    
}
