<!-- sidebar.blade.php -->
<div id="sidebar" class="hidden md:block w-64 bg-white shadow-lg fixed top-0 left-0 h-full z-50 overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: #c1c1c1 #f1f1f1;">
    <!-- Brand Header -->
    <div class="py-6 px-4 border-b border-gray-100" style="background: linear-gradient(135deg, #f8fafc, #e0f2fe);">
        <h1 class="text-xl font-bold" style="color: #1E40AF;">Property Finder</h1>
        <p class="text-xs text-gray-500 mt-1" style="font-style: italic;">Find your perfect space</p>
    </div>

    <!-- Navigation Menu -->
    <div class="py-4">
        <h3 class="px-4 text-xs font-medium text-gray-500 uppercase tracking-wider mb-3" style="letter-spacing: 0.05em;">Dashboard Menu</h3>
        <nav>
            <ul>
                <li>
                    <a href="/property-owner-dashboard"
                        class="flex items-center px-4 py-3 text-gray-700 transition border-l-4 border-transparent"
                        style="transition: all 0.3s ease; hover:background-color: #E0F2FE; hover:color: #1E40AF; hover:border-left-color: #1E40AF;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" style="color: #3B82F6;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span style="font-weight: 500;">My Properties</span>
                    </a>
                </li>
                <!-- Bookings & Requests Dropdown -->
                <li class="relative">
                    <button
                        class="flex items-center justify-between w-full px-4 py-3 text-gray-700 transition border-l-4 border-transparent"
                        style="transition: all 0.3s ease; hover:background-color: #E0F2FE; hover:color: #1E40AF; hover:border-left-color: #1E40AF;">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" style="color: #3B82F6;"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span style="font-weight: 500;">Bookings & Requests</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform booking-dropdown-icon" style="color: #3B82F6; transition: transform 0.2s ease;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="pl-12 hidden booking-dropdown" style="background-color: #f9fafb; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                    <a href="/active-bookings" 
                        class="block py-2 text-sm text-gray-700" 
                        style="transition: color 0.2s ease; hover:color: #1E40AF; padding-left: 0.75rem;">
                            Active Bookings
                    </a>
                        <a href="#pending-requests"
                            class="block py-2 text-sm text-gray-700" style="transition: color 0.2s ease; hover:color: #1E40AF; padding-left: 0.75rem;">
                            Pending Requests
                        </a>
                        <a href="#booking-history"
                            class="block py-2 text-sm text-gray-700" style="transition: color 0.2s ease; hover:color: #1E40AF; padding-left: 0.75rem;">
                            Booking History
                        </a>
                    </div>
                </li>
                <li>
                    <a href="#messages"
                        class="flex items-center px-4 py-3 text-gray-700 transition border-l-4 border-transparent"
                        style="transition: all 0.3s ease; hover:background-color: #E0F2FE; hover:color: #1E40AF; hover:border-left-color: #1E40AF;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" style="color: #3B82F6;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span style="font-weight: 500;">Messages</span>
                    </a>
                </li>
                <!-- Financial Dropdown -->
                <li class="relative">
                    <button
                        class="flex items-center justify-between w-full px-4 py-3 text-gray-700 transition border-l-4 border-transparent"
                        style="transition: all 0.3s ease; hover:background-color: #E0F2FE; hover:color: #1E40AF; hover:border-left-color: #1E40AF;">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" style="color: #3B82F6;"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span style="font-weight: 500;">Financial</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform financial-dropdown-icon" style="color: #3B82F6; transition: transform 0.2s ease;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="pl-12 hidden financial-dropdown" style="background-color: #f9fafb; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                        <a href="#earnings"
                            class="block py-2 text-sm text-gray-700" style="transition: color 0.2s ease; hover:color: #1E40AF; padding-left: 0.75rem;">
                            Earnings Summary
                        </a>
                        <a href="#transactions"
                            class="block py-2 text-sm text-gray-700" style="transition: color 0.2s ease; hover:color: #1E40AF; padding-left: 0.75rem;">
                            Transactions
                        </a>
                        <a href="#withdrawals"
                            class="block py-2 text-sm text-gray-700" style="transition: color 0.2s ease; hover:color: #1E40AF; padding-left: 0.75rem;">
                            Withdrawals
                        </a>
                    </div>
                </li>
                <li>
                    <a href="#reviews"
                        class="flex items-center px-4 py-3 text-gray-700 transition border-l-4 border-transparent"
                        style="transition: all 0.3s ease; hover:background-color: #E0F2FE; hover:color: #1E40AF; hover:border-left-color: #1E40AF;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" style="color: #3B82F6;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-.38 1.81.588 1.81h4.914a1 1 0 00.951-.69l1.519-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <span style="font-weight: 500;">Ratings & Reviews</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="flex items-center px-4 py-3 text-gray-700 transition border-l-4 border-transparent"
                           style="transition: all 0.3s ease; hover:background-color: #E0F2FE; hover:color: #1E40AF; hover:border-left-color: #1E40AF;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" style="color: #3B82F6;" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span style="font-weight: 500;">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>

    @auth
        <!-- User Profile Card -->
        <div class="p-4 border-t border-gray-100 mt-2" style="background-color: #f9fafb; box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);">
            <div class="flex items-center mb-4">
                <div class="relative h-12 w-12 rounded-full overflow-hidden mr-3 group" style="border: 2px solid #1E40AF; box-shadow: 0 0 0 2px rgba(30, 64, 175, 0.1);">
                    @if (Auth::user()->profile_image)
                        <img src="{{ Auth::user()->profile_image }}" alt="{{ Auth::user()->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full flex items-center justify-center text-white text-lg font-bold"
                            style="background-color: #1E40AF;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    
                    <!-- Edit Profile Image Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center cursor-pointer"
                        style="background-color: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.2s ease;"
                        onmouseover="this.style.opacity=1"
                        onmouseout="this.style.opacity=0"
                        onclick="document.getElementById('profile-image-upload').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <form id="profile-image-form" action="{{ route('profile.update-image') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="profile-image-upload" name="profile_image" class="hidden"
                            onchange="document.getElementById('profile-image-form').submit()">
                    </form>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800" style="text-shadow: 0 1px 0 rgba(255,255,255,0.8);">{{ Auth::user()->name }}</h2>
                    <div class="flex items-center text-gray-600 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" style="color: #3B82F6;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="truncate w-36">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</div>

<!-- Mobile sidebar overlay -->
<div id="sidebar-overlay" class="fixed inset-0 z-40 hidden md:hidden" style="background-color: rgba(17, 24, 39, 0.5); backdrop-filter: blur(2px);"></div>

<!-- JavaScript to handle dropdowns and hover effects -->
<script>
    // For dropdowns
    document.addEventListener('DOMContentLoaded', function() {
        // Booking dropdown toggle
        const bookingButton = document.querySelector('button:has(.booking-dropdown-icon)');
        const bookingDropdown = document.querySelector('.booking-dropdown');
        const bookingIcon = document.querySelector('.booking-dropdown-icon');
        
        if (bookingButton && bookingDropdown && bookingIcon) {
            bookingButton.addEventListener('click', function() {
                bookingDropdown.classList.toggle('hidden');
                bookingIcon.style.transform = bookingDropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        }
        
        // Financial dropdown toggle
        const financialButton = document.querySelector('button:has(.financial-dropdown-icon)');
        const financialDropdown = document.querySelector('.financial-dropdown');
        const financialIcon = document.querySelector('.financial-dropdown-icon');
        
        if (financialButton && financialDropdown && financialIcon) {
            financialButton.addEventListener('click', function() {
                financialDropdown.classList.toggle('hidden');
                financialIcon.style.transform = financialDropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        }
        
        // Add hover effects to all menu items
        const menuItems = document.querySelectorAll('#sidebar nav a, #sidebar nav button');
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#E0F2FE';
                this.style.color = '#1E40AF';
                if (this.classList.contains('border-l-4')) {
                    this.style.borderLeftColor = '#1E40AF';
                }
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
                this.style.color = '';
                if (this.classList.contains('border-l-4')) {
                    this.style.borderLeftColor = 'transparent';
                }
            });
        });
    });
</script>