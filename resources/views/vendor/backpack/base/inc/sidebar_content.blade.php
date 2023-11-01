{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('request') }}"><i class="nav-icon la la-file-image-o"></i> Requests</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('estimate') }}"><i class="nav-icon la la-file-text-o"></i> Estimates</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user-categorie') }}"><i class="nav-icon la la-group"></i> User categories</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('categorie') }}"><i class="nav-icon la la la-th-large"></i> Categories</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('sub-categorie') }}"><i class="nav-icon la la la-th-list"></i> Sub categories</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('membership') }}">  <i class="nav-icon la la-calendar-check-o plan-icon"></i> Memberships</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user-membership') }}"><i class="nav-icon la la-user-shield memberships-icon"></i> User memberships</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('security-processes') }}"><i class="nav-icon la la-question"></i> Security processes</a></li>