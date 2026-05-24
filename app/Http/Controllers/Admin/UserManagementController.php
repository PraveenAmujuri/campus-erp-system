<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\UserManagementService;
use App\Http\Requests\Admin\StoreUserRequest;

class UserManagementController extends Controller
{
    protected UserManagementService $userManagementService;

    /**
     * Inject user management service.
     */
    public function __construct(UserManagementService $userManagementService)
    {
        $this->userManagementService = $userManagementService;
    }

    /**
     * Display all system users.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display user creation form.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store newly created user.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userManagementService
            ->createUser($request->validated());

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }
}