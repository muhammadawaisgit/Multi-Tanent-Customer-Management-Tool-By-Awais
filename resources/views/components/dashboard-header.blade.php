<div class="dashboard-header d-flex justify-content-between align-items-center px-4 py-3">
    <div class="dashboard-header-left">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-white-50 text-decoration-none">Pages</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <h4 class="mb-0 text-white">@yield('title')</h4>
    </div>
    
    <div class="dashboard-header-right d-flex align-items-center">
        <div class="search-container me-3">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-0">
                    <i class="fa-solid fa-search text-white-50"></i>
                </span>
                <input type="text" class="form-control border-0 text-white" placeholder="Search...">
            </div>
        </div>
        
        <div class="header-icons d-flex align-items-center">
            <button class="btn bg-transparent border-0 me-2">
                <i class="fa-solid fa-gear text-white-50"></i>
            </button>
            <button class="btn bg-transparent border-0 me-2">
                <i class="fa-solid fa-bell text-white-50"></i>
            </button>
            <div class="user-profile d-flex align-items-center">
                <i class="fa-solid fa-user text-white-50 p-2 rounded-circle" style="width: 35px; height: 35px; background-color: #1A1F37;"></i>
            </div>
        </div>
    </div>
</div>
