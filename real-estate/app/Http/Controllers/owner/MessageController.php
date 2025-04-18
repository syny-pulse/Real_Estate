<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages
     */
    public function index(Request $request)
{
    $userId = Auth::id();
    $filter = $request->input('filter');

    // Get all properties owned by the current user
    $properties = Property::where('owner_id', $userId)->get();

    // Query to get conversations
    $query = Message::where(function($q) use ($userId) {
        $q->where('sender_id', $userId)
          ->orWhere('receiver_id', $userId);
    });

    // Apply filter if set
    if ($filter === 'sent') {
        $query->where('sender_id', $userId);
    } elseif ($filter === 'received') {
        $query->where('receiver_id', $userId);
    }

    // Get unique user IDs that the current user has communicated with
    $messagePartners = $query->get(['sender_id', 'receiver_id']);

    $userIds = [];
    foreach ($messagePartners as $message) {
        if ($message->sender_id != $userId) {
            $userIds[] = $message->sender_id;
        }
        if ($message->receiver_id != $userId) {
            $userIds[] = $message->receiver_id;
        }
    }

    $userIds = array_unique($userIds);

    // Get conversation users
    $conversationUsers = User::whereIn('id', $userIds)->get();

    // Format conversations with last message
    $conversations = [];
    foreach ($conversationUsers as $user) {
        $lastMessage = Message::where(function($q) use ($userId, $user) {
            $q->where(function($inner) use ($userId, $user) {
                $inner->where('sender_id', $userId)
                      ->where('receiver_id', $user->id);
            })->orWhere(function($inner) use ($userId, $user) {
                $inner->where('sender_id', $user->id)
                      ->where('receiver_id', $userId);
            });
        })
        ->orderBy('created_at', 'desc')
        ->first();

        if ($lastMessage) {
            $conversations[] = [
                'user' => $user,
                'last_message' => $lastMessage
            ];
        }
    }

    // Sort conversations by latest message
    usort($conversations, function($a, $b) {
        return $b['last_message']->created_at <=> $a['last_message']->created_at;
    });

    // Get users available to message (tenants, admin, etc.)
    $availableUsers = User::where('id', '!=', $userId)
                          ->where(function($q) {
                              $q->where('role', 'tenant')
                                ->orWhere('role', 'admin');
                          })
                          ->get();

    return view('owner.message', [
        'conversations' => $conversations,
        'properties' => $properties,
        'availableUsers' => $availableUsers,
        'selectedUserId' => null, // Add this to indicate no user is selected
        'selectedUser' => null,   // Add this to match the show method
        'messages' => []          // Add empty messages array to match the show method
    ]);
}

    /**
     * Display a specific conversation
     */
    public function show($userId)
    {
        $currentUserId = Auth::id();
        $selectedUser = User::findOrFail($userId);

        // Get messages between the two users
        $messages = Message::where(function($q) use ($currentUserId, $userId) {
            $q->where(function($inner) use ($currentUserId, $userId) {
                $inner->where('sender_id', $currentUserId)
                      ->where('receiver_id', $userId);
            })->orWhere(function($inner) use ($currentUserId, $userId) {
                $inner->where('sender_id', $userId)
                      ->where('receiver_id', $currentUserId);
            });
        })
        ->orderBy('created_at', 'asc')
        ->with('property')
        ->get();

        // Mark all messages from the selected user as read
        // (add a 'read_at' column if you want to implement read receipts)

        // Get all properties owned by the current user
        $properties = Property::where('owner_id', $currentUserId)->get();

        // Get conversation users (same code as in index)
        $userId = Auth::id();
        $messagePartners = Message::where(function($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->orWhere('receiver_id', $userId);
        })->get(['sender_id', 'receiver_id']);

        $userIds = [];
        foreach ($messagePartners as $message) {
            if ($message->sender_id != $userId) {
                $userIds[] = $message->sender_id;
            }
            if ($message->receiver_id != $userId) {
                $userIds[] = $message->receiver_id;
            }
        }

        $userIds = array_unique($userIds);
        $conversationUsers = User::whereIn('id', $userIds)->get();

        $conversations = [];
        foreach ($conversationUsers as $user) {
            $lastMessage = Message::where(function($q) use ($userId, $user) {
                $q->where(function($inner) use ($userId, $user) {
                    $inner->where('sender_id', $userId)
                          ->where('receiver_id', $user->id);
                })->orWhere(function($inner) use ($userId, $user) {
                    $inner->where('sender_id', $user->id)
                          ->where('receiver_id', $userId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->first();

            if ($lastMessage) {
                $conversations[] = [
                    'user' => $user,
                    'last_message' => $lastMessage
                ];
            }
        }

        // Sort conversations by latest message
        usort($conversations, function($a, $b) {
            return $b['last_message']->created_at <=> $a['last_message']->created_at;
        });

        // Get users available to message
        $availableUsers = User::where('id', '!=', $userId)
                              ->where(function($q) {
                                  $q->where('role', 'cutomer')
                                    ->orWhere('role', 'admin');
                              })
                              ->get();

        return view('owner.message', [
            'conversations' => $conversations,
            'messages' => $messages,
            'selectedUser' => $selectedUser,
            'selectedUserId' => $selectedUser->id,
            'properties' => $properties,
            'availableUsers' => $availableUsers
        ]);
    }

    /**
     * Store a new message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users,email',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
            'property_id' => 'nullable|exists:properties,id'
        ]);

         // Retrieve the user by email
        $recipient = User::where('email', $validated['email'])->first();

         // Get the user ID
         $receiver_id = $recipient->id;

        // Check if property belongs to the user if property_id is provided
        if (!empty($validated['property_id'])) {
            $property = Property::find($validated['property_id']);
            if (!$property || $property->owner_id !== Auth::id()) {
                return back()->with('error', 'You can only reference properties you own.');
            }
        }

        // Create new message
        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $receiver_id;
        $message->subject = $validated['subject'];
        $message->content = $validated['content'];
        $message->property_id = $validated['property_id'] ?? null;
        $message->save();

        return redirect()->route('messages.show', $receiver_id)
                         ->with('success', 'Message sent successfully.');
    }

    /**
     * Reply to a message
     */
    public function reply(Request $request, $userId)
    {
        $validated = $request->validate([
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
            'property_id' => 'nullable|exists:properties,id'
        ]);

        // Check if user exists
        $receiver = User::findOrFail($userId);

        // Check if property belongs to the user if property_id is provided
        if (!empty($validated['property_id'])) {
            $property = Property::find($validated['property_id']);
            if (!$property || $property->owner_id !== Auth::id()) {
                return back()->with('error', 'You can only reference properties you own.');
            }
        }

        // Create new message
        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $userId;
        $message->subject = $validated['subject'];
        $message->content = $validated['content'];
        $message->property_id = $validated['property_id'] ?? null;
        $message->save();

        return redirect()->route('messages.show', $userId)
                         ->with('success', 'Reply sent successfully.');
    }
}
