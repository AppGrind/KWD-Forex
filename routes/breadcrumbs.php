<?php

    // Home
    Breadcrumbs::register('dashboard', function ($breadcrumbs) {
        $breadcrumbs->push('Dashboard', route('dashboard'));
    });

//Events Breadcrumbs start

Breadcrumbs::register('events', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Events', route('events.index'));
});

Breadcrumbs::register('events.create', function ($breadcrumbs) {
    $breadcrumbs->parent('events');
    $breadcrumbs->push('Create Event', route('events.create'));
});

Breadcrumbs::register('events.show', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('events');
    $breadcrumbs->push('Show Event', route('events.show', $event->id));
});

Breadcrumbs::register('events.edit', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('events.show', $event);
    $breadcrumbs->push('Edit Event', route('events.edit', $event->id));
});

//Events Breadcrumbs end


//Invoices Breadcrumbs start
Breadcrumbs::register('invoices', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Invoices', route('invoices.index'));
});

Breadcrumbs::register('invoices.create', function ($breadcrumbs) {
    $breadcrumbs->parent('invoices');
    $breadcrumbs->push('Create Invoice', route('invoices.create'));
});

Breadcrumbs::register('invoices.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('invoices');
    $breadcrumbs->push('Edit Invoice', route('invoices.edit'));
});

Breadcrumbs::register('invoices.show', function ($breadcrumbs) {
    $breadcrumbs->parent('invoices');
    $breadcrumbs->push('Show Invoice', route('invoices.show'));
});
//Invoices Breadcrumbs end


//Items Breadcrumbs start
Breadcrumbs::register('items', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Items', route('items.index'));
});

Breadcrumbs::register('items.create', function ($breadcrumbs) {
    $breadcrumbs->parent('items');
    $breadcrumbs->push('Create Item', route('items.create'));
});

Breadcrumbs::register('items.show', function ($breadcrumbs, $item) {
    $breadcrumbs->parent('items');
    $breadcrumbs->push('Show Item', route('items.show', $item->id));
});

Breadcrumbs::register('items.edit', function ($breadcrumbs, $item) {
    $breadcrumbs->parent('items.show', $item);
    $breadcrumbs->push('Edit Item', route('items.edit', $item->id));
});

//Items Breadcrumbs end


//Users Breadcrumbs start
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Users', route('users.index'));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Create User', route('users.create'));
});

Breadcrumbs::register('users.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Show User', route('users.show', $user->id));
});

Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.show', $user);
    $breadcrumbs->push('Edit User', route('users.edit', $user->id));
});
//Users Breadcrumbs end


//Bookings Breadcrumbs start
Breadcrumbs::register('bookings', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Bookings', route('bookings.index'));
});

Breadcrumbs::register('bookings.create', function ($breadcrumbs) {
    $breadcrumbs->parent('bookings');
    $breadcrumbs->push('Create Booking', route('bookings.create'));
});

Breadcrumbs::register('notifications', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Notifications', route('notifications.index'));
});

Breadcrumbs::register('notifications.show', function ($breadcrumbs) {
    $breadcrumbs->parent('notifications');
    $breadcrumbs->push('Show Notification', route('notifications.show'));
});
//Events Breadcrumbs end