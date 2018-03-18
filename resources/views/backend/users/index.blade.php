@extends('layouts.backend')

@section('title')
    Users
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('users') }}
@stop

@section('actions')
    @include('partials.buttons')
@stop

@section('content')

    <!-- Panel -->
    <div class="panel ">
        <div class="panel-body">
            <form class="page-search-form" role="search">
                <div class="input-search input-search-dark">
                    <i class="input-search-icon md-search" aria-hidden="true"></i>
                    <input type="text" class="form-control input-search" id="inputSearch" name="search" placeholder="Search Users">
                    <button type="button" class="input-search-close icon md-close" aria-label="Close"></button>
                </div>
            </form>
            <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">
                {{--<div class="dropdown page-user-sortlist">--}}
                    {{--Order By: <a class="dropdown-toggle inline-block" data-toggle="dropdown"--}}
                                 {{--href="#" aria-expanded="false">Last Active</a>--}}
                    {{--<div class="dropdown-menu animation-scale-up animation-top-right animation-duration-250"--}}
                         {{--role="menu">--}}
                        {{--<a class="active dropdown-item" href="javascript:void(0)">Last Active</a>--}}
                        {{--<a class="dropdown-item" href="javascript:void(0)">Username</a>--}}
                        {{--<a class="dropdown-item" href="javascript:void(0)">Location</a>--}}
                        {{--<a class="dropdown-item" href="javascript:void(0)">Register Date</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#all_contacts"
                                                                aria-controls="all_contacts" role="tab">All Contacts</a></li>
                    <li class="dropdown nav-item" role="presentation">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Contacts </a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts"
                               role="tab">All Contacts</a>
                        </div>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane animation-fade active" id="all_contacts" role="tabpanel">
                        <ul class="list-group user-list">
                            @foreach($users as $user)
                            <li class="list-group-item" data-name="{{ strtolower($user->fullname) }} {{ strtolower($user->email) }} {{ $user->contactnumber }}">
                                <div class="media">
                                    <div class="pr-20">
                                        <div class="avatar avatar-online">
                                            <img src="{{ Avatar::create($user->firstname)->toBase64() }}" />
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-5">
                                            <a href="{{ url('users/'. $user->id) }}">{{ $user->fullname }}</a>
                                            <small>Last Accessed: {{ $user->lastloggedin_at === null ? 'Never'  : $user->lastloggedin_at->diffForHUmans() }}</small>
                                        </h5>
                                        <p>
                                            <i class="icon icon-color md-email" aria-hidden="true"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </p>
                                        <p>
                                            <i class="icon icon-color md-pin" aria-hidden="true"></i>  {{ $user->address }}, {{ $user->town }}, {{ $user->province }}
                                        </p>
                                        <p>
                                            <i class="icon icon-color md-phone" aria-hidden="true"></i> {{ $user->contactnumber }}
                                        </p>
                                    </div>
                                    <div class="pl-20 pr-20 align-self-center">
                                        <input type="checkbox" class="to-labelauty verify-user" data-user-id="{{ $user->id }}" data-user-status="{{ $user->is_verified ? true : false }}" data-labelauty="Not Verified|Verified" {{ $user->is_verified ? 'checked' : '' }} />
                                        @unless($user->hasRole('admin'))
                                        {!! Btn::delete($user->id, url('/users'), true, $user->fullname, 'btn-block mt-5')!!}
                                        @endunless
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <nav>
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Panel -->

@endsection

@section('css')
    {{ Html::style('backend/global/vendor/jquery-labelauty/jquery-labelauty.css') }}

    <style>
        .page-user .page-content form {
            margin-bottom: 40px;
        }

        .page-user .page-content .list-group-item {
            padding: 25px 0;
            border-top-color: #e0e0e0;
        }

        .page-user .page-content .list-group-item:first-child {
            border-top-color: transparent;
        }

        .page-user .page-content .list-group-item:last-child {
            border-bottom-color: #e0e0e0;
        }

        .page-user .page-content .list-group-item .media-heading > small {
            margin-left: 10px;
        }

        .page-user .page-content .list-group-item p {
            margin-bottom: 5px;
        }

        .page-user .page-content .nav-tabs-horizontal {
            position: relative;
        }

        .page-user .page-content .page-user-sortlist {
            position: absolute;
            top: 5px;
            right: 0;
            z-index: 2;
        }

        @media (max-width: 991px) {
            .page-user .page-content .page-user-sortlist {
                top: -15px;
            }
        }

        @media (max-width: 479px) {
            .page-user .page-content .list-group-item .media-body {
                display: block;
                text-align: center;
            }
            .page-user .page-content .list-group-item .media-body {
                width: auto;
            }
            .page-user .page-content .list-group-item .media-body {
                margin-top: 15px;
            }
            .page-user .page-content .tab-content nav {
                text-align: center;
            }
        }

    </style>
@stop

@section('js')
    {!! Html::script("backend/global/js/Plugin/aspaginator.js") !!}
    {!! Html::script("backend/global/js/Plugin/responsive-tabs.js") !!}
    {!! Html::script("backend/global/js/Plugin/tabs.js") !!}
    {!! Html::script("backend/global/vendor/jquery-labelauty/jquery-labelauty.js") !!}
    {!! Html::script("backend/global/js/Plugin/jquery-labelauty.js") !!}

    <script>
        $(document).ready(function(){
            $(".to-labelauty").labelauty({minimum_width: "100px" });

            $('.verify-user').on('change', function(){
                var $resource = $(this);

                var data = {
                    id: $resource.attr('data-user-id'),
                    status: $resource.attr('data-user-status')
                };

                var a = "{{ url('/') }}",
                    t = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    url: a + "/ajax/verify",
                    type: "POST",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": t
                    },
                    success: function(e) {
                        console.log(e);
                        switch ((e = e.data).level) {
                            case "success":
                                $resource.attr('data-user-status', e.status_is);
                                toastr.success(e.message,e.title);
                                break;
                            case "warning":
                                toastr.warning(e.message,e.title);
                                break;
                        }
                    },
                    error: function(e) {

                    }
                });
            });
        });
    </script>

    <script>
        (function(document, window, $) {
            'use strict';


            $(document).ready(function($) {
                Site.run();
                $('.input-search input[type=text]').on('keyup', function() {
                    var val = $(this).val().toLowerCase();
                    if (val !== '') {
                        $('[data-name]').addClass('d-none');
                        $('[data-name*=' + val + ']').removeClass('d-none');
                    } else {
                        $('[data-name]').removeClass('d-none');
                    }

                    $('.icon-group').each(function() {
                        var $group = $(this);
                        if ($group.find('[data-name]:not(.d-none)').length === 0) {
                            $group.hide();
                        } else {
                            $group.show();
                        }
                    });

                });

            });
        })(document, window, jQuery);

    </script>
@stop