<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::published()->latest()->paginate(10);
        return view('public.announcement.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('public.announcement.show', compact('announcement'));
    }
}
