<?php

use App\Study;

// Admin
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('admin'));
});

// Admin > Manage Case Studies
Breadcrumbs::register('manage', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Manage Case Studies', route('admin.cases.index'));
});

// Admin > Add New Case Study
Breadcrumbs::register('create', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add New Case Study', route('admin.cases.create'));
});

// Admin > Manage Drafts
Breadcrumbs::register('drafts', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Manage Drafts', route('admin.cases.drafts'));
});

// Admin > Cases > edit
Breadcrumbs::register('edit', function($breadcrumbs, $slug)
{
    if(Study::where('slug', $slug)->firstOrFail()->draft) {
        // study is a draft so different parent.
        $breadcrumbs->parent('drafts');
    } else {
        $breadcrumbs->parent('manage');
    }
    $breadcrumbs->push('Edit Case Study', route('admin.cases.edit', $slug));
});

Breadcrumbs::register('notifications', function($breadcrumbs)
{

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Notifications', route('admin.notifications'));

});