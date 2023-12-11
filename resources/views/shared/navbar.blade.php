<nav class="navbar bg-dark sticky-top navbar-expand-md" data-bs-theme="dark">
  <div class="container">
	  <a href="{{ route('home') }}" class="navbar-brand">
		  {{ config('app.name', 'Laravel') }}
	  </a>

	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarCollapse">
		  <ul class="navbar-nav ms-auto">
			  @guest
				  <li class="nav-item">
					  <a href="#" class="nav-link">
						  Login
					  </a>
				  </li>
				  <li class="nav-item">
					  <a href="#" class="nav-link">
						  Register
					  </a>
				  </li>
			  @else
				  <li class="nav-item dropdown">
					  <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Name
					  </a>

					  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						  <a href="#" class="dropdown-item">
							  Public Profile
						  </a>

						  <a href="#" class="dropdown-item">
							  Settings
						  </a>

						  <div class="dropdown-divider"></div>

						  <a href="#"
							  class="dropdown-item"
							  onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
							  Logout
						  </a>

						  <form id="logout-form" class="d-none" action="#" method="POST">
							  {{ csrf_field() }}
						  </form>
					  </div>
				  </li>
			  @endguest
		  </ul>
	  </div>
  </div>
</nav>
