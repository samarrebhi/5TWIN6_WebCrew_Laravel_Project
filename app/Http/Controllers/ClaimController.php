<?php

namespace App\Http\Controllers;
use App\Mail\ClaimCreated; 
use Illuminate\Support\Facades\Mail;
use App\Models\Claim;
use App\Models\Center;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    // Afficher la liste des réclamations pour le client 
    public function index()
    {
        $claims = Claim::where('user_id', auth()->id())->get();
        return view('Front.Claims.claims', compact('claims')); 
    }

    // Montrer le formulaire de création d'une nouvelle réclamation
    public function create()
    {
        $centers = Center::all(); 
        return view('Front.Claims.create', compact('centers')); 
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:50',
        'description' => 'required|string|max:1000',
        'center_id' => 'required|exists:centers,id',
        'category' => 'required|in:service,quality,time,other', 
        'attachment' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:2048',
    ]);

    $attachmentPath = null; 

    if ($request->hasFile('attachment')) {
        $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        \Log::info('File stored at: ' . $attachmentPath);
    } else {
        \Log::warning('No file uploaded.');
    }

    // Créez la réclamation et stockez-la dans une variable
    $claim = Claim::create([
        'title' => $request->title,
        'category' => $request->category,
        'description' => $request->description,
        'status' => 'in_progress',
        'center_id' => $request->center_id,
        'attachment' => $attachmentPath, 
        'user_id' => auth()->id(),
    ]);

    // Envoyez l'e-mail avec la réclamation créée
   // Mail::to(auth()->user()->email)->send(new ClaimCreated($claim));

    return redirect()->route('claim.index')->with('success', 'Claim created successfully.');
}

    // Afficher les details d'une reclamation pour le client
    public function show($id)
    {
        $claim = Claim::findOrFail($id);

        if ($claim->user_id !== auth()->id()) {
            return redirect()->route('claim.index')->with('error', 'You are not authorized to view this claim.');
        }
    
        return view('Front.Claims.show', compact('claim')); 
    }

    // Montrer le formulaire pour éditer une réclamation
    public function edit($id)
    {
        $claim = Claim::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $centers = Center::all();
        return view('Front.Claims.edit', compact('claim', 'centers')); 
    }

    // Mettre à jour une réclamation
    public function update(Request $request, $id)
    {
        $claim = Claim::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'center_id' => 'required|exists:centers,id',
            'category' => 'required|in:service,quality,time,other',
            'attachment' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:2048',
        ]);

        $claim->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'center_id' => $validatedData['center_id'],
            'category' => $validatedData['category'],
            'attachment' => $request->hasFile('attachment') 
                ? $request->file('attachment')->store('attachments', 'public') 
                : $claim->attachment, 
        ]);

        return redirect()->route('claim.index')->with('success', 'Claim updated successfully.');  
    }

    // Supprimer une réclamation
    public function destroy($id)
    {
        $claim = Claim::findOrFail($id);

        if ($claim->user_id !== auth()->id()) {
            return redirect()->route('claim.index')->with('error', 'You are not authorized to delete this claim.');
        }
    
        $claim->delete();
    
        return redirect()->route('claim.index')->with('success', 'Claim deleted successfully.');
    }

     /*   public function adminIndex()
        {
            $claims = Claim::all(); 
            return view('Back.Claims.claims', compact('claims'));
        }*/

        // Afficher les détails d'une réclamation
        public function adminShow($id)
        {
            $claim = Claim::findOrFail($id);
            return view('Back.Claims.show', compact('claim'));
        }

        // Mettre à jour le statut d'une réclamation et ajouter une note
        public function updateStatus(Request $request, $id)
        {
            $request->validate([
                'status' => 'required|in:seen,in_progress',
                'admin_note' => 'nullable|string|max:1000',
            ]);

            $claim = Claim::findOrFail($id);
            $claim->status = $request->status;
            $claim->admin_note = $request->admin_note; 
            $claim->save();

            return redirect()->route('admin.claims.index')->with('success', 'Claim status updated successfully.');
        }
        public function adminIndex(Request $request)
        {
            // Récupérer les filtres depuis la requête
            $status = $request->input('status');
            $center_id = $request->input('center_id');
            $category = $request->input('category');
        
            // Construire la requête de base
            $query = Claim::query();
        
            // Appliquer les filtres si ils existent
            if ($status) {
                $query->where('status', $status);
            }
        
            if ($center_id) {
                $query->where('center_id', $center_id);
            }
        
            if ($category) {
                $query->where('category', $category);
            }
        
            // Récupérer les réclamations filtrées
            $claims = $query->with('center')->get();
        
            // Récupérer les centres disponibles pour le filtre
            $centers = Center::all();
        
            // Retourner les données à la vue
            return view('Back.Claims.claims', compact('claims', 'centers'));
        }
        
    
        
}
