<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthenticationRequest;
use App\Repositories\Interfaces\Authentication\AuthenticationRequestRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticationRequestController extends Controller
{
    public function __construct(protected AuthenticationRequestRepositoryInterface $authenticationRequestRepository)
    {
        $this->authenticationRequestRepository = $authenticationRequestRepository;
    }

    public function index(Request $request)
    {
        return Inertia::render('AuthRequest/Index', [
            'authRequests' => AuthenticationRequest::with('user')->orderBy('id', 'desc')->get(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $authRequest = $this->authenticationRequestRepository->findById($id);
        $cookieName = "RBS-user_{$authRequest->user_id}";
        $approvalSecret = $cookieName . "_" . rand(1000, 9999);
        $this->authenticationRequestRepository->update($id, [
            'approval' => $request->type,
            'approval_secret' => $approvalSecret,
            'time'=> 262800,
            'remark' => 'test',
        ]);
        return redirect()->back();
    }
}
