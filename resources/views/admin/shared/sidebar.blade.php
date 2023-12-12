<ul class="navbar-nav navbar-sidenav text-white">
  <li class="nav-item" role="presentation" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
	  <a class="nav-link {{ request()->route()->named('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
		  <x-icon name="tachometer" />
		  <span class="nav-link-text">Dashboard</span>
	  </a>
  </li>
  <li class="nav-item" role="presentation" data-bs-toggle="tooltip" data-bs-placement="right" title="Posts">
	  <a @class(['nav-link', 'active' => request()->route()->named('admin.posts.*')]) href="{{ route('admin.posts.index') }}">
		  <x-icon name="file-text" prefix="fa-regular" />
		  <span class="nav-link-text">Posts</span>
	  </a>
  </li>
  <li class="nav-item" role="presentation" data-bs-toggle="tooltip" data-bs-placement="right" title="Users">
	  <a @class(['nav-link', 'active' => request()->route()->named('admin.users.*')]) href="{{ route('admin.users.index') }}">
		  <x-icon name="users" />
		  <span class="nav-link-text">Users</span>
	  </a>
  </li>

</ul>