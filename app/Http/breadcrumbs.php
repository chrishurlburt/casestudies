<?php

use App\Study;

// Admin
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('admin'));
});


/**
 * Studies crumbs
 */
Breadcrumbs::register('manage', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Manage Case Studies', route('admin.cases.index'));
});

Breadcrumbs::register('create', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add New Case Study', route('admin.cases.create'));
});

Breadcrumbs::register('drafts', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Manage Drafts', route('admin.cases.drafts'));
});

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


/**
 * Notifications crumbs
 */
Breadcrumbs::register('notifications', function($breadcrumbs)
{

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Notifications', route('admin.notifications'));

});


/**
 * Courses crumbs
 */
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


/**
 * Outcomes crumbs
 */
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


/**
 * Users crumbs
 */
Breadcrumbs::register('create-user', function($breadcrumbs){

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Add New User', route('admin.users.create'));

});

Breadcrumbs::register('manage-users', function($breadcrumbs){

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Manage Users', route('admin.users.index'));

});

Breadcrumbs::register('edit-user', function($breadcrumbs, $id){

    $breadcrumbs->parent('manage-users');
    $breadcrumbs->push('Edit Users', route('admin.outcomes.index', $id));

});