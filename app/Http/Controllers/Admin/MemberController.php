<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Job;
use App\Models\Member;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $members = Member::with(['job'])->get();

        $jobs = Job::get();

        return view('admin.members.index', compact('jobs', 'members'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('meslek', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.members.create', compact('jobs'));
    }

    public function store(StoreMemberRequest $request)
    {
        $member = Member::create($request->all());

        return redirect()->route('admin.members.index');
    }

    public function edit(Member $member)
    {
        abort_if(Gate::denies('member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('meslek', 'id')->prepend(trans('global.pleaseSelect'), '');

        $member->load('job');

        return view('admin.members.edit', compact('jobs', 'member'));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->all());

        return redirect()->route('admin.members.index');
    }

    public function show(Member $member)
    {
        abort_if(Gate::denies('member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->load('job');

        return view('admin.members.show', compact('member'));
    }

    public function destroy(Member $member)
    {
        abort_if(Gate::denies('member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemberRequest $request)
    {
        $members = Member::find(request('ids'));

        foreach ($members as $member) {
            $member->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
