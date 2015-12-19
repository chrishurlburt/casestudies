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

Breadcrumbs::register('create-course', function($breadcrumbs){

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add New Course', route('admin.courses.create'));

});

Breadcrumbs::register('manage-courses', function($breadcrumbs){

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Manage Courses', route('admin.courses.index'));

});

Breadcrumbs::register('edit-course', function($breadcrumbs, $id){

    $breadcrumbs->parent('manage-courses');
    $breadcrumbs->push('Edit Course', route('admin.courses.edit', $id));

});

Breadcrumbs::register('create-outcome', function($breadcrumbs){

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add New Outcome', route('admin.outcomes.create'));

});

Breadcrumbs::register('manage-outcomes', function($breadcrumbs){

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Manage Outcomes', route('admin.outcomes.index'));

});

Breadcrumbs::register('edit-outcome', function($breadcrumbs, $id){

    $breadcrumbs->parent('manage-outcomes');
    $breadcrumbs->push('Edit Learning Outcome', route('admin.outcomes.index', $id));

});