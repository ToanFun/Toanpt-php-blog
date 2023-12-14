<nav class="navbar bg-dark sticky-top navbar-expand-md" data-bs-theme="dark">
  <div class="container">
	  <a href="{{ route('home') }}" class="navbar-brand">
		  {{ config('app.name', 'Laravel') }}
	  </a>
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarCollapse">
			@admin
				@include('admin.shared.sidebar')
		  @endadmin
		  <ul class="navbar-nav ms-auto">
			  @guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
				  <li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
			  @else
				  <li class="nav-item dropdown">
					  <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ Auth::user()->name }}
					  </a>
					  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						  <a href="{{ route('users.show', Auth::id()) }}" class="dropdown-item">
							  Public Profile
						  </a>
						  <a href="{{ route('users.edit') }}" class="dropdown-item">
							  Settings
						  </a>
						  <div class="dropdown-divider"></div>
						  <a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
					  </div>
				  </li>
			  @endguest
		  </ul>
	  </div>
  </div>
</nav>
